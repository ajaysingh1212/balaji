<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP Registration Success</title>
    <style>
        body { margin:0; font-family:Arial,sans-serif; background:#fff7ef; }
        .container { max-width:760px; margin:40px auto; background:#fff; padding:48px; border-radius:30px; box-shadow:0 15px 40px rgba(0,0,0,0.08);}
        .badge { display:inline-block; background:#f3e3d5; color:#8d4400; padding:8px 14px; border-radius:999px; font-weight:700; }
        .box { background:#fffaf3; padding:18px; border-radius:18px; margin-top:20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="badge">Booking Submitted</div>
    <h1>VIP Registration Successful</h1>
    <p>Your registration number is <strong>{{ $registration->registration_number }}</strong>.</p>
    <div class="box">
        <p><strong>Mobile:</strong> {{ $registration->mobile_number }}</p>
        <p><strong>Service:</strong> {{ $registration->service_name }}</p>
        <p><strong>Total Amount:</strong> {{ $registration->total_amount }}</p>
        <p><strong>Payment Status:</strong> {{ $registration->payment_status }}</p>
        <p><strong>Booking Status:</strong> {{ $registration->booking_status }}</p>
    </div>
    <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:20px;">
        <a href="{{ route('vip.status') }}" style="display:inline-block;background:#8d4400;color:#fff;text-decoration:none;padding:14px 24px;border-radius:16px;">Check Status</a>
        <a href="{{ route('vip.ticket.preview', $registration) }}" target="_blank" style="display:inline-block;background:#fff6ed;color:#8d4400;text-decoration:none;padding:14px 24px;border-radius:16px;border:1px solid #efcdb2;">Preview Ticket PDF</a>
        <a href="{{ route('vip.ticket.download', $registration) }}" style="display:inline-block;background:#fff6ed;color:#8d4400;text-decoration:none;padding:14px 24px;border-radius:16px;border:1px solid #efcdb2;">Download Ticket PDF</a>
    </div>
</div>
</body>
</html>
