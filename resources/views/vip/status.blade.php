<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check VIP Registration Status | {{ $settings->site_name ?? 'TTD' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Mukta:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --maroon-deep:#450D13;
            --maroon:#6B1420;
            --gold:#C99A2E;
            --gold-bright:#F3C969;
            --gold-pale:#F6E3B4;
            --saffron:#E1652C;
            --cream:#FFF8EA;
            --cream-2:#FCEFD6;
            --ink:#2B140F;
            --ink-soft:#6B4A34;
            --green:#1E7A46;
            --green-bg:#E4F5EA;
            --amber:#B4740A;
            --amber-bg:#FCF0D8;
            --red:#B23636;
            --red-bg:#FBE7E7;
            --ease:cubic-bezier(.22,.7,.24,1);
        }
        *{box-sizing:border-box;}
        body{margin:0;font-family:'Mukta',sans-serif;color:var(--ink);background:
            radial-gradient(ellipse at 10% -10%,rgba(201,154,46,.14),transparent 40%),
            linear-gradient(180deg,var(--cream),#fff9ee 55%,var(--cream));min-height:100vh;}
        h1,h2,h3{font-family:'Cormorant Garamond',serif;margin:0;}
        a{color:inherit;}
        @media (prefers-reduced-motion: reduce){*{animation-duration:.001ms !important;}}

        .nav{display:flex;align-items:center;justify-content:space-between;padding:18px 6%;border-bottom:1px solid rgba(201,154,46,.22);}
        .logo-wrap{display:flex;align-items:center;gap:12px;}
        .logo{width:46px;height:46px;object-fit:contain;}
        .brand{font-family:'Cormorant Garamond',serif;font-weight:700;font-size:1.25rem;color:var(--maroon-deep);}
        .nav a.back{font-weight:600;font-size:.92rem;color:var(--ink-soft);text-decoration:none;display:flex;align-items:center;gap:6px;}
        .nav a.back:hover{color:var(--saffron);}

        .wrap{max-width:760px;margin:0 auto;padding:56px 6% 90px;}
        .page-eyebrow{display:block;text-align:center;color:var(--saffron);font-weight:700;letter-spacing:.06em;text-transform:uppercase;font-size:.8rem;margin-bottom:10px;}
        .page-title{text-align:center;font-size:clamp(2rem,4vw,2.6rem);color:var(--maroon-deep);margin-bottom:12px;}
        .page-sub{text-align:center;color:var(--ink-soft);max-width:480px;margin:0 auto 40px;line-height:1.7;}

        .search-card{background:#fff;border:1px solid var(--cream-2);border-radius:20px;padding:34px 32px;box-shadow:0 20px 55px -36px rgba(107,20,32,.45);}
        .field{margin-bottom:18px;}
        .field label{display:block;font-weight:600;font-size:.88rem;margin-bottom:8px;color:var(--maroon-deep);}
        .field input{width:100%;padding:14px 16px;border-radius:12px;border:1.5px solid #ecdcc4;font-size:.98rem;font-family:'Mukta',sans-serif;transition:border-color .2s var(--ease);}
        .field input:focus{outline:none;border-color:var(--gold);}
        .or-divider{display:flex;align-items:center;gap:12px;margin:6px 0 22px;color:var(--ink-soft);font-size:.82rem;font-weight:700;letter-spacing:.05em;}
        .or-divider:before,.or-divider:after{content:'';flex:1;height:1px;background:var(--cream-2);}
        .form-note{font-size:.82rem;color:var(--ink-soft);margin-bottom:20px;}
        .form-error{background:var(--red-bg);color:var(--red);border:1px solid #f3c9c9;padding:12px 16px;border-radius:12px;font-size:.88rem;font-weight:600;margin-bottom:18px;}
        button.submit{width:100%;padding:16px;border-radius:12px;border:none;background:linear-gradient(135deg,var(--maroon),var(--maroon-deep));color:var(--gold-pale);font-weight:700;font-size:1rem;letter-spacing:.01em;box-shadow:0 16px 34px -18px rgba(69,13,19,.7);cursor:pointer;transition:transform .2s var(--ease);}
        button.submit:hover{transform:translateY(-2px);}

        .fade-in{animation:fadeUp .6s var(--ease) both;}
        @keyframes fadeUp{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:none;}}

        /* Result card */
        .result{margin-top:36px;background:#fff;border:1px solid var(--cream-2);border-radius:20px;overflow:hidden;box-shadow:0 20px 55px -36px rgba(107,20,32,.45);}
        .result-head{background:linear-gradient(135deg,var(--maroon),var(--maroon-deep));padding:26px 30px;color:#fff;display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:14px;}
        .result-head .reg-no{font-family:'Poppins',sans-serif;font-weight:700;font-size:1.15rem;letter-spacing:.02em;}
        .result-head .reg-label{display:block;font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;color:var(--gold-pale);opacity:.85;margin-bottom:4px;}
        .badges{display:flex;gap:10px;flex-wrap:wrap;}
        .badge{padding:7px 14px;border-radius:999px;font-size:.78rem;font-weight:700;letter-spacing:.02em;text-transform:capitalize;}
        .badge.green{background:var(--green-bg);color:var(--green);}
        .badge.amber{background:var(--amber-bg);color:var(--amber);}
        .badge.red{background:var(--red-bg);color:var(--red);}

        .result-body{padding:30px;}
        .info-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px 26px;margin-bottom:26px;}
        .info-item span.label{display:block;font-size:.76rem;text-transform:uppercase;letter-spacing:.04em;color:var(--ink-soft);margin-bottom:4px;}
        .info-item span.value{font-weight:600;font-size:.98rem;}

        table.pilgrim-table{width:100%;border-collapse:collapse;margin-bottom:26px;}
        table.pilgrim-table th{text-align:left;font-size:.75rem;text-transform:uppercase;letter-spacing:.04em;color:var(--ink-soft);padding:10px 12px;border-bottom:2px solid var(--cream-2);}
        table.pilgrim-table td{padding:12px;border-bottom:1px solid var(--cream-2);font-size:.92rem;}
        table.pilgrim-table tr:last-child td{border-bottom:none;}

        .amount-summary{background:var(--cream);border-radius:14px;padding:18px 22px;margin-bottom:26px;}
        .amount-row{display:flex;justify-content:space-between;padding:6px 0;font-size:.92rem;color:var(--ink-soft);}
        .amount-row.total{border-top:1px dashed var(--gold);margin-top:8px;padding-top:12px;font-weight:700;color:var(--maroon-deep);font-size:1.05rem;}

        .result-actions{display:flex;gap:14px;flex-wrap:wrap;}
        .btn-action{flex:1;min-width:200px;text-align:center;padding:14px 18px;border-radius:12px;font-weight:700;text-decoration:none;font-size:.92rem;transition:transform .2s var(--ease);}
        .btn-primary{background:linear-gradient(135deg,var(--saffron),var(--gold));color:#fff;box-shadow:0 14px 30px -16px rgba(225,101,44,.6);}
        .btn-secondary{background:#fff;color:var(--maroon-deep);border:1.5px solid var(--cream-2);}
        .btn-action:hover{transform:translateY(-2px);}

        /* Empty state */
        .empty-state{margin-top:36px;background:#fff;border:1px dashed #ecdcc4;border-radius:20px;padding:46px 30px;text-align:center;}
        .empty-state .icon{width:56px;height:56px;border-radius:50%;background:var(--cream-2);display:grid;place-items:center;margin:0 auto 16px;font-size:1.4rem;color:var(--saffron);}
        .empty-state h3{font-size:1.4rem;color:var(--maroon-deep);margin-bottom:8px;}
        .empty-state p{color:var(--ink-soft);font-size:.92rem;max-width:340px;margin:0 auto;line-height:1.7;}

        @media (max-width:600px){
            .info-grid{grid-template-columns:1fr;}
            .result-head{flex-direction:column;}
        }
    </style>
</head>
<body>
<nav class="nav">
    <div class="logo-wrap">
        <img class="logo" src="{{ $settings && $settings->logo ? asset('storage/'.$settings->logo) : asset('images/logo.png') }}" alt="logo">
        <span class="brand">{{ $settings->site_name ?? 'TTD' }}</span>
    </div>
    <a href="{{ route('vip.landing') }}" class="back">&larr; Back to home</a>
</nav>

<div class="wrap">
    <span class="page-eyebrow">Booking Lookup</span>
    <h1 class="page-title">Check Your Registration Status</h1>
    <p class="page-sub">Enter your Registration Number or the Mobile Number used at booking — either one is enough to pull up your details.</p>

    <div class="search-card fade-in">
        @if($errors->any())
        <div class="form-error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('vip.status.search') }}" id="statusForm">
            @csrf
            <div class="field">
                <label for="registration_number">Registration Number</label>
                <input type="text" id="registration_number" name="registration_number" placeholder="e.g. VIP-AB12C-20260701" value="{{ old('registration_number') }}">
            </div>
            <div class="or-divider">OR</div>
            <div class="field">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" id="mobile_number" name="mobile_number" placeholder="10-digit mobile number" value="{{ old('mobile_number') }}">
            </div>
            <div class="form-note">Fill in either field above to fetch your full booking details.</div>
            <button type="submit" class="submit">Search Booking</button>
        </form>
    </div>

    @if(!empty($searched))
        @if($registration)
        @php
            $payStatus = strtolower($registration->payment_status ?? '');
            $payClass = $payStatus === 'approved' || $payStatus === 'paid' ? 'green' : ($payStatus === 'rejected' || $payStatus === 'failed' ? 'red' : 'amber');
            $bookStatus = strtolower($registration->booking_status ?? '');
            $bookClass = $bookStatus === 'approved' || $bookStatus === 'confirmed' ? 'green' : ($bookStatus === 'rejected' || $bookStatus === 'cancelled' ? 'red' : 'amber');
        @endphp
        <div class="result fade-in">
            <div class="result-head">
                <div>
                    <span class="reg-label">Registration Number</span>
                    <span class="reg-no">{{ $registration->registration_number }}</span>
                </div>
                <div class="badges">
                    <span class="badge {{ $payClass }}">Payment: {{ ucfirst($registration->payment_status ?? 'Pending') }}</span>
                    <span class="badge {{ $bookClass }}">Booking: {{ ucfirst($registration->booking_status ?? 'Submitted') }}</span>
                </div>
            </div>
            <div class="result-body">
                <div class="info-grid">
                    <div class="info-item"><span class="label">Service</span><span class="value">{{ $registration->service_name }}</span></div>
                    <div class="info-item"><span class="label">Group Name</span><span class="value">{{ $registration->group_name ?? 'Individual' }}</span></div>
                    <div class="info-item"><span class="label">Mobile Number</span><span class="value">{{ $registration->mobile_number }}</span></div>
                    <div class="info-item"><span class="label">Slot</span><span class="value">{{ $registration->slot ?? 'To be assigned' }}</span></div>
                    <div class="info-item"><span class="label">Booked On</span><span class="value">{{ optional($registration->created_at)->format('d M Y, h:i A') }}</span></div>
                    <div class="info-item"><span class="label">No. of Pilgrims</span><span class="value">{{ $registration->pilgrims->count() }}</span></div>
                </div>

                @if($registration->pilgrims->count())
                <table class="pilgrim-table">
                    <thead>
                        <tr><th>Pilgrim Name</th><th>Gender / Age</th><th>Contact No.</th></tr>
                    </thead>
                    <tbody>
                        @foreach($registration->pilgrims as $pilgrim)
                        <tr>
                            <td>{{ $pilgrim->pilgrim_name }}</td>
                            <td>{{ $pilgrim->gender ?? '-' }} / {{ $pilgrim->age ?? '-' }}</td>
                            <td>{{ $pilgrim->contact_no ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

                <div class="amount-summary">
                    <div class="amount-row"><span>Seva Amount</span><span>₹{{ number_format($registration->seva_amount ?? 0, 0) }}</span></div>
                    <div class="amount-row"><span>Free Laddus</span><span>{{ $registration->no_of_free_laddus ?? 0 }}</span></div>
                    <div class="amount-row"><span>Hundi Offering</span><span>₹{{ number_format($registration->hundi_offering ?? 0, 0) }}</span></div>
                    <div class="amount-row total"><span>Total Amount</span><span>₹{{ number_format($registration->total_amount ?? 0, 0) }}</span></div>
                </div>

                <div class="result-actions">
                    <a href="{{ route('vip.ticket.preview', $registration->id) }}" target="_blank" class="btn-action btn-secondary">Preview Ticket</a>
                    <a href="{{ route('vip.ticket.download', $registration->id) }}" class="btn-action btn-primary">Download Ticket PDF</a>
                </div>
            </div>
        </div>
        @else
        <div class="empty-state fade-in">
            <div class="icon">!</div>
            <h3>No booking found</h3>
            <p>We couldn't find a registration matching those details. Please double-check the Registration Number or Mobile Number and try again.</p>
        </div>
        @endif
    @endif
</div>

<script>
document.getElementById('statusForm').addEventListener('submit', function(e){
    var reg = document.getElementById('registration_number').value.trim();
    var mob = document.getElementById('mobile_number').value.trim();
    if(!reg && !mob){
        e.preventDefault();
        alert('Please enter either a Registration Number or a Mobile Number.');
    }
});
</script>
</body>
</html>
