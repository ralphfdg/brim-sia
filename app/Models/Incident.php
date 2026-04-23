<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Incident extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'resident_id',
        'incident_type',
        'description',
        'location_details',
        'incident_date',
        'status',
    ];

    /**
     * Relationship: This incident belongs to the resident who reported it.
     */
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}