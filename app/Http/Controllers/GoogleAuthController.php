<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    public function redirect(Site $site, GoogleCalendarService $google)
    {
        $this->authorize('update', $site);

        $state = base64_encode(json_encode(['site_id' => $site->id, 'token' => csrf_token()]));

        return redirect($google->authUrl($state));
    }

    public function callback(Request $request, GoogleCalendarService $google)
    {
        abort_if(! $request->code, 400);

        $state  = json_decode(base64_decode($request->state ?? ''), true);
        $siteId = $state['site_id'] ?? null;

        abort_unless($siteId, 400);

        $site = Site::findOrFail($siteId);
        $this->authorize('update', $site);

        $tokens = $google->exchangeCode($request->code);

        $setting = $site->bookingSetting ?? $site->bookingSetting()->create([]);
        $setting->update(['google_refresh_token' => $tokens['refresh_token']]);

        return redirect()->route('dashboard.builder.show', $site)
            ->with('success', 'Google Calendar conectado correctamente.');
    }

    public function disconnect(Site $site)
    {
        $this->authorize('update', $site);

        $site->bookingSetting?->update(['google_refresh_token' => null]);

        return response()->json(['ok' => true]);
    }
}
