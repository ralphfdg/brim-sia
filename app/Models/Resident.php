<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Resident extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'date_of_birth',
        'gender',
        'civil_status',
        'purok_or_street',
        'contact_number',
        'email',
        'is_registered_voter',
        'occupation',
        'residency_status',
    ];

    /**
     * Relationship: One Resident has many Certificate Requests.
     */
    public function certificateRequests()
    {
        return $this->hasMany(CertificateRequest::class);
    }
}