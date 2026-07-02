<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VIP Darshan Ticket - {{ $registration->registration_number }}</title>
    <style>
        /* DomPDF-safe CSS only: tables + floats, no flexbox/grid/box-shadow/backdrop-filter */
        @page { margin: 18px 22px; }
        * { box-sizing: border-box; }
        body { margin:0; font-family: 'Helvetica', 'Arial', sans-serif; color:#1a1a1a; font-size:12px; }

        .ticket { border: 2px solid #000; padding: 14px 18px 10px; page-break-after: always; }
        .ticket.last { page-break-after: auto; }

        table.head { width:100%; border-collapse:collapse; margin-bottom:2px; }
        table.head td { vertical-align:middle; padding:0; }
        .head .logo-cell { width:76px; text-align:left;height:76px; vertical-align:middle; }
        .head .logo-cell img { width:66px; height:66px; }
        .head .title-cell { padding:0 14px; vertical-align:middle; }
        .head .title-cell h1 { font-size:20px; margin:0 0 2px; font-weight:bold; letter-spacing:.2px; color:#1a1a1a; }
        .head .title-cell h2 { font-size:14px; margin:0 0 7px; font-weight:bold; color:#6B1420; text-transform:uppercase; letter-spacing:.4px; }
        .head .title-cell .meta { border-left:2px solid #C99A2E; padding-left:8px; }
        .head .title-cell p { font-size:10.5px; margin:2px 0; color:#444; line-height:1.45; }
        .head .badge-cell { width:118px; text-align:center; vertical-align:top; }
        .head .badge-cell .badge-box { border:1px solid #C99A2E; border-radius:4px; padding:6px 8px 8px; background-color:#FFF8EA; }
        .head .badge-cell img { width:70px; height:70px; display:block; margin:0 auto 6px; }
        .head .badge-cell .aadhaar { font-size:11px; font-weight:bold; color:#1a1a1a; }
        .head .badge-cell .pcount { font-size:10px; margin-top:2px; color:#444; }

        .hr-main { border:none; border-top:2px solid #450D13; margin:8px 0 0; }
        .hr-accent { border:none; border-top:1px solid #C99A2E; margin:2px 0 12px; }

        table.content { width:100%; border-collapse:collapse; table-layout:fixed; }
        table.content td { vertical-align:top; padding:14px 16px; border:1px solid #000; }
        .box-left { background-color:#d9e3f5; width:50%; }
        .box-right { background-color:#fbe3ce; width:50%; }
        .box-left p, .box-right p { margin:5px 0; font-size:12px; line-height:1.5; }
        .box-left strong, .box-right strong { font-weight:bold; }
        .box-right .info-title { font-weight:bold; font-size:13px; margin-bottom:8px; display:block; }
        .box-right ol { margin:0; padding-left:16px; }
        .box-right ol li { margin-bottom:5px; font-size:11.5px; line-height:1.5; }

        table.footer { width:100%; border-collapse:collapse; margin-top:14px; }
        table.footer td { padding:0; font-size:11px; vertical-align:middle; }
        .footer .note { font-style:italic; color:#333; }
        .footer .officer { text-align:right; font-weight:bold; }
    </style>
</head>
<body>
@php
    if (!function_exists('vipMaskNumber')) {
        function vipMaskNumber($num) {
            $digits = preg_replace('/\D/', '', (string) $num);
            if (strlen($digits) <= 4) { return $digits ?: '-'; }
            return str_repeat('X', strlen($digits) - 4) . substr($digits, -4);
        }
    }
    $reportAddress = ($settings->office_address ?? null) ?: 'TTD Administrative Building K T Road Mandapam, Tirumala Tirupati';
    $reportDateTime = $registration->slot
        ?? optional($registration->tr_date_time)->format('Y-m-d h:i A')
        ?? optional($registration->created_at)->format('Y-m-d h:i A');
    $logoSrc = $logoPath ?? (\App\Support\UploadService::resolvePublicPath(optional($settings)->logo));
    $pilgrimCount = $registration->pilgrims->count();

    // Build a plain-text pilgrim roster (name, age, gender) so scanning the
    // QR code shows every pilgrim in this booking, not just the one on this page.
    $qrLines = ['VIP Darshan - Group ID: ' . $registration->registration_number];
    foreach ($registration->pilgrims as $qi => $qp) {
        $qrLines[] = ($qi + 1) . '. ' . $qp->pilgrim_name . ' - ' . ($qp->gender ?? '-') . ', Age ' . ($qp->age ?? '-');
    }
    $qrDataText = implode("\n", $qrLines);

    $qrCodeSrc = null;
    try {
        if (class_exists(\SimpleSoftwareIO\QrCode\Facades\QrCode::class)) {
            $qrSvg = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(140)->margin(0)->generate($qrDataText);
            $qrCodeSrc = 'data:image/svg+xml;base64,' . base64_encode($qrSvg);
        }
    } catch (\Throwable $e) {
        // Package missing/misconfigured (composer require simplesoftwareio/simple-qrcode)
        // — the badge box below just renders without the QR image instead of breaking the PDF.
        $qrCodeSrc = null;
    }
@endphp

@foreach($registration->pilgrims as $index => $pilgrim)
<div class="ticket {{ $loop->last ? 'last' : '' }}">
    <table class="head">
        <tr>
            <td class="logo-cell">
                @if(file_exists($logoSrc))
                <img src="{{ $logoSrc }}" alt="logo">
                @endif
            </td>
            <td class="title-cell">
                <h1>{{ $settings->company_name ?? 'Tirumala Tirupati Devasthanam\'s' }}</h1>
                <h2>{{ $registration->service_name ?? 'VIP Entry Darshan (TTD)' }}</h2>
                <div class="meta">
                    <p>Report at: {{ $reportAddress }}</p>
                    <p style="margin:0; font-size:22px; font-weight:bold; font-family:'Marcellus',serif;">{{ $reportDateTime }} - Booking Date  {{ $registration->booking_date }}</p>
                </div>
            </td>
            <td class="badge-cell">
                <div class="badge-box">
                    @if($qrCodeSrc)
                    <img src="{{ $qrCodeSrc }}" alt="QR code with pilgrim details">
                    @endif
                    <div class="aadhaar">{{ $pilgrim->photo_id_type ?? 'Aadhaar' }}/{{ substr(preg_replace('/\D/', '', (string) ($pilgrim->photo_id_number ?? $pilgrim->contact_no ?? '')), -4) ?: '-' }}</div>
                    <div class="pcount">No. of Pilgrims: {{ $pilgrimCount }}</div>
                </div>
            </td>
        </tr>
    </table>

    <hr class="hr-main">
    <hr class="hr-accent">

    <table class="content">
        <tr>
            <td class="box-left">
                <p><strong>Pilgrim Name:</strong> {{ $pilgrim->pilgrim_name }}</p>
                <p><strong>Gender/Age:</strong> {{ $pilgrim->gender ?? '-' }}/{{ $pilgrim->age ?? '-' }}</p>
                <p><strong>Photo ID Type / Number:</strong> {{ $pilgrim->photo_id_type ?? 'NULL' }}/{{ $pilgrim->photo_id_number ?? substr(preg_replace('/\D/', '', (string) ($pilgrim->contact_no ?? '')), -4) ?: '-' }}</p>
                <p><strong>Group Booking ID:</strong> {{ $registration->registration_number }}</p>
                <p><strong>Contact No.:</strong> {{ vipMaskNumber($pilgrim->contact_no ?? $registration->mobile_number) }}</p>
                <p><strong>Address:</strong> {{ $pilgrim->address ?? $registration->group_name ?? '-' }}</p>
                <p><strong>Service Name:</strong> {{ $registration->service_name }}</p>
                <p><strong>Seva Amount:</strong> ₹{{ number_format($registration->seva_amount ?? 0, 0) }}</p>
                <p><strong>No. of free Laddus:</strong> {{ $registration->no_of_free_laddus ?? 0 }}</p>
                <p><strong>Hundi Offering:</strong> ₹{{ number_format($registration->hundi_offering ?? 0, 0) }}</p>
                <p><strong>Total Amount:</strong> ₹{{ number_format($registration->total_amount ?? 0, 0) }}</p>
                <p><strong>Payment Status:</strong> {{ $registration->payment_status ?? '-' }}</p>
                <p><strong>Booking Status:</strong> {{ $registration->booking_status ?? '-' }}</p>
            </td>
            <td class="box-right">
                <span class="info-title">Important Information to the Pilgrims:</span>
                <ol>
                    <li>The reporting point for seva/ darshan is SD Mandapam, Tirumala.</li>
                    <li>Pilgrims should bring printed receipt.</li>
                    <li>Carry valid photo ID.</li>
                    <li>Wear traditional dress only.</li>
                    <li>No electronic gadgets allowed.</li>
                    <li>Group must report together.</li>
                    <li>Children below 12 not allowed for some sevas.</li>
                    <li>Prasadam within 24 hrs.</li>
                    <li>No cancellation allowed.</li>
                    <li>Darshan may be cancelled by TTD.</li>
                    <li>Health issue pilgrims avoid climbing.</li>
                </ol>
            </td>
        </tr>
    </table>
  
    <table class="footer">
        <tr>
            <td class="note">Note: Electronically generated details do not require any signature</td>
            <td class="officer">Executive Officer, TTD</td>
        </tr>
    </table>
</div>
@endforeach
</body>
</html>
