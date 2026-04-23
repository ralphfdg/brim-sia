<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CertificateRequest extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'resident_id',
        'certificate_type',
        'purpose',
        'tracking_number',
        'request_status',
        'payment_status',
        'stripe_transaction_id',
        'processed_by_user_id',
    ];

    /**
     * Relationship: This request belongs to one specific Resident.
     */
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    /**
     * Relationship (Audit Trail): This request was processed by one Admin/Staff member.
     */
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by_user_id');
    }
}