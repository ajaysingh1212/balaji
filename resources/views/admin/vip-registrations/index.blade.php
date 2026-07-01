@extends('layouts.admin')
@section('title','VIP Registrations')
@section('content')

<div class="ssi-wrap">

  <!-- Header -->
  <div class="ssi-hero">
    <div class="ssi-hero-text">
      <span class="ssi-eyebrow"><i class="fas fa-om"></i> Darshan Bookings</span>
      <h1>VIP Registrations</h1>
      <p>Sabhi VIP darshan bookings, payment status aur booking status ek jagah se track karein.</p>
    </div>
    <a href="{{ route('admin.vip-registrations.create') }}" class="ssi-add-btn">
      <i class="fas fa-plus"></i> Nayi Registration
    </a>
  </div>

  <!-- Stat cards -->
  <div class="ssi-stats">
    <div class="ssi-stat">
      <span class="ssi-stat-ic ssi-ic-violet"><i class="fas fa-ticket"></i></span>
      <div><b>{{ $registrations->count() }}</b><small>Total Registrations</small></div>
    </div>
    <div class="ssi-stat">
      <span class="ssi-stat-ic ssi-ic-green"><i class="fas fa-circle-check"></i></span>
      <div><b>{{ $registrations->where('payment_status','approved')->count() }}</b><small>Payment Approved</small></div>
    </div>
    <div class="ssi-stat">
      <span class="ssi-stat-ic ssi-ic-amber"><i class="fas fa-clock"></i></span>
      <div><b>{{ $registrations->where('payment_status','pending')->count() }}</b><small>Payment Pending</small></div>
    </div>
    <div class="ssi-stat">
      <span class="ssi-stat-ic ssi-ic-indigo"><i class="fas fa-square-check"></i></span>
      <div><b>{{ $registrations->where('booking_status','confirmed')->count() }}</b><small>Bookings Confirmed</small></div>
    </div>
  </div>

  <!-- Table card -->
  <div class="ssi-card">
    <div class="ssi-card-head">
      <div>
        <h3><i class="fas fa-table-list"></i> Saari Registrations</h3>
        <p>Details dekhne ke liye view button use karein.</p>
      </div>
    </div>

    <div class="table-responsive">
      <table id="vipRegistrationsTable" class="table ssi-table" style="width:100%">
        <thead>
          <tr>
            <th>Reg. No</th>
            <th>Group</th>
            <th>Mobile</th>
            <th>Service</th>
            <th>Total Amount</th>
            <th>Payment</th>
            <th>Booking</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($registrations as $registration)
          <tr>
            <td><span class="ssi-mono">{{ $registration->registration_number }}</span></td>
            <td>
              <div class="ssi-name-cell">
                <span class="ssi-avatar">{{ strtoupper(substr($registration->group_name ?? 'G',0,1)) }}</span>
                <div>
                  <b>{{ $registration->group_name ?? 'Individual' }}</b>
                  <small>{{ optional($registration->pilgrims)->count() ?? 0 }} pilgrim(s)</small>
                </div>
              </div>
            </td>
            <td>{{ $registration->mobile_number }}</td>
            <td>
              <span class="ssi-service-chip">{{ $registration->service_name }}</span>
            </td>
            <td><b>₹{{ number_format($registration->total_amount, 2) }}</b></td>
            <td>
              @if($registration->payment_status === 'approved')
                <span class="ssi-badge ssi-badge-green"><i class="fas fa-circle-check"></i> Approved</span>
              @elseif($registration->payment_status === 'rejected')
                <span class="ssi-badge ssi-badge-red"><i class="fas fa-circle-xmark"></i> Rejected</span>
              @else
                <span class="ssi-badge ssi-badge-amber"><i class="fas fa-clock"></i> Pending</span>
              @endif
            </td>
            <td>
              @if($registration->booking_status === 'confirmed')
                <span class="ssi-badge ssi-badge-green"><i class="fas fa-square-check"></i> Confirmed</span>
              @elseif($registration->booking_status === 'cancelled')
                <span class="ssi-badge ssi-badge-red"><i class="fas fa-ban"></i> Cancelled</span>
              @else
                <span class="ssi-badge ssi-badge-violet"><i class="fas fa-paper-plane"></i> Submitted</span>
              @endif
            </td>
            <td class="text-center">
              <a href="{{ route('admin.vip-registrations.show',$registration) }}" class="ssi-act ssi-act-view" title="Details dekhein">
                <i class="fas fa-eye"></i>
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8">
              <div class="ssi-empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Abhi tak koi registration nahi hai</h4>
                <p>Pehli VIP registration add karke shuru karein.</p>
                <a href="{{ route('admin.vip-registrations.create') }}" class="ssi-add-btn ssi-add-btn-sm"><i class="fas fa-plus"></i> Add Karein</a>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<style>
  :root{
    --ssi-violet:#5b21b6;
    --ssi-violet-2:#7c3aed;
    --ssi-indigo:#4338ca;
    --ssi-gold:#f59e0b;
    --ssi-green:#16a34a;
    --ssi-red:#dc2626;
    --ssi-ink:#1e1b2e;
    --ssi-muted:#6b6480;
    --ssi-line:#e9e4f7;
  }
  .ssi-wrap{font-family:'Outfit',sans-serif;color:var(--ssi-ink);}

  .ssi-hero{background:linear-gradient(120deg,var(--ssi-violet) 0%,var(--ssi-indigo) 100%);border-radius:22px;padding:30px 32px;display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap;margin-bottom:20px;box-shadow:0 20px 45px -22px rgba(91,33,182,.55);position:relative;overflow:hidden;}
  .ssi-hero::after{content:'';position:absolute;right:-60px;top:-60px;width:220px;height:220px;background:radial-gradient(circle,rgba(255,255,255,.16),transparent 70%);}
  .ssi-eyebrow{display:inline-flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#fff;background:rgba(255,255,255,.16);padding:5px 13px;border-radius:99px;margin-bottom:10px;}
  .ssi-hero h1{color:#fff;font-size:27px;font-weight:700;margin:0 0 6px;}
  .ssi-hero p{color:rgba(255,255,255,.78);font-family:'Inter',sans-serif;font-size:13.5px;margin:0;max-width:520px;}
  .ssi-add-btn{background:var(--ssi-gold);color:#3a2500;font-family:'Inter',sans-serif;font-weight:700;font-size:13.5px;padding:12px 20px;border-radius:12px;text-decoration:none;display:inline-flex;align-items:center;gap:8px;white-space:nowrap;box-shadow:0 10px 20px -8px rgba(0,0,0,.35);transition:.18s;position:relative;z-index:1;}
  .ssi-add-btn:hover{filter:brightness(1.06);color:#3a2500;transform:translateY(-1px);}
  .ssi-add-btn-sm{padding:9px 16px;font-size:12.5px;}

  .ssi-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:22px;}
  @media(max-width:900px){.ssi-stats{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:480px){.ssi-stats{grid-template-columns:1fr;}}
  .ssi-stat{background:#fff;border:1px solid var(--ssi-line);border-radius:16px;padding:16px 18px;display:flex;align-items:center;gap:14px;box-shadow:0 12px 26px -22px rgba(30,27,46,.4);}
  .ssi-stat b{display:block;font-size:19px;font-weight:700;line-height:1.2;}
  .ssi-stat small{color:var(--ssi-muted);font-family:'Inter',sans-serif;font-size:11.5px;}
  .ssi-stat-ic{flex:none;width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;}
  .ssi-ic-violet{background:linear-gradient(135deg,var(--ssi-violet-2),var(--ssi-indigo));}
  .ssi-ic-green{background:linear-gradient(135deg,#22c55e,#16a34a);}
  .ssi-ic-amber{background:linear-gradient(135deg,#fbbf24,#f59e0b);}
  .ssi-ic-indigo{background:linear-gradient(135deg,#818cf8,#4338ca);}

  .ssi-card{background:#fff;border:1px solid var(--ssi-line);border-radius:20px;padding:24px;box-shadow:0 20px 45px -30px rgba(30,27,46,.35);}
  .ssi-card-head{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:12px;margin-bottom:16px;}
  .ssi-card-head h3{margin:0;font-size:17px;font-weight:700;display:flex;align-items:center;gap:8px;}
  .ssi-card-head h3 i{color:var(--ssi-violet-2);}
  .ssi-card-head p{margin:2px 0 0;color:var(--ssi-muted);font-family:'Inter',sans-serif;font-size:12.5px;}

  .ssi-table{font-family:'Inter',sans-serif;font-size:13.5px;}
  .ssi-table thead th{background:#f7f5fc;color:#463f63;font-weight:700;font-size:11.5px;letter-spacing:.04em;text-transform:uppercase;border:none;padding:12px 14px;}
  .ssi-table tbody td{padding:12px 14px;vertical-align:middle;border-top:1px solid var(--ssi-line);}
  .ssi-table tbody tr{transition:.15s;}
  .ssi-table tbody tr:hover{background:#fbfaff;}
  .ssi-mono{font-family:'Courier New',monospace;letter-spacing:.03em;color:#443f5c;}

  .ssi-name-cell{display:flex;align-items:center;gap:12px;}
  .ssi-avatar{flex:none;width:38px;height:38px;border-radius:11px;background:linear-gradient(135deg,var(--ssi-violet-2),var(--ssi-indigo));color:#fff;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:14px;}
  .ssi-name-cell b{display:block;font-size:13.5px;}
  .ssi-name-cell small{color:var(--ssi-muted);font-size:11.5px;}

  .ssi-service-chip{background:#f2ebfd;color:#6d28d9;font-size:11.5px;font-weight:600;padding:5px 11px;border-radius:99px;display:inline-block;}

  .ssi-badge{display:inline-flex;align-items:center;gap:6px;font-size:11.5px;font-weight:600;padding:5px 11px;border-radius:99px;white-space:nowrap;}
  .ssi-badge-green{background:#ecfdf3;color:#15803d;}
  .ssi-badge-red{background:#fef2f2;color:#b91c1c;}
  .ssi-badge-amber{background:#fffbeb;color:#b45309;}
  .ssi-badge-violet{background:#f2ebfd;color:#6d28d9;}

  .ssi-actions{display:inline-flex;gap:8px;}
  .ssi-act{width:34px;height:34px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;border:none;text-decoration:none;font-size:13px;cursor:pointer;transition:.18s;}
  .ssi-act-view{background:#eef6ff;color:#1d4ed8;border:1px solid #cfe4fb;}
  .ssi-act-view:hover{background:#1d4ed8;color:#fff;}

  .ssi-empty-state{text-align:center;padding:46px 20px;font-family:'Inter',sans-serif;color:var(--ssi-muted);}
  .ssi-empty-state i{font-size:34px;color:#d7cdf3;margin-bottom:10px;}
  .ssi-empty-state h4{color:var(--ssi-ink);font-family:'Outfit',sans-serif;margin:0 0 4px;}
  .ssi-empty-state p{margin:0 0 14px;font-size:13px;}

  /* DataTables cosmetic overrides */
  .dataTables_wrapper .dataTables_filter input,
  .dataTables_wrapper .dataTables_length select{
    border:1.5px solid var(--ssi-line);border-radius:9px;padding:6px 10px;font-family:'Inter',sans-serif;
  }
  .dataTables_wrapper .dt-buttons .btn{
    background:#fff;border:1.5px solid var(--ssi-line);border-radius:9px;color:#514a6b;font-family:'Inter',sans-serif;font-size:12.5px;margin-right:6px;
  }
  .dataTables_wrapper .dt-buttons .btn:hover{border-color:var(--ssi-violet-2);color:var(--ssi-violet-2);}
  .dataTables_wrapper .paginate_button.current{
    background:var(--ssi-violet-2) !important;border-color:var(--ssi-violet-2) !important;color:#fff !important;border-radius:8px;
  }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
  $('#vipRegistrationsTable').DataTable({
    pageLength: 25,
    lengthMenu: [[10,25,50,100],[10,25,50,100]],
    responsive: true,
    dom: 'Bfrtip',
    buttons: ['copy','csv','excel','pdf','print','colvis'],
    language: {
      search: "Khojein:",
      lengthMenu: "_MENU_ entries dikhayein",
      info: "_START_ se _END_ tak, total _TOTAL_ entries",
      paginate: { previous: "Peeche", next: "Aage" },
      emptyTable: "Koi registration nahi mili"
    }
  });
});
</script>
@endsection
