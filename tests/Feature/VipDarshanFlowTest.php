<?php

namespace Tests\Feature;

use App\Models\VipPilgrim;
use App\Models\VipRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VipDarshanFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_contains_vip_entry_darshan_heading(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('VIP Entry Darshan');
    }

    public function test_status_page_contains_registration_search_fields(): void
    {
        $response = $this->get('/vip/status');

        $response->assertStatus(200);
        $response->assertSee('Registration Number');
        $response->assertSee('Mobile Number');
    }

    public function test_ticket_download_returns_pdf_for_registration(): void
    {
        $registration = VipRegistration::create([
            'registration_number' => 'VIP-TEST-123456',
            'user_id' => null,
            'created_by' => null,
            'group_name' => 'Test Group',
            'mobile_number' => '9999999999',
            'email' => 'test@example.com',
            'service_name' => 'VIP Darshan',
            'seva_amount' => 100.00,
            'no_of_free_laddus' => 0,
            'hundi_offering' => 0,
            'total_amount' => 100.00,
            'payment_mode' => 'UPI',
            'tr_date_time' => now(),
            'payment_status' => 'approved',
            'booking_status' => 'confirmed',
            'slot' => '10:00 AM',
        ]);

        VipPilgrim::create([
            'registration_id' => $registration->id,
            'pilgrim_name' => 'Test Pilgrim',
            'gender' => 'Male',
            'age' => 30,
            'unique_code' => 'PIL-001',
            'contact_no' => '9999999999',
            'address' => 'Test Address',
        ]);

        $response = $this->get(route('vip.ticket.download', $registration));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
