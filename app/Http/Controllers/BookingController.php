<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // GET /site/{slug}/booking/slots?date=2026-04-01
    public function slots(string $slug, Request $request)
    {
        $site    = Site::where('slug', $slug)->firstOrFail();
        $setting = $site->bookingSetting;

        abort_unless($setting?->is_enabled, 404);

        $date = Carbon::parse($request->date);

        $dayKey = strtolower($date->format('D')); // 'mon', 'tue'…
        if (! in_array($dayKey, $setting->working_days ?? []) || $date->isPast()) {
            return response()->json(['slots' => []]);
        }

        $slots    = [];
        $start    = Carbon::parse($date->format('Y-m-d') . ' ' . $setting->working_hours_start);
        $end      = Carbon::parse($date->format('Y-m-d') . ' ' . $setting->working_hours_end);
        $duration = $setting->slot_duration_minutes;
        $buffer   = $setting->buffer_minutes;

        $booked = $site->appointments()
            ->where('appointment_date', $date->format('Y-m-d'))
            ->where('status', 'confirmed')
            ->pluck('appointment_time')
            ->toArray();

        $cursor = $start->copy();
        while ($cursor->copy()->addMinutes($duration)->lte($end)) {
            $timeStr = $cursor->format('H:i');
            if (! in_array($timeStr, $booked)) {
                $slots[] = $timeStr;
            }
            $cursor->addMinutes($duration + $buffer);
        }

        return response()->json(['slots' => $slots]);
    }

    // POST /site/{slug}/booking
    public function store(Request $request, string $slug, GoogleCalendarService $google)
    {
        $site    = Site::where('slug', $slug)->firstOrFail();
        $setting = $site->bookingSetting;

        abort_unless($setting?->is_enabled, 404);

        $data = $request->validate([
            'customer_name'    => 'required|string|max:100',
            'customer_email'   => 'required|email|max:150',
            'customer_phone'   => 'nullable|string|max:30',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => ['required', 'regex:/^\d{2}:\d{2}$/'],
            'notes'            => 'nullable|string|max:500',
        ]);

        $alreadyBooked = $site->appointments()
            ->where('appointment_date', $data['appointment_date'])
            ->where('appointment_time', $data['appointment_time'])
            ->where('status', 'confirmed')
            ->exists();

        abort_if($alreadyBooked, 409, 'Ese horario ya no está disponible.');

        $googleEventId = null;

        if ($setting->isConnected()) {
            try {
                $startDt = Carbon::parse($data['appointment_date'] . ' ' . $data['appointment_time']);
                $endDt   = $startDt->copy()->addMinutes($setting->slot_duration_minutes);

                $googleEventId = $google->createEvent(
                    $setting->google_refresh_token,
                    $setting->google_calendar_id,
                    [
                        'summary'     => 'Cita: ' . $data['customer_name'],
                        'description' => $data['notes'] ?? '',
                        'start'       => ['dateTime' => $startDt->toRfc3339String(), 'timeZone' => config('app.timezone')],
                        'end'         => ['dateTime' => $endDt->toRfc3339String(),   'timeZone' => config('app.timezone')],
                        'attendees'   => [['email' => $data['customer_email']]],
                    ]
                );
            } catch (\Throwable) {
                // Si falla Google Calendar, seguimos guardando en BD local
            }
        }

        $site->appointments()->create([
            ...$data,
            'duration_minutes' => $setting->slot_duration_minutes,
            'google_event_id'  => $googleEventId,
        ]);

        return response()->json(['ok' => true]);
    }

    // PATCH /dashboard/sites/{site}/booking-settings
    public function updateSettings(Request $request, Site $site)
    {
        $this->authorize('update', $site);

        $data = $request->validate([
            'is_enabled'            => 'boolean',
            'slot_duration_minutes' => 'integer|in:15,30,45,60,90,120',
            'buffer_minutes'        => 'integer|min:0|max:60',
            'advance_booking_days'  => 'integer|min:1|max:365',
            'working_days'          => 'array',
            'working_days.*'        => 'in:mon,tue,wed,thu,fri,sat,sun',
            'working_hours_start'   => ['regex:/^\d{2}:\d{2}$/'],
            'working_hours_end'     => ['regex:/^\d{2}:\d{2}$/'],
        ]);

        $setting = $site->bookingSetting ?? $site->bookingSetting()->create([]);
        $setting->update($data);

        return response()->json(['ok' => true]);
    }
}
