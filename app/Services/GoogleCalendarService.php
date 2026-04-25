<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleCalendarService
{
    private string $clientId;
    private string $clientSecret;
    private string $redirectUri;

    public function __construct()
    {
        $this->clientId     = config('services.google.client_id');
        $this->clientSecret = config('services.google.client_secret');
        $this->redirectUri  = config('services.google.redirect');
    }

    public function authUrl(string $state): string
    {
        return 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
            'client_id'     => $this->clientId,
            'redirect_uri'  => $this->redirectUri,
            'response_type' => 'code',
            'scope'         => 'https://www.googleapis.com/auth/calendar.events',
            'access_type'   => 'offline',
            'prompt'        => 'consent',
            'state'         => $state,
        ]);
    }

    public function exchangeCode(string $code): array
    {
        return Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'code'          => $code,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri'  => $this->redirectUri,
            'grant_type'    => 'authorization_code',
        ])->throw()->json();
    }

    public function getAccessToken(string $refreshToken): string
    {
        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type'    => 'refresh_token',
        ])->throw()->json();

        return $response['access_token'];
    }

    public function createEvent(string $refreshToken, string $calendarId, array $event): string
    {
        $accessToken = $this->getAccessToken($refreshToken);

        $response = Http::withToken($accessToken)
            ->post("https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events", $event)
            ->throw()
            ->json();

        return $response['id'];
    }

    public function deleteEvent(string $refreshToken, string $calendarId, string $eventId): void
    {
        $accessToken = $this->getAccessToken($refreshToken);

        Http::withToken($accessToken)
            ->delete("https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events/{$eventId}");
    }
}
