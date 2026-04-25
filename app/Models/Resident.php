<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Resident extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'date_of_birth',
        'gender',
        'civil_status',
        'purok_or_street',
        'contact_number',
        'is_registered_voter',
        'occupation',
        'residency_status',
    ];

    // A Resident profile belongs to one User account
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: One Resident has many Certificate Requests.
     */
    public function certificateRequests()
    {
        return $this->hasMany(CertificateRequest::class);
    }

    /**
     * NEW ADDITION: A resident can report many incidents.
     */
    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    /**
     * NEW ADDITION: A resident can register for many events.
     */
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}