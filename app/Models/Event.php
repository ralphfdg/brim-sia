<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Event extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'event_name',
        'description',
        'event_date',
        'registration_fee',
    ];

    /**
     * Relationship: An event can have many registrations.
     */
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}