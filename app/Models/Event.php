<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // <--- Add this import

class Event extends Model
{
    use HasFactory, HasUuids; // <--- Add HasUuids here

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 
        'event_name', 
        'description', 
        'event_date', 
        'location', 
        'max_attendees', 
        'registration_fee', 
        'status'
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}