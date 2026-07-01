@extends('layouts.admin')
@section('title','Site Settings')
@section('content')

<div class="ssi-wrap">

  <!-- Header -->
  <div class="ssi-hero">
    <div class="ssi-hero-text">
      <span class="ssi-eyebrow"><i class="fas fa-sliders"></i> Configuration Center</span>
      <h1>Site Settings</h1>
      <p>Apni saari websites ki branding, SEO aur contact details ek hi jagah se manage karein.</p>
    </div>
    <a href="{{ route('admin.site-settings.create') }}" class="ssi-add-btn">
      <i class="fas fa-plus"></i> Nayi Setting Add Karein
    </a>
  </div>

  <!-- Stat cards -->
  <div class="ssi-stats">
    <div class="ssi-stat">
      <span class="ssi-stat-ic ssi-ic-violet"><i class="fas fa-globe"></i></span>
      <div><b>{{ $settings->count() }}</b><small>Total Configurations</small></div>
    </div>
    <div class="ssi-stat">
      <span class="ssi-stat-ic ssi-ic-green"><i class="fas fa-image"></i></span>
      <div><b>{{ $settings->whereNotNull('logo')->count() }}</b><small>Logo Uploaded</small></div>
    </div>
    <div class="ssi-stat">
      <span class="ssi-stat-ic ssi-ic-amber"><i class="fas fa-star"></i></span>
      <div><b>{{ $settings->whereNotNull('favicon')->count() }}</b><small>Favicon Set</small></div>
    </div>
    <div class="ssi-stat">
      <span class="ssi-stat-ic ssi-ic-indigo"><i class="fas fa-circle-check"></i></span>
      <div><b>{{ $settings->count() ? 'Active' : '—' }}</b><small>System Status</small></div>
    </div>
  </div>

  <!-- Table card -->
  <div class="ssi-card">
    <div class="ssi-card-head">
      <div>
        <h3><i class="fas fa-table-list"></i> Saari Settings</h3>
        <p>Kisi bhi row ko edit ya delete kar sakte hain.</p>
      </div>
    </div>

    <div class="table-responsive">
      <table id="siteSettingsTable" class="table ssi-table" style="width:100%">
        <thead>
          <tr>
            <th>Site</th>
            <th>Logo</th>
            <th>Favicon</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($settings as $setting)
          <tr>
            <td>
              <div class="ssi-name-cell">
                <span class="ssi-avatar">{{ strtoupper(substr($setting->site_name ?? 'S',0,1)) }}</span>
                <div>
                  <b>{{ $setting->site_name ?? 'Untitled Site' }}</b>
                  <small>{{ $setting->tagline ?? 'Koi tagline nahi hai' }}</small>
                </div>
              </div>
            </td>
            <td>
              @if($setting->logo)
                <img src="{{ asset('storage/'.$setting->logo) }}" class="ssi-thumb">
              @else
                <span class="ssi-empty-chip"><i class="fas fa-ban"></i> Nahi hai</span>
              @endif
            </td>
            <td>
              @if($setting->favicon)
                <img src="{{ asset('storage/'.$setting->favicon) }}" class="ssi-thumb ssi-thumb-sm">
              @else
                <span class="ssi-empty-chip"><i class="fas fa-ban"></i> Nahi hai</span>
              @endif
            </td>
            <td class="text-center">
              <div class="ssi-actions">
                <a href="{{ route('admin.site-settings.edit',$setting) }}" class="ssi-act ssi-act-edit" title="Edit karein">
                  <i class="fas fa-pen"></i>
                </a>
                <form action="{{ route('admin.site-settings.destroy',$setting) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Kya aap sach mein delete karna chahte hain?');">
                  @csrf @method('DELETE')
                  <button type="submit" class="ssi-act ssi-act-del" title="Delete karein">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4">
              <div class="ssi-empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Abhi tak koi setting nahi hai</h4>
                <p>Apni pehli site setting add karke shuru karein.</p>
                <a href="{{ route('admin.site-settings.create') }}" class="ssi-add-btn ssi-add-btn-sm"><i class="fas fa-plus"></i> Add Karein</a>
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

  .ssi-name-cell{display:flex;align-items:center;gap:12px;}
  .ssi-avatar{flex:none;width:38px;height:38px;border-radius:11px;background:linear-gradient(135deg,var(--ssi-violet-2),var(--ssi-indigo));color:#fff;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:14px;}
  .ssi-name-cell b{display:block;font-size:13.5px;}
  .ssi-name-cell small{color:var(--ssi-muted);font-size:11.5px;}

  .ssi-thumb{width:56px;height:56px;object-fit:contain;border:1px solid var(--ssi-line);border-radius:10px;background:#fafafa;padding:4px;}
  .ssi-thumb-sm{width:36px;height:36px;}
  .ssi-empty-chip{display:inline-flex;align-items:center;gap:6px;color:#a39cbd;font-size:11.5px;background:#f6f4fb;padding:5px 10px;border-radius:99px;}

  .ssi-actions{display:inline-flex;gap:8px;}
  .ssi-act{width:34px;height:34px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;border:none;text-decoration:none;font-size:13px;cursor:pointer;transition:.18s;}
  .ssi-act-edit{background:#fff7e6;color:#b45309;border:1px solid #fde3ad;}
  .ssi-act-edit:hover{background:#f59e0b;color:#fff;}
  .ssi-act-del{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;}
  .ssi-act-del:hover{background:#dc2626;color:#fff;}

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
  $('#siteSettingsTable').DataTable({
    pageLength: 25,
    responsive: true,
    dom: 'Bfrtip',
    buttons: ['copy','csv','excel','pdf','print','colvis'],
    language: {
      search: "Khojein:",
      lengthMenu: "_MENU_ entries dikhayein",
      info: "_START_ se _END_ tak, total _TOTAL_ entries",
      paginate: { previous: "Peeche", next: "Aage" },
      emptyTable: "Koi setting record nahi mila"
    }
  });
});
</script>
@endsection
