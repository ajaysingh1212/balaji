<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountDetailController extends Controller
{
    public function index()
    {
        $accounts = AccountDetail::latest()->get();

        return view('admin.account-details.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.account-details.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'account_holder_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'confirm_account_number' => 'nullable|string|same:account_number',
            'ifsc_code' => 'required|string',
            'branch_name' => 'nullable|string',
            'account_type' => 'required|string',
            'upi_number' => 'nullable|string',
            'upi_id' => 'nullable|string',
            'swift_code' => 'nullable|string',
            'micr_code' => 'nullable|string',
            'gst_number' => 'nullable|string',
            'pan_number' => 'nullable|string',
            'payment_instructions' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'show_on_payment_page' => 'required|in:yes,no',
            'upi_qr_code' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('upi_qr_code')) {
            $data['upi_qr_code'] = $request->file('upi_qr_code')->store('account-details', 'public');
        }

        AccountDetail::create($data);

        return redirect()->route('admin.account-details.index')->with('success', 'Account detail saved');
    }

    public function edit($id)
    {
        $account = AccountDetail::findOrFail($id);

        return view('admin.account-details.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $account = AccountDetail::findOrFail($id);

        $data = $request->validate([
            'account_holder_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'confirm_account_number' => 'nullable|string|same:account_number',
            'ifsc_code' => 'required|string',
            'branch_name' => 'nullable|string',
            'account_type' => 'required|string',
            'upi_number' => 'nullable|string',
            'upi_id' => 'nullable|string',
            'swift_code' => 'nullable|string',
            'micr_code' => 'nullable|string',
            'gst_number' => 'nullable|string',
            'pan_number' => 'nullable|string',
            'payment_instructions' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'show_on_payment_page' => 'required|in:yes,no',
            'upi_qr_code' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('upi_qr_code')) {
            if ($account->upi_qr_code) {
                Storage::disk('public')->delete($account->upi_qr_code);
            }
            $data['upi_qr_code'] = $request->file('upi_qr_code')->store('account-details', 'public');
        }

        $account->update($data);

        return redirect()->route('admin.account-details.index')->with('success', 'Account detail updated');
    }

    public function destroy($id)
    {
        $account = AccountDetail::findOrFail($id);

        if ($account->upi_qr_code) {
            Storage::disk('public')->delete($account->upi_qr_code);
        }

        $account->delete();

        return back()->with('success', 'Account detail deleted');
    }
}
