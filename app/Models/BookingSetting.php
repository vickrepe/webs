<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSetting extends Model
{
    protected $fillable = [
        'site_id', 'is_enabled', 'slot_duration_minutes', 'buffer_minutes',
        'advance_booking_days', 'working_days', 'working_hours_start',
        'working_hours_end', 'google_refresh_token', 'google_calendar_id',
    ];

    protected $casts = [
        'working_days' => 'array',
        'is_enabled'   => 'boolean',
    ];

    public function isConnected(): bool
    {
        return ! empty($this->google_refresh_token);
    }
}
