<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_holder_name', 'bank_name', 'account_number', 'confirm_account_number', 'ifsc_code', 'branch_name',
        'account_type', 'upi_number', 'upi_id', 'upi_qr_code', 'swift_code', 'micr_code', 'gst_number', 'pan_number',
        'payment_instructions', 'status', 'show_on_payment_page',
    ];
}
