<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountDetail;
use App\Models\VipPilgrim;
use App\Models\VipRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VipRegistrationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = VipRegistration::with('pilgrims', 'user', 'creator');

        if ($user->roles->contains('slug', 'super-admin')) {
            $query->latest();
        } elseif ($user->roles->contains('slug', 'admin')) {
            $query->where(function ($q) use ($user) {
                $q->where('created_by', $user->id)
                  ->orWhereHas('user', function ($uq) use ($user) {
                      $uq->where('created_by', $user->id);
                  })
                  ->orWhere('user_id', $user->id);
            })->latest();
        } else {
            $query->where('user_id', $user->id)->latest();
        }

        $registrations = $query->get();

        return view('admin.vip-registrations.index', compact('registrations'));
    }

    public function create()
    {
        $accountDetails = AccountDetail::query()
            ->where('status', 'active')
            ->where('show_on_payment_page', 'yes')
            ->get();

        return view('admin.vip-registrations.create', compact('accountDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'nullable|string',
            'mobile_number' => 'required|string',
            'email' => 'nullable|email',
            'service_name' => 'required|string',
            'seva_amount' => 'required|numeric',
            'no_of_free_laddus' => 'nullable|integer',
            'hundi_offering' => 'nullable|numeric',
            'payment_mode' => 'required|string',
            'slot' => 'nullable|string',
            'screen_short' => 'nullable|image|max:2048',
            'pilgrims' => 'required|array|min:1',
            'pilgrims.*.pilgrim_name' => 'required|string',
        ]);

        $screenShortPath = null;
        if ($request->hasFile('screen_short')) {
            $screenShortPath = $request->file('screen_short')->store('vip-payments', 'public');
        }

        $totalAmount = $request->seva_amount + ($request->hundi_offering ?? 0);

        $registration = VipRegistration::create([
            'registration_number' => 'VIP-' . strtoupper(Str::random(5)) . '-' . now()->format('YmdHis'),
            'user_id' => Auth::id(),
            'created_by' => Auth::id(),
            'group_name' => $request->group_name,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'service_name' => $request->service_name,
            'seva_amount' => $request->seva_amount,
            'no_of_free_laddus' => $request->no_of_free_laddus ?? 0,
            'hundi_offering' => $request->hundi_offering ?? 0,
            'total_amount' => $totalAmount,
            'payment_mode' => $request->payment_mode,
            'slot' => $request->slot,
            'payment_status' => 'approved',
            'booking_status' => 'confirmed',
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

        return redirect()->route('admin.vip-registrations.show', $registration)->with('success', 'VIP registration created successfully.');
    }

    public function show($id)
    {
        $registration = VipRegistration::with('pilgrims', 'user', 'creator')->findOrFail($id);

        return view('admin.vip-registrations.show', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        $registration = VipRegistration::findOrFail($id);
        $data = $request->validate([
            'payment_status' => 'required|string',
            'booking_status' => 'required|string',
            'slot' => 'nullable|string',
        ]);

        $registration->update($data);

        return back()->with('success', 'Booking updated');
    }

    public function destroy($id)
    {
        $registration = VipRegistration::findOrFail($id);
        $registration->delete();

        return back()->with('success', 'Registration deleted');
    }
}
