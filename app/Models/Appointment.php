<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'site_id', 'customer_name', 'customer_email', 'customer_phone',
        'appointment_date', 'appointment_time', 'duration_minutes',
        'notes', 'google_event_id', 'status',
    ];

    protected $casts = ['appointment_date' => 'date'];
}
