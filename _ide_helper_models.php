<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property string $id
 * @property string $resident_id
 * @property string $certificate_type
 * @property string $purpose
 * @property string $tracking_number
 * @property string $request_status
 * @property string $payment_status
 * @property string|null $stripe_transaction_id
 * @property string|null $processed_by_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $processedBy
 * @property-read \App\Models\Resident $resident
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereCertificateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereProcessedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereRequestStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereResidentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereStripeTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CertificateRequest whereUpdatedAt($value)
 */
	class CertificateRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $event_name
 * @property string|null $description
 * @property string $event_date
 * @property numeric $registration_fee
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EventRegistration> $registrations
 * @property-read int|null $registrations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEventName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereRegistrationFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereUpdatedAt($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $event_id
 * @property string $resident_id
 * @property string $payment_status
 * @property string|null $stripe_transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\Resident $resident
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration whereResidentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration whereStripeTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventRegistration whereUpdatedAt($value)
 */
	class EventRegistration extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $resident_id
 * @property string $incident_type
 * @property string $description
 * @property string $location_details
 * @property string $incident_date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Resident $resident
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereIncidentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereIncidentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereLocationDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereResidentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Incident whereUpdatedAt($value)
 */
	class Incident extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string|null $user_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $suffix
 * @property string $date_of_birth
 * @property string $gender
 * @property string $civil_status
 * @property string $purok_or_street
 * @property string|null $contact_number
 * @property int $is_registered_voter
 * @property string|null $occupation
 * @property string $residency_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CertificateRequest> $certificateRequests
 * @property-read int|null $certificate_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EventRegistration> $eventRegistrations
 * @property-read int|null $event_registrations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Incident> $incidents
 * @property-read int|null $incidents_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereCivilStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereIsRegisteredVoter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident wherePurokOrStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereResidencyStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereSuffix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereUserId($value)
 */
	class Resident extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CertificateRequest> $processedCertificates
 * @property-read int|null $processed_certificates_count
 * @property-read \App\Models\Resident|null $resident
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

