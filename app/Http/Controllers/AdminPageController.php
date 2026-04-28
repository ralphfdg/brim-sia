<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificateRequest;
use App\Models\Incident;
use App\Models\Event;

class AdminPageController extends Controller
{
    public function dashboard()
    {
        // 1. Stat Counters
        $stats = [
            'pending_certs' => \App\Models\CertificateRequest::where('request_status', 'Pending')->count(),
            'ready_certs' => \App\Models\CertificateRequest::where('request_status', 'Ready')->count(),
            'active_incidents' => \App\Models\Incident::where('status', 'Pending')->count(),
            'upcoming_events' => \App\Models\Event::where('status', 'Upcoming')->count(),
        ];

        // 2. Table Data (Recent 5 Incidents)
        $recentIncidents = \App\Models\Incident::with('resident')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Calendar Data
        $events = \App\Models\Event::orderBy('event_date', 'asc')->get();

        // Send it all to the view
        return view('admin.dashboard', compact('stats', 'recentIncidents', 'events'));
    }

    public function incidents()
    {
        $incidents = Incident::with('resident')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.incidents', compact('incidents'));
    }

    public function showIncident($id)
    {
        $incident = Incident::with('resident')->findOrFail($id);
        return view('admin.incident-show', compact('incident'));
    }

    public function updateIncident(Request $request, $id)
    {
        // FIX: Replaced old statuses with the correct DB Enums
        $request->validate(['status' => 'required|in:Pending,Under Investigation,Resolved']);
        $incident = Incident::findOrFail($id);
        $incident->update(['status' => $request->status]);
        return response()->json(['message' => 'Incident status updated successfully']);
    }

    public function certificates()
    {
        $certificates = CertificateRequest::with('resident')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.certificates', compact('certificates'));
    }

    public function showCertificate($id)
    {
        $certificate = CertificateRequest::with('resident')->findOrFail($id);
        return view('admin.certificate-show', compact('certificate'));
    }

    public function events()
    {
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('admin.events', compact('events'));
    }

    public function showEvent($id)
    {
        $event = Event::with('registrations.resident')->findOrFail($id);
        return view('admin.event-show', compact('event'));
    }
}