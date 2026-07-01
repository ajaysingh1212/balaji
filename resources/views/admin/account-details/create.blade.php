@extends('layouts.admin')
@section('title','Create Account Detail')
@section('content')

<div class="ssw-wrap">
  <div class="ssw-head">
    <div>
      <span class="ssw-eyebrow">Banking Setup</span>
      <h1 class="ssw-title">Naya Account Detail Add Karein</h1>
      <p class="ssw-sub">Payment page par yeh account customers ko dikhega — sahi details bharein.</p>
    </div>
    <a href="{{ route('admin.account-details.index') }}" class="ssw-back"><i class="fas fa-arrow-left"></i> List par wapas</a>
  </div>

  <form method="POST" action="{{ route('admin.account-details.store') }}" enctype="multipart/form-data" id="sswForm" novalidate>
    @csrf

    <div class="ssw-shell">
      <!-- Rail / Stepper -->
      <aside class="ssw-rail">
        <ol class="ssw-steps" id="sswSteps">
          <li class="ssw-step is-active" data-step="1">
            <span class="ssw-step-dot"><i class="fas fa-building-columns"></i></span>
            <span class="ssw-step-text"><b>Bank Details</b><small>Account &amp; IFSC</small></span>
          </li>
          <li class="ssw-step" data-step="2">
            <span class="ssw-step-dot"><i class="fas fa-qrcode"></i></span>
            <span class="ssw-step-text"><b>Digital Payments</b><small>UPI, SWIFT, QR</small></span>
          </li>
          <li class="ssw-step" data-step="3">
            <span class="ssw-step-dot"><i class="fas fa-file-invoice"></i></span>
            <span class="ssw-step-text"><b>Tax &amp; Instructions</b><small>GST, PAN, notes</small></span>
          </li>
          <li class="ssw-step" data-step="4">
            <span class="ssw-step-dot"><i class="fas fa-eye"></i></span>
            <span class="ssw-step-text"><b>Visibility</b><small>Status &amp; display</small></span>
          </li>
        </ol>
        <div class="ssw-progress-wrap">
          <div class="ssw-progress-label"><span id="sswProgressText">Step 1 / 4</span><span id="sswProgressPct">25%</span></div>
          <div class="ssw-progress-bar"><div class="ssw-progress-fill" id="sswProgressFill"></div></div>
        </div>
      </aside>

      <!-- Panel -->
      <section class="ssw-panel">

        <div class="ssw-pane is-active" data-pane="1">
          <div class="ssw-pane-head"><span class="ssw-badge">01</span><div><h2>Bank Details</h2><p>Yeh sabse zaroori jaankari hai — dhyan se bharein.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>Account Holder Name <b class="ssw-req">*</b></label><input name="account_holder_name" class="ssw-input" value="{{ old('account_holder_name') }}" required></div>
            <div class="ssw-field"><label>Bank Name <b class="ssw-req">*</b></label><input name="bank_name" class="ssw-input" value="{{ old('bank_name') }}" required></div>
            <div class="ssw-field"><label>Account Number <b class="ssw-req">*</b></label><input name="account_number" class="ssw-input" value="{{ old('account_number') }}" required></div>
            <div class="ssw-field"><label>Confirm Account Number</label><input name="confirm_account_number" class="ssw-input" value="{{ old('confirm_account_number') }}"></div>
            <div class="ssw-field"><label>IFSC Code <b class="ssw-req">*</b></label><input name="ifsc_code" class="ssw-input" placeholder="Jaise: SBIN0001234" style="text-transform:uppercase" value="{{ old('ifsc_code') }}" required></div>
            <div class="ssw-field"><label>Branch Name</label><input name="branch_name" class="ssw-input" value="{{ old('branch_name') }}"></div>
            <div class="ssw-field">
              <label>Account Type</label>
              <select name="account_type" class="ssw-input">
                <option value="Saving">Saving</option>
                <option value="Current">Current</option>
              </select>
            </div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="2">
          <div class="ssw-pane-head"><span class="ssw-badge">02</span><div><h2>Digital Payments</h2><p>UPI aur QR code se instant payment lena aasan ho jayega.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>UPI ID</label><input name="upi_id" class="ssw-input" placeholder="name@bank" value="{{ old('upi_id') }}"></div>
            <div class="ssw-field"><label>UPI Number</label><input name="upi_number" class="ssw-input" value="{{ old('upi_number') }}"></div>
            <div class="ssw-field"><label>SWIFT Code</label><input name="swift_code" class="ssw-input" placeholder="International transfer ke liye" value="{{ old('swift_code') }}"></div>
            <div class="ssw-field"><label>MICR Code</label><input name="micr_code" class="ssw-input" value="{{ old('micr_code') }}"></div>
            <div class="ssw-field ssw-span2">
              <label>UPI QR Code</label>
              <div class="ssw-drop" data-target="upiPreview" style="max-width:260px;">
                <img id="upiPreview" class="ssw-preview d-none">
                <i class="fas fa-cloud-arrow-up"></i><span>QR image choose karein</span>
                <input type="file" name="upi_qr_code" accept="image/*" onchange="sswPreview(this,'upiPreview')">
              </div>
            </div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="3">
          <div class="ssw-pane-head"><span class="ssw-badge">03</span><div><h2>Tax &amp; Payment Instructions</h2><p>Invoice aur receipts par yeh details use hoti hain.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>GST Number</label><input name="gst_number" class="ssw-input" placeholder="22AAAAA0000A1Z5" value="{{ old('gst_number') }}"></div>
            <div class="ssw-field"><label>PAN Number</label><input name="pan_number" class="ssw-input" placeholder="AAAAA0000A" value="{{ old('pan_number') }}"></div>
            <div class="ssw-field ssw-span2"><label>Payment Instructions</label><textarea name="payment_instructions" class="ssw-input" rows="4" placeholder="Customer ke liye extra note, jaise: payment ke baad screenshot WhatsApp par bhejein">{{ old('payment_instructions') }}</textarea></div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="4">
          <div class="ssw-pane-head"><span class="ssw-badge">04</span><div><h2>Visibility &amp; Status</h2><p>Decide karein yeh account kahan aur kaise dikhega.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field">
              <label>Status</label>
              <select name="status" class="ssw-input">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
            <div class="ssw-field">
              <label>Show on Payment Page</label>
              <select name="show_on_payment_page" class="ssw-input">
                <option value="yes">Yes — Customers ko dikhega</option>
                <option value="no">No — Sirf internal use</option>
              </select>
            </div>
          </div>
        </div>

        <div class="ssw-actions">
          <button type="button" class="ssw-btn ssw-btn-ghost" id="sswPrev"><i class="fas fa-arrow-left"></i> Peeche</button>
          <div class="ssw-actions-right">
            <span class="ssw-autosave"><i class="fas fa-shield-halved"></i> Details encrypted store hoti hain</span>
            <button type="button" class="ssw-btn ssw-btn-primary" id="sswNext">Aage Badhein <i class="fas fa-arrow-right"></i></button>
            <button type="submit" class="ssw-btn ssw-btn-success d-none" id="sswSubmit"><i class="fas fa-check"></i> Account Save Karein</button>
          </div>
        </div>

      </section>
    </div>
  </form>
</div>

<style>
  :root{
    --ssw-violet:#5b21b6;
    --ssw-violet-2:#7c3aed;
    --ssw-indigo:#4338ca;
    --ssw-gold:#f59e0b;
    --ssw-ink:#1e1b2e;
    --ssw-muted:#6b6480;
    --ssw-line:#e9e4f7;
    --ssw-glass:rgba(255,255,255,.86);
  }
  .ssw-wrap{font-family:'Outfit',sans-serif;color:var(--ssw-ink);}
  .ssw-head{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:14px;margin-bottom:22px;}
  .ssw-eyebrow{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ssw-violet-2);background:#efe7fd;padding:4px 12px;border-radius:99px;margin-bottom:8px;}
  .ssw-title{font-size:28px;font-weight:700;margin:0 0 4px;background:linear-gradient(90deg,var(--ssw-violet) 0%,var(--ssw-indigo) 100%);-webkit-background-clip:text;background-clip:text;color:transparent;}
  .ssw-sub{margin:0;color:var(--ssw-muted);font-family:'Inter',sans-serif;font-size:14px;}
  .ssw-back{font-family:'Inter',sans-serif;font-size:13px;font-weight:600;color:var(--ssw-violet-2);text-decoration:none;padding:9px 16px;border:1px solid var(--ssw-line);border-radius:10px;background:#fff;white-space:nowrap;}
  .ssw-back:hover{background:var(--ssw-violet-2);color:#fff;border-color:var(--ssw-violet-2);}

  .ssw-shell{display:grid;grid-template-columns:280px 1fr;gap:22px;align-items:start;}
  @media(max-width:991px){.ssw-shell{grid-template-columns:1fr;}}

  .ssw-rail{background:linear-gradient(165deg,var(--ssw-violet) 0%,var(--ssw-indigo) 100%);border-radius:20px;padding:22px 16px;position:sticky;top:16px;box-shadow:0 18px 40px -18px rgba(91,33,182,.55);}
  @media(max-width:991px){.ssw-rail{position:relative;top:0;}}
  .ssw-steps{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:4px;}
  .ssw-step{display:flex;align-items:center;gap:12px;padding:10px 10px;border-radius:12px;cursor:pointer;transition:.2s;opacity:.55;}
  .ssw-step:hover{opacity:.85;background:rgba(255,255,255,.08);}
  .ssw-step.is-active{opacity:1;background:rgba(255,255,255,.14);}
  .ssw-step.is-done{opacity:1;}
  .ssw-step-dot{flex:none;width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.35);display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;}
  .ssw-step.is-active .ssw-step-dot{background:var(--ssw-gold);border-color:var(--ssw-gold);color:#3a2500;}
  .ssw-step.is-done .ssw-step-dot{background:#22c55e;border-color:#22c55e;color:#06280f;}
  .ssw-step-text{display:flex;flex-direction:column;line-height:1.15;font-family:'Inter',sans-serif;}
  .ssw-step-text b{color:#fff;font-size:13px;font-weight:600;}
  .ssw-step-text small{color:rgba(255,255,255,.65);font-size:11px;}
  .ssw-progress-wrap{padding-top:14px;border-top:1px solid rgba(255,255,255,.18);font-family:'Inter',sans-serif;}
  .ssw-progress-label{display:flex;justify-content:space-between;color:#fff;font-size:12px;margin-bottom:6px;font-weight:600;}
  .ssw-progress-bar{height:8px;background:rgba(255,255,255,.18);border-radius:99px;overflow:hidden;}
  .ssw-progress-fill{height:100%;width:25%;background:var(--ssw-gold);border-radius:99px;transition:width .35s ease;}

  .ssw-panel{background:var(--ssw-glass);border:1px solid var(--ssw-line);border-radius:20px;padding:28px;box-shadow:0 20px 45px -30px rgba(30,27,46,.35);min-height:420px;display:flex;flex-direction:column;}
  .ssw-pane{display:none;flex:1;animation:sswFade .3s ease;}
  .ssw-pane.is-active{display:block;}
  @keyframes sswFade{from{opacity:0;transform:translateY(6px);}to{opacity:1;transform:translateY(0);}}
  .ssw-pane-head{display:flex;gap:14px;align-items:flex-start;margin-bottom:22px;}
  .ssw-badge{flex:none;width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,var(--ssw-violet-2),var(--ssw-indigo));color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;}
  .ssw-pane-head h2{margin:0;font-size:19px;font-weight:700;}
  .ssw-pane-head p{margin:2px 0 0;color:var(--ssw-muted);font-family:'Inter',sans-serif;font-size:13px;}

  .ssw-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px 18px;}
  @media(max-width:640px){.ssw-grid{grid-template-columns:1fr;}}
  .ssw-span2{grid-column:span 2;}
  @media(max-width:640px){.ssw-span2{grid-column:span 1;}}
  .ssw-field label{display:block;font-family:'Inter',sans-serif;font-size:12.5px;font-weight:600;color:#443f5c;margin-bottom:6px;}
  .ssw-req{color:#dc2626;}
  .ssw-input{width:100%;border:1.5px solid var(--ssw-line);background:#fff;border-radius:11px;padding:11px 14px;font-family:'Inter',sans-serif;font-size:13.5px;color:var(--ssw-ink);transition:.18s;}
  .ssw-input:focus{outline:none;border-color:var(--ssw-violet-2);box-shadow:0 0 0 4px rgba(124,58,237,.14);}
  textarea.ssw-input{resize:vertical;}

  .ssw-drop{position:relative;border:2px dashed var(--ssw-line);border-radius:14px;background:#fbfaff;min-height:130px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;color:var(--ssw-muted);font-family:'Inter',sans-serif;font-size:12.5px;overflow:hidden;transition:.2s;}
  .ssw-drop:hover{border-color:var(--ssw-violet-2);background:#f5f0ff;}
  .ssw-drop i{font-size:20px;color:var(--ssw-violet-2);}
  .ssw-drop input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;}
  .ssw-preview{position:absolute;inset:0;width:100%;height:100%;object-fit:contain;background:#fff;padding:10px;}

  .ssw-actions{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:14px;margin-top:24px;padding-top:20px;border-top:1px solid var(--ssw-line);}
  .ssw-actions-right{display:flex;align-items:center;gap:14px;flex-wrap:wrap;}
  .ssw-autosave{font-family:'Inter',sans-serif;font-size:11.5px;color:var(--ssw-muted);}
  .ssw-btn{border:none;border-radius:11px;padding:11px 22px;font-family:'Inter',sans-serif;font-weight:600;font-size:13.5px;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:.18s;}
  .ssw-btn-ghost{background:#fff;border:1.5px solid var(--ssw-line);color:#514a6b;}
  .ssw-btn-ghost:hover{border-color:var(--ssw-violet-2);color:var(--ssw-violet-2);}
  .ssw-btn-primary{background:linear-gradient(135deg,var(--ssw-violet-2),var(--ssw-indigo));color:#fff;box-shadow:0 10px 22px -10px rgba(91,33,182,.6);}
  .ssw-btn-primary:hover{filter:brightness(1.08);}
  .ssw-btn-success{background:linear-gradient(135deg,#16a34a,#22c55e);color:#fff;box-shadow:0 10px 22px -10px rgba(22,163,74,.55);}
</style>

<script>
(function(){
  const steps = document.querySelectorAll('#sswSteps .ssw-step');
  const panes = document.querySelectorAll('.ssw-pane');
  const total = steps.length;
  let current = 1;

  function render(){
    steps.forEach(s=>{
      const n = +s.dataset.step;
      s.classList.toggle('is-active', n===current);
      s.classList.toggle('is-done', n<current);
    });
    panes.forEach(p=> p.classList.toggle('is-active', +p.dataset.pane===current));
    document.getElementById('sswProgressText').textContent = 'Step '+current+' / '+total;
    document.getElementById('sswProgressPct').textContent = Math.round((current/total)*100)+'%';
    document.getElementById('sswProgressFill').style.width = (current/total*100)+'%';
    document.getElementById('sswPrev').style.visibility = current===1 ? 'hidden' : 'visible';
    document.getElementById('sswNext').classList.toggle('d-none', current===total);
    document.getElementById('sswSubmit').classList.toggle('d-none', current!==total);
    document.querySelector('.ssw-panel').scrollIntoView({behavior:'smooth', block:'start'});
  }

  document.getElementById('sswNext').addEventListener('click', function(){
    if(current<total){ current++; render(); }
  });
  document.getElementById('sswPrev').addEventListener('click', function(){
    if(current>1){ current--; render(); }
  });
  steps.forEach(s=>{
    s.addEventListener('click', function(){ current = +this.dataset.step; render(); });
  });

  render();
})();

function sswPreview(input, targetId){
  const img = document.getElementById(targetId);
  if(input.files && input.files[0]){
    const reader = new FileReader();
    reader.onload = e => { img.src = e.target.result; img.classList.remove('d-none'); };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection
