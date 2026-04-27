<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\CertificateRequest;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Pagination\LengthAwarePaginator;

class ResidentPageController extends Controller
{
    public function incidents()
    {
        $user = auth()->user();
        if ($user->resident) {
            $incidents = Incident::where('resident_id', $user->resident->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $incidents = new LengthAwarePaginator([], 0, 10);
        }
        return view('resident.incidents', ['incidents' => $incidents]);
    }

    public function showIncident($id)
    {
        $user = auth()->user();
        if (!$user->resident) { abort(403); }
        $incident = Incident::where('resident_id', $user->resident->id)->findOrFail($id);
        return view('resident.incident-show', ['incident' => $incident]);
    }

    public function certificates()
    {
        $user = auth()->user();
        if ($user->resident) {
            $certificates = CertificateRequest::where('resident_id', $user->resident->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $certificates = new LengthAwarePaginator([], 0, 10);
        }
        return view('resident.certificates', ['certificates' => $certificates]);
    }

    public function showCertificate($id)
    {
        $user = auth()->user();
        if (!$user->resident) { abort(403); }
        $certificate = CertificateRequest::where('resident_id', $user->resident->id)->findOrFail($id);
        return view('resident.certificate-show', ['certificate' => $certificate]);
    }

    public function events()
    {
        $user = auth()->user();
        $events = Event::where('status', 'Upcoming')->orderBy('event_date', 'asc')->get();
        $joinedEvents = collect();
        
        if ($user->resident) {
            $joinedEvents = EventRegistration::with('event')
                ->where('resident_id', $user->resident->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('resident.events', ['events' => $events, 'joinedEvents' => $joinedEvents]);
    }

    public function showEvent($id)
    {
        $event = Event::findOrFail($id);
        $user = auth()->user();
        $isRegistered = false;
        $registration = null;
        
        if ($user->resident) {
            $registration = EventRegistration::where('event_id', $id)
                ->where('resident_id', $user->resident->id)
                ->first();
            if ($registration) {
                $isRegistered = true;
            }
        }
        return view('resident.event-show', ['event' => $event, 'isRegistered' => $isRegistered, 'registration' => $registration]);
    }
}