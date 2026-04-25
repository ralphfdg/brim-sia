<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // <--- Add this import

class EventRegistration extends Model
{
    use HasFactory, HasUuids; // <--- Add HasUuids here

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 
        'event_id', 
        'resident_id', 
        'payment_status', 
        'stripe_transaction_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}