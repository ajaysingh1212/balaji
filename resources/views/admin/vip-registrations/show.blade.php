@extends('layouts.admin')
@section('title','Registration Details')
@section('content')

<div class="ssd-wrap">

  <!-- Header -->
  <div class="ssd-hero">
    <div class="ssd-hero-text">
      <span class="ssd-eyebrow"><i class="fas fa-ticket"></i> {{ $registration->registration_number }}</span>
      <h1>{{ $registration->group_name ?? 'Individual Registration' }}</h1>
      <p>{{ $registration->service_name }} &middot; {{ $registration->mobile_number }}</p>
    </div>
    <div class="ssd-hero-actions">
      <a href="{{ route('vip.ticket.download', $registration) }}" class="ssd-btn ssd-btn-gold"><i class="fas fa-file-pdf"></i> Ticket Download Karein</a>
      <a href="{{ route('admin.vip-registrations.index') }}" class="ssd-btn ssd-btn-ghost-light"><i class="fas fa-arrow-left"></i> List</a>
    </div>
  </div>

  <div class="ssd-grid-main">

    <!-- Left: info -->
    <div class="ssd-col">

      <div class="ssd-card">
        <h3><i class="fas fa-circle-info"></i> Registration Summary</h3>
        <div class="ssd-info-grid">
          <div class="ssd-info-item"><span>Registration Number</span><b>{{ $registration->registration_number }}</b></div>
          <div class="ssd-info-item"><span>Mobile</span><b>{{ $registration->mobile_number }}</b></div>
          <div class="ssd-info-item"><span>Service</span><b>{{ $registration->service_name }}</b></div>
          <div class="ssd-info-item"><span>Total Amount</span><b class="ssd-amount">₹{{ number_format($registration->total_amount, 2) }}</b></div>
          <div class="ssd-info-item"><span>Slot</span><b>{{ $registration->slot ?? 'Pending' }}</b></div>
          <div class="ssd-info-item"><span>Booking Date</span><b>{{ optional($registration->booking_date)->format('d-m-Y') ?? 'Not set' }}</b></div>
          <div class="ssd-info-item"><span>Created By</span><b>{{ $registration->creator?->name ?? 'N/A' }}</b></div>
        </div>
      </div>

      <div class="ssd-card">
        <h3><i class="fas fa-receipt"></i> Payment Information</h3>
        <div class="ssd-info-grid">
          <div class="ssd-info-item"><span>UTR Number</span><b>{{ $registration->utr_number ?? 'N/A' }}</b></div>
          <div class="ssd-info-item"><span>Payment Mode</span><b>{{ $registration->payment_mode ?? 'N/A' }}</b></div>
        </div>
        @if($registration->screen_short)
        <div class="ssd-screenshot">
          <span class="ssd-screenshot-label">Payment Screenshot</span>
          <img src="{{ asset('storage/'.$registration->screen_short) }}" alt="Payment screenshot">
        </div>
        @endif
      </div>

      <div class="ssd-card">
        <h3><i class="fas fa-users"></i> Pilgrims</h3>
        <div class="ssd-pilgrim-list">
          @forelse($registration->pilgrims as $pilgrim)
          <div class="ssd-pilgrim-row">
            <span class="ssd-pilgrim-avatar">{{ strtoupper(substr($pilgrim->pilgrim_name ?? 'P',0,1)) }}</span>
            <div class="ssd-pilgrim-meta">
              <b>{{ $pilgrim->pilgrim_name }}</b>
              <small>{{ $pilgrim->gender ?? '-' }} &middot; {{ $pilgrim->age ?? '-' }} yrs</small>
            </div>
            <span class="ssd-pilgrim-code">{{ $pilgrim->unique_code }}</span>
          </div>
          @empty
          <p class="ssd-muted">Koi pilgrim add nahi kiya gaya hai.</p>
          @endforelse
        </div>
      </div>

    </div>

    <!-- Right: status update -->
    <div class="ssd-col ssd-col-side">
      <div class="ssd-card ssd-sticky">
        <h3><i class="fas fa-sliders"></i> Status Update Karein</h3>
        <form method="POST" action="{{ route('admin.vip-registrations.update',$registration) }}">
          @csrf @method('PUT')
          <div class="ssd-field">
            <label>Payment Status</label>
            <select name="payment_status" class="ssd-input">
              <option value="pending" @selected($registration->payment_status=='pending')>Pending</option>
              <option value="approved" @selected($registration->payment_status=='approved')>Approved</option>
              <option value="rejected" @selected($registration->payment_status=='rejected')>Rejected</option>
            </select>
          </div>
          <div class="ssd-field">
            <label>Booking Status</label>
            <select name="booking_status" class="ssd-input">
              <option value="submitted" @selected($registration->booking_status=='submitted')>Submitted</option>
              <option value="confirmed" @selected($registration->booking_status=='confirmed')>Confirmed</option>
              <option value="cancelled" @selected($registration->booking_status=='cancelled')>Cancelled</option>
            </select>
          </div>
          <div class="ssd-field">
            <label>Slot</label>
            <input name="slot" class="ssd-input" value="{{ $registration->slot }}" placeholder="e.g. 10:00 AM">
          </div>
          <div class="ssd-field">
            <label>Booking Date</label>
            <input type="date" name="booking_date" class="ssd-input" value="{{ optional($registration->booking_date)->format('Y-m-d') }}">
          </div>
          <button class="ssd-btn ssd-btn-primary ssd-btn-block"><i class="fas fa-floppy-disk"></i> Registration Update Karein</button>
        </form>
      </div>

      <div class="ssd-card ssd-status-card">
        <h3><i class="fas fa-flag"></i> Current Status</h3>
        <div class="ssd-status-row">
          <span>Payment</span>
          @if($registration->payment_status === 'approved')
            <span class="ssd-badge ssd-badge-green"><i class="fas fa-circle-check"></i> Approved</span>
          @elseif($registration->payment_status === 'rejected')
            <span class="ssd-badge ssd-badge-red"><i class="fas fa-circle-xmark"></i> Rejected</span>
          @else
            <span class="ssd-badge ssd-badge-amber"><i class="fas fa-clock"></i> Pending</span>
          @endif
        </div>
        <div class="ssd-status-row">
          <span>Booking</span>
          @if($registration->booking_status === 'confirmed')
            <span class="ssd-badge ssd-badge-green"><i class="fas fa-square-check"></i> Confirmed</span>
          @elseif($registration->booking_status === 'cancelled')
            <span class="ssd-badge ssd-badge-red"><i class="fas fa-ban"></i> Cancelled</span>
          @else
            <span class="ssd-badge ssd-badge-violet"><i class="fas fa-paper-plane"></i> Submitted</span>
          @endif
        </div>
      </div>
    </div>

  </div>
</div>

<style>
  :root{
    --ssd-violet:#5b21b6;
    --ssd-violet-2:#7c3aed;
    --ssd-indigo:#4338ca;
    --ssd-gold:#f59e0b;
    --ssd-green:#16a34a;
    --ssd-red:#dc2626;
    --ssd-ink:#1e1b2e;
    --ssd-muted:#6b6480;
    --ssd-line:#e9e4f7;
  }
  .ssd-wrap{font-family:'Outfit',sans-serif;color:var(--ssd-ink);}

  .ssd-hero{background:linear-gradient(120deg,var(--ssd-violet) 0%,var(--ssd-indigo) 100%);border-radius:22px;padding:28px 30px;display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap;margin-bottom:22px;box-shadow:0 20px 45px -22px rgba(91,33,182,.55);position:relative;overflow:hidden;}
  .ssd-hero::after{content:'';position:absolute;right:-60px;top:-60px;width:220px;height:220px;background:radial-gradient(circle,rgba(255,255,255,.16),transparent 70%);}
  .ssd-eyebrow{display:inline-flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fff;background:rgba(255,255,255,.16);padding:5px 13px;border-radius:99px;margin-bottom:10px;font-family:'Inter',sans-serif;}
  .ssd-hero h1{color:#fff;font-size:25px;font-weight:700;margin:0 0 4px;}
  .ssd-hero p{color:rgba(255,255,255,.78);font-family:'Inter',sans-serif;font-size:13.5px;margin:0;}
  .ssd-hero-actions{display:flex;gap:10px;flex-wrap:wrap;position:relative;z-index:1;}
  .ssd-btn{border:none;border-radius:11px;padding:11px 18px;font-family:'Inter',sans-serif;font-weight:600;font-size:13px;cursor:pointer;display:inline-flex;align-items:center;gap:8px;text-decoration:none;transition:.18s;}
  .ssd-btn-gold{background:var(--ssd-gold);color:#3a2500;box-shadow:0 10px 20px -8px rgba(0,0,0,.35);}
  .ssd-btn-gold:hover{filter:brightness(1.06);color:#3a2500;}
  .ssd-btn-ghost-light{background:rgba(255,255,255,.14);color:#fff;border:1px solid rgba(255,255,255,.35);}
  .ssd-btn-ghost-light:hover{background:rgba(255,255,255,.22);color:#fff;}
  .ssd-btn-primary{background:linear-gradient(135deg,var(--ssd-violet-2),var(--ssd-indigo));color:#fff;box-shadow:0 10px 22px -10px rgba(91,33,182,.6);}
  .ssd-btn-primary:hover{filter:brightness(1.08);color:#fff;}
  .ssd-btn-block{width:100%;justify-content:center;margin-top:6px;}

  .ssd-grid-main{display:grid;grid-template-columns:1.6fr 1fr;gap:20px;align-items:start;}
  @media(max-width:960px){.ssd-grid-main{grid-template-columns:1fr;}}
  .ssd-col{display:flex;flex-direction:column;gap:20px;}
  .ssd-sticky{position:sticky;top:16px;}
  @media(max-width:960px){.ssd-sticky{position:relative;top:0;}}

  .ssd-card{background:#fff;border:1px solid var(--ssd-line);border-radius:18px;padding:22px;box-shadow:0 16px 36px -28px rgba(30,27,46,.35);}
  .ssd-card h3{margin:0 0 16px;font-size:15.5px;font-weight:700;display:flex;align-items:center;gap:8px;}
  .ssd-card h3 i{color:var(--ssd-violet-2);}

  .ssd-info-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px 18px;}
  @media(max-width:520px){.ssd-info-grid{grid-template-columns:1fr;}}
  .ssd-info-item{font-family:'Inter',sans-serif;}
  .ssd-info-item span{display:block;font-size:11px;color:var(--ssd-muted);text-transform:uppercase;letter-spacing:.04em;margin-bottom:3px;}
  .ssd-info-item b{font-size:14px;color:var(--ssd-ink);}
  .ssd-amount{color:var(--ssd-violet-2);font-size:16px !important;}

  .ssd-screenshot{margin-top:18px;padding-top:16px;border-top:1px solid var(--ssd-line);}
  .ssd-screenshot-label{display:block;font-family:'Inter',sans-serif;font-size:12px;font-weight:600;color:#443f5c;margin-bottom:8px;}
  .ssd-screenshot img{max-width:280px;width:100%;border-radius:12px;border:1px solid var(--ssd-line);}

  .ssd-pilgrim-list{display:flex;flex-direction:column;gap:10px;}
  .ssd-pilgrim-row{display:flex;align-items:center;gap:12px;background:#fbfaff;border:1px solid var(--ssd-line);border-radius:12px;padding:10px 14px;}
  .ssd-pilgrim-avatar{flex:none;width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,var(--ssd-violet-2),var(--ssd-indigo));color:#fff;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;font-family:'Inter',sans-serif;}
  .ssd-pilgrim-meta{flex:1;font-family:'Inter',sans-serif;}
  .ssd-pilgrim-meta b{display:block;font-size:13.5px;}
  .ssd-pilgrim-meta small{color:var(--ssd-muted);font-size:11.5px;}
  .ssd-pilgrim-code{font-family:'Courier New',monospace;font-size:11.5px;background:#f2ebfd;color:#6d28d9;padding:4px 9px;border-radius:99px;}
  .ssd-muted{color:var(--ssd-muted);font-family:'Inter',sans-serif;font-size:13px;margin:0;}

  .ssd-field{margin-bottom:14px;}
  .ssd-field label{display:block;font-family:'Inter',sans-serif;font-size:12.5px;font-weight:600;color:#443f5c;margin-bottom:6px;}
  .ssd-input{width:100%;border:1.5px solid var(--ssd-line);background:#fff;border-radius:11px;padding:10px 13px;font-family:'Inter',sans-serif;font-size:13.5px;color:var(--ssd-ink);transition:.18s;}
  .ssd-input:focus{outline:none;border-color:var(--ssd-violet-2);box-shadow:0 0 0 4px rgba(124,58,237,.14);}

  .ssd-status-card .ssd-status-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-top:1px solid var(--ssd-line);font-family:'Inter',sans-serif;font-size:13px;}
  .ssd-status-card .ssd-status-row:first-of-type{border-top:none;}
  .ssd-badge{display:inline-flex;align-items:center;gap:6px;font-size:11.5px;font-weight:600;padding:5px 11px;border-radius:99px;}
  .ssd-badge-green{background:#ecfdf3;color:#15803d;}
  .ssd-badge-red{background:#fef2f2;color:#b91c1c;}
  .ssd-badge-amber{background:#fffbeb;color:#b45309;}
  .ssd-badge-violet{background:#f2ebfd;color:#6d28d9;}
</style>
@endsection
