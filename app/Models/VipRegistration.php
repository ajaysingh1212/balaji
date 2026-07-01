<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number', 'user_id', 'created_by', 'group_name', 'mobile_number', 'email', 'service_name', 'seva_amount',
        'no_of_free_laddus', 'hundi_offering', 'total_amount', 'payment_mode', 'tr_date_time', 'payment_status', 'booking_status',
        'screen_short', 'utr_number', 'slot', 'notes', 'booking_date','photo_id_number'
    ];

    protected $casts = [
        'tr_date_time' => 'datetime',
        'seva_amount' => 'decimal:2',
        'hundi_offering' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function pilgrims()
    {
        return $this->hasMany(VipPilgrim::class, 'registration_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
