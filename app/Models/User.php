<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // 1. Add this import for API security
use Illuminate\Database\Eloquent\Concerns\HasUuids; // 2. Add this for UUIDs

class User extends Authenticatable
{
    // 3. Add HasApiTokens and HasUuids inside the class here
    use HasApiTokens, HasFactory, Notifiable, HasUuids; 

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * (Audit Trail): Get all the certificates this Admin/Staff member has processed.
     */
    public function processedCertificates()
    {
        return $this->hasMany(CertificateRequest::class, 'processed_by_user_id');
    }
}