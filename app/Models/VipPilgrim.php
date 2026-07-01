<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipPilgrim extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id', 'pilgrim_name', 'gender', 'age', 'unique_code', 'contact_no', 'address'
    ];

    public function registration()
    {
        return $this->belongsTo(VipRegistration::class, 'registration_id');
    }
}
