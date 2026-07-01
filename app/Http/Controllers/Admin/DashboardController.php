<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VipRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = VipRegistration::with('pilgrims', 'user', 'creator');

        if ($user->roles->contains('slug', 'super-admin')) {
            $registrations = $query->latest()->get();
        } elseif ($user->roles->contains('slug', 'admin')) {
            $registrations = $query->where(function ($q) use ($user) {
                $q->where('created_by', $user->id)
                  ->orWhereHas('user', function ($uq) use ($user) {
                      $uq->where('created_by', $user->id);
                  })
                  ->orWhere('user_id', $user->id);
            })->latest()->get();
        } else {
            $registrations = $query->where('user_id', $user->id)->latest()->get();
        }

        return view('admin.dashboard', compact('registrations'));
    }
}
