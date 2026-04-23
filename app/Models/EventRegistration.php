<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EventRegistration extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'event_id',
        'resident_id',
        'payment_status',
        'stripe_transaction_id',
    ];

    /**
     * Relationship: Links to the specific event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relationship: Links to the resident who registered.
     */
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}