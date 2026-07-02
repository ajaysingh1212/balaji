<?php

namespace App\Http\Controllers;

use App\Models\AccountDetail;
use App\Models\SiteSetting;
use App\Models\VipPilgrim;
use App\Models\VipRegistration;
use App\Support\UploadService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class VipDarshanController extends Controller
{
    public function landing()
    {
        $settings = null;

        if (Schema::hasTable('site_settings')) {
            $settings = SiteSetting::orderByDesc('created_at')->first();
        }

        return view('vip.landing', compact('settings'));
    }

    public function statusForm()
    {
        $settings = null;
        if (Schema::hasTable('site_settings')) {
            $settings = SiteSetting::orderByDesc('created_at')->first();
        }

        return view('vip.status', compact('settings'));
    }

    public function statusSearch(Request $request)
    {
        $request->validate([
            'registration_number' => 'nullable|string|required_without:mobile_number',
            'mobile_number' => 'nullable|string|required_without:registration_number',
        ], [
            'registration_number.required_without' => 'Please enter a Registration Number or a Mobile Number.',
            'mobile_number.required_without' => 'Please enter a Registration Number or a Mobile Number.',
        ]);

        $settings = null;
        if (Schema::hasTable('site_settings')) {
            $settings = SiteSetting::orderByDesc('created_at')->first();
        }

        $query = VipRegistration::query()->with('pilgrims');

        if ($request->filled('registration_number')) {
            $query->where('registration_number', 'like', '%' . $request->registration_number . '%');
        }

        if ($request->filled('mobile_number')) {
            $query->where('mobile_number', 'like', '%' . $request->mobile_number . '%');
        }

        $registration = $query->orderByDesc('created_at')->first();

        // $searched tells the view a lookup actually happened, so it can
        // correctly tell "not searched yet" apart from "no booking found"
        // (a null $registration would otherwise fail an isset() check).
        $searched = true;

        return view('vip.status', compact('registration', 'settings', 'searched'));
    }

    public function create()
    {
        $accountDetails = AccountDetail::query()
            ->where('status', 'active')
            ->where('show_on_payment_page', 'yes')
            ->get();

        $settings = null;
        if (Schema::hasTable('site_settings')) {
            $settings = SiteSetting::orderByDesc('created_at')->first();
        }

        return view('vip.create', compact('accountDetails', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'nullable|string',
            'mobile_number' => 'required|string',
            'booking_date' => 'required|date',
            'photo_id_number' => 'required|string',
            'email' => 'nullable|email',
            'service_name' => 'required|string',
            'seva_amount' => 'required|numeric',
            'no_of_free_laddus' => 'nullable|integer',
            'hundi_offering' => 'nullable|numeric',
            'utr_number' => 'required|string',
            'screen_short' => 'required|image|max:2048',
            'pilgrims' => 'required|array|min:1',
            'pilgrims.*.pilgrim_name' => 'required|string',
            'pilgrims.*.gender' => 'nullable|string',
            'pilgrims.*.age' => 'nullable|integer',
            'pilgrims.*.contact_no' => 'nullable|string',
            'pilgrims.*.address' => 'nullable|string',
        ]);

        $totalAmount = ($request->seva_amount * max(1, count($request->pilgrims ?? []))) + ($request->hundi_offering ?? 0);

        $screenShortPath = null;
        if ($request->hasFile('screen_short')) {
            $screenShortPath = UploadService::storePublicFile($request->file('screen_short'), 'vip-payments');
        }

        $registration = VipRegistration::create([
            'registration_number' => 'VIP-' . strtoupper(Str::random(5)) . '-' . now()->format('YmdHis'),
            'user_id' => Auth::id(),
            'created_by' => Auth::id(),
            'group_name' => $request->group_name,
            'booking_date' => $request->booking_date,
            'photo_id_number' => $request->photo_id_number,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'service_name' => $request->service_name,
            'seva_amount' => $request->seva_amount,
            'no_of_free_laddus' => $request->no_of_free_laddus ?? 0,
            'hundi_offering' => $request->hundi_offering ?? 0,
            'total_amount' => $totalAmount,
            'payment_mode' => 'Bank Transfer',
            'tr_date_time' => now(),
            'payment_status' => $screenShortPath ? 'pending' : 'pending',
            'booking_status' => 'submitted',
            'screen_short' => $screenShortPath,
            'utr_number' => $request->utr_number,
        ]);

        foreach ($request->pilgrims as $pilgrimData) {
            VipPilgrim::create([
                'registration_id' => $registration->id,
                'pilgrim_name' => $pilgrimData['pilgrim_name'],
                'gender' => $pilgrimData['gender'] ?? null,
                'age' => $pilgrimData['age'] ?? null,
                'unique_code' => strtoupper(Str::random(5)) . str_pad((string) $registration->id, 9, '0', STR_PAD_LEFT),
                'contact_no' => $pilgrimData['contact_no'] ?? null,
                'address' => $pilgrimData['address'] ?? null,
            ]);
        }

        return redirect()->route('vip.success', ['id' => $registration->id]);
    }

    public function success($id)
    {
        $registration = VipRegistration::with('pilgrims')->findOrFail($id);
        return view('vip.success', compact('registration'));
    }

    public function previewTicket($id)
    {
        $registration = VipRegistration::with('pilgrims')->findOrFail($id);

        $settings = null;
        if (Schema::hasTable('site_settings')) {
            $settings = SiteSetting::orderByDesc('created_at')->first();
        }

        $pdf = Pdf::loadView('vip.ticket', compact('registration', 'settings'));

        return $pdf->stream('VIP-Darshan-Ticket-' . $registration->registration_number . '.pdf');
    }

    public function downloadTicket($id)
    {
        $registration = VipRegistration::with('pilgrims')->findOrFail($id);

        $settings = null;
        if (Schema::hasTable('site_settings')) {
            $settings = SiteSetting::orderByDesc('created_at')->first();
        }

        $pdf = Pdf::loadView('vip.ticket', compact('registration', 'settings'));

        return $pdf->download('VIP-Darshan-Ticket-' . $registration->registration_number . '.pdf');
    }
}
