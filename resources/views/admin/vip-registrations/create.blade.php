@extends('layouts.admin')
@section('title','Create VIP Registration')
@section('content')

<div class="ssw-wrap">
  <div class="ssw-head">
    <div>
      <span class="ssw-eyebrow"><i class="fas fa-om"></i> Darshan Booking</span>
      <h1 class="ssw-title">Nayi VIP Registration</h1>
      <p class="ssw-sub">Group ki jaankari, pilgrims aur payment proof — teen step mein poori booking ban jayegi.</p>
    </div>
    <a href="{{ route('admin.vip-registrations.index') }}" class="ssw-back"><i class="fas fa-arrow-left"></i> List par wapas</a>
  </div>

  <form method="POST" action="{{ route('admin.vip-registrations.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    <input type="hidden" name="payment_mode" value="Admin Bypass">

    <div class="ssw-shell">
      <!-- Rail / Stepper -->
      <aside class="ssw-rail">
        <ol class="ssw-steps" id="sswSteps">
          <li class="ssw-step is-active" data-step="1">
            <span class="ssw-step-dot"><i class="fas fa-hands-praying"></i></span>
            <span class="ssw-step-text"><b>Service &amp; Group</b><small>Package select karein</small></span>
          </li>
          <li class="ssw-step" data-step="2">
            <span class="ssw-step-dot"><i class="fas fa-users"></i></span>
            <span class="ssw-step-text"><b>Pilgrim Details</b><small>Darshan karne wale</small></span>
          </li>
          <li class="ssw-step" data-step="3">
            <span class="ssw-step-dot"><i class="fas fa-receipt"></i></span>
            <span class="ssw-step-text"><b>Payment Proof</b><small>Optional</small></span>
          </li>
        </ol>
        <div class="ssw-progress-wrap">
          <div class="ssw-progress-label"><span id="sswProgressText">Step 1 / 3</span><span id="sswProgressPct">33%</span></div>
          <div class="ssw-progress-bar"><div class="ssw-progress-fill" id="sswProgressFill"></div></div>
        </div>
        <div class="ssw-rail-total">
          <span>Total Amount</span>
          <b id="totalAmountDisplay">₹300.00</b>
          <small id="pilgrimCountDisplay">(1 pilgrim)</small>
        </div>
      </aside>

      <!-- Panel -->
      <section class="ssw-panel">

        <div class="ssw-pane is-active" data-pane="1" id="step1">
          <div class="ssw-pane-head"><span class="ssw-badge">01</span><div><h2>Service &amp; Group Details</h2><p>Sahi package chunein — price apne aap update ho jayegi.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>Group Name</label><input class="ssw-input" name="group_name" value="{{ old('group_name') }}" placeholder="Group ka naam"></div>
            <div class="ssw-field"><label>Mobile Number <b class="ssw-req">*</b></label><input class="ssw-input" name="mobile_number" value="{{ old('mobile_number') }}" required placeholder="10 digit mobile number"></div>
            <div class="ssw-field"><label>Email</label><input class="ssw-input" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com"></div>
            <div class="ssw-field">
              <label>Service Name <b class="ssw-req">*</b></label>
              <select class="ssw-input" name="service_name" id="serviceName" required>
                <option value="Special Entry Darshan" data-price="300">Special Entry Darshan — ₹300</option>
                <option value="Priority Darshan Assistance" data-price="500">Priority Darshan Assistance — ₹500</option>
                <option value="Premium Darshan Assistance" data-price="2000">Premium Darshan Assistance — ₹2000</option>
                <option value="Express VIP Assistance" data-price="2500">Express VIP Assistance — ₹2500</option>
                <option value="SRIVANI VIP Break Darshan" data-price="10500">SRIVANI VIP Break Darshan — ₹10500</option>
              </select>
            </div>
            <div class="ssw-field"><label>Seva Amount (per person)</label><input class="ssw-input" name="seva_amount" id="sevaAmount" type="number" step="0.01" value="300" required readonly></div>
            <div class="ssw-field"><label>Slot</label><input class="ssw-input" name="slot" value="{{ old('slot') }}" placeholder="e.g. 10:00 AM"></div>
            <div class="ssw-field"><label>No. of Free Laddus</label><input class="ssw-input" name="no_of_free_laddus" id="noOfFreeLaddus" value="0" type="number" readonly></div>
            <div class="ssw-field"><label>Hundi Offering</label><input class="ssw-input" name="hundi_offering" id="hundiOffering" value="0" type="number" step="0.01" placeholder="0.00"></div>
          </div>

          <div class="ssw-summary">
            <div id="selectedServiceSummary" class="ssw-summary-text"></div>
            <p>Aage badhne se pehle chuni gayi package details check kar lein.</p>
            <button type="button" class="ssw-btn ssw-btn-ghost ssw-btn-sm" data-bs-toggle="modal" data-bs-target="#serviceDetailModal" onclick="showServiceDetails()">
              <i class="fas fa-circle-info"></i> Package Details Dekhein
            </button>
          </div>
        </div>

        <div class="ssw-pane" data-pane="2" id="step2">
          <div class="ssw-pane-head"><span class="ssw-badge">02</span><div><h2>Pilgrim Details</h2><p>Darshan karne wale sabhi logon ki jaankari yahan add karein.</p></div></div>

          <div class="ssw-pilgrim-toolbar">
            <span>Har pilgrim ke liye ek row automatically total mein juta jayega</span>
            <button type="button" class="ssw-btn ssw-btn-ghost ssw-btn-sm" onclick="addPilgrim()"><i class="fas fa-user-plus"></i> Pilgrim Add Karein</button>
          </div>

          <div id="pilgrimFields" class="ssw-pilgrim-list">
            <div class="ssw-pilgrim-card pilgrim-item">
              <div class="ssw-grid ssw-grid-pilgrim">
                <div class="ssw-field"><label>Pilgrim Name <b class="ssw-req">*</b></label><input class="ssw-input" name="pilgrims[0][pilgrim_name]" placeholder="Poora naam" required></div>
                <div class="ssw-field"><label>Age</label><input class="ssw-input" name="pilgrims[0][age]" placeholder="Umar"></div>
                <div class="ssw-field"><label>Gender</label>
                  <select class="ssw-input" name="pilgrims[0][gender]">
                    <option value="Male">Male</option><option value="Female">Female</option><option value="Other">Other</option>
                  </select>
                </div>
                <div class="ssw-field"><label>Contact No</label><input class="ssw-input" name="pilgrims[0][contact_no]" placeholder="Contact number"></div>
                <div class="ssw-field ssw-span2"><label>Address</label><input class="ssw-input" name="pilgrims[0][address]" placeholder="Poora address"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="3" id="step3">
          <div class="ssw-pane-head"><span class="ssw-badge">03</span><div><h2>Payment Proof</h2><p>Optional hai — jab bhi available ho tab attach kar sakte hain.</p></div></div>
          <div class="ssw-note-info"><i class="fas fa-circle-info"></i> Admin ke through banayi gayi booking ke liye payment proof zaroori nahi hai, lekin agar screenshot ya UTR available ho to add kar sakte hain.</div>
          <div class="ssw-grid">
            <div class="ssw-field ssw-span2">
              <label>Upload Screenshot</label>
              <div class="ssw-drop" style="max-width:280px;">
                <img id="adminPaymentPreview" class="ssw-preview d-none">
                <i class="fas fa-cloud-arrow-up"></i><span>Screenshot choose karein</span>
                <input type="file" name="screen_short" accept="image/*" onchange="previewImage(this,'adminPaymentPreview')">
              </div>
            </div>
            <div class="ssw-field ssw-span2"><label>UTR Number</label><input class="ssw-input" name="utr_number" value="{{ old('utr_number') }}" placeholder="UTR / Transaction ID (optional)"></div>
          </div>
        </div>

        <div class="ssw-actions">
          <button type="button" class="ssw-btn ssw-btn-ghost" id="prevBtn" onclick="changeStep(-1)" style="display:none;"><i class="fas fa-arrow-left"></i> Peeche</button>
          <div class="ssw-actions-right">
            <button type="button" class="ssw-btn ssw-btn-primary" id="nextBtn" onclick="changeStep(1)">Aage Badhein <i class="fas fa-arrow-right"></i></button>
            <button type="submit" class="ssw-btn ssw-btn-success" id="submitBtn" style="display:none;"><i class="fas fa-check"></i> Registration Banayein</button>
          </div>
        </div>

      </section>
    </div>
  </form>
</div>

<div class="modal fade" id="serviceDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content ssw-modal">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="serviceModalTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="serviceModalBody"></div>
    </div>
  </div>
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
  .ssw-eyebrow{display:inline-flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ssw-violet-2);background:#efe7fd;padding:4px 12px;border-radius:99px;margin-bottom:8px;}
  .ssw-title{font-size:28px;font-weight:700;margin:0 0 4px;background:linear-gradient(90deg,var(--ssw-violet) 0%,var(--ssw-indigo) 100%);-webkit-background-clip:text;background-clip:text;color:transparent;}
  .ssw-sub{margin:0;color:var(--ssw-muted);font-family:'Inter',sans-serif;font-size:14px;}
  .ssw-back{font-family:'Inter',sans-serif;font-size:13px;font-weight:600;color:var(--ssw-violet-2);text-decoration:none;padding:9px 16px;border:1px solid var(--ssw-line);border-radius:10px;background:#fff;white-space:nowrap;}
  .ssw-back:hover{background:var(--ssw-violet-2);color:#fff;border-color:var(--ssw-violet-2);}

  .ssw-shell{display:grid;grid-template-columns:280px 1fr;gap:22px;align-items:start;}
  @media(max-width:991px){.ssw-shell{grid-template-columns:1fr;}}

  .ssw-rail{background:linear-gradient(165deg,var(--ssw-violet) 0%,var(--ssw-indigo) 100%);border-radius:20px;padding:22px 16px;position:sticky;top:16px;box-shadow:0 18px 40px -18px rgba(91,33,182,.55);}
  @media(max-width:991px){.ssw-rail{position:relative;top:0;}}
  .ssw-steps{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:4px;}
  .ssw-step{display:flex;align-items:center;gap:12px;padding:10px 10px;border-radius:12px;transition:.2s;opacity:.55;}
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
  .ssw-progress-fill{height:100%;width:33.33%;background:var(--ssw-gold);border-radius:99px;transition:width .35s ease;}
  .ssw-rail-total{margin-top:16px;padding-top:14px;border-top:1px solid rgba(255,255,255,.18);font-family:'Inter',sans-serif;color:#fff;}
  .ssw-rail-total span{display:block;font-size:11px;color:rgba(255,255,255,.7);margin-bottom:2px;}
  .ssw-rail-total b{display:block;font-size:20px;color:var(--ssw-gold);}
  .ssw-rail-total small{color:rgba(255,255,255,.65);font-size:11px;}

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
  .ssw-grid-pilgrim{grid-template-columns:repeat(4,1fr);}
  @media(max-width:900px){.ssw-grid-pilgrim{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:520px){.ssw-grid-pilgrim{grid-template-columns:1fr;}}
  .ssw-span2{grid-column:span 2;}
  @media(max-width:640px){.ssw-span2{grid-column:span 1;}}
  .ssw-field label{display:block;font-family:'Inter',sans-serif;font-size:12.5px;font-weight:600;color:#443f5c;margin-bottom:6px;}
  .ssw-req{color:#dc2626;}
  .ssw-input{width:100%;border:1.5px solid var(--ssw-line);background:#fff;border-radius:11px;padding:11px 14px;font-family:'Inter',sans-serif;font-size:13.5px;color:var(--ssw-ink);transition:.18s;}
  .ssw-input:focus{outline:none;border-color:var(--ssw-violet-2);box-shadow:0 0 0 4px rgba(124,58,237,.14);}
  .ssw-input[readonly]{background:#f7f5fc;color:#443f5c;}

  .ssw-summary{margin-top:22px;padding:16px 18px;border-radius:14px;background:#fbfaff;border:1px solid var(--ssw-line);}
  .ssw-summary-text{font-family:'Inter',sans-serif;font-size:14px;font-weight:600;}
  .ssw-summary p{margin:6px 0 12px;color:var(--ssw-muted);font-family:'Inter',sans-serif;font-size:12.5px;}
  .ssw-btn-sm{padding:8px 14px;font-size:12.5px;}

  .ssw-pilgrim-toolbar{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:16px;font-family:'Inter',sans-serif;font-size:12.5px;color:var(--ssw-muted);}
  .ssw-pilgrim-list{display:flex;flex-direction:column;gap:14px;}
  .ssw-pilgrim-card{background:#fbfaff;border:1px solid var(--ssw-line);border-radius:14px;padding:16px;}

  .ssw-note-info{display:flex;gap:10px;align-items:flex-start;background:#eef6ff;border:1px solid #cfe4fb;color:#1d4ed8;border-radius:12px;padding:12px 14px;font-family:'Inter',sans-serif;font-size:12.5px;margin-bottom:18px;}

  .ssw-drop{position:relative;border:2px dashed var(--ssw-line);border-radius:14px;background:#fbfaff;min-height:130px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;color:var(--ssw-muted);font-family:'Inter',sans-serif;font-size:12.5px;overflow:hidden;transition:.2s;}
  .ssw-drop:hover{border-color:var(--ssw-violet-2);background:#f5f0ff;}
  .ssw-drop i{font-size:20px;color:var(--ssw-violet-2);}
  .ssw-drop input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;}
  .ssw-preview{position:absolute;inset:0;width:100%;height:100%;object-fit:contain;background:#fff;padding:10px;}

  .ssw-actions{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:14px;margin-top:24px;padding-top:20px;border-top:1px solid var(--ssw-line);}
  .ssw-actions-right{display:flex;align-items:center;gap:14px;flex-wrap:wrap;}
  .ssw-btn{border:none;border-radius:11px;padding:11px 22px;font-family:'Inter',sans-serif;font-weight:600;font-size:13.5px;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:.18s;}
  .ssw-btn-ghost{background:#fff;border:1.5px solid var(--ssw-line);color:#514a6b;}
  .ssw-btn-ghost:hover{border-color:var(--ssw-violet-2);color:var(--ssw-violet-2);}
  .ssw-btn-primary{background:linear-gradient(135deg,var(--ssw-violet-2),var(--ssw-indigo));color:#fff;box-shadow:0 10px 22px -10px rgba(91,33,182,.6);}
  .ssw-btn-primary:hover{filter:brightness(1.08);}
  .ssw-btn-success{background:linear-gradient(135deg,#16a34a,#22c55e);color:#fff;box-shadow:0 10px 22px -10px rgba(22,163,74,.55);}

  .ssw-modal{border-radius:18px;border:none;font-family:'Inter',sans-serif;}
  .ssw-modal .modal-title{font-family:'Outfit',sans-serif;font-weight:700;color:var(--ssw-violet);}
</style>

<script>
let currentStep = 1;
let idx = 1;
const serviceDetails = {
    'Special Entry Darshan': {price:300, description:'The ₹300 Special Entry Darshan is the most popular option for devotees visiting Tirumala. It provides faster access compared to Free Darshan through a dedicated queue. This package is ideal for pilgrims looking for a convenient and affordable darshan experience.', estimated:'2 to 5 Hours (Depending on crowd and TTD arrangements)', benefits:['Dedicated Special Entry Queue','Faster than Free Darshan','Online Ticket Booking','Comfortable Waiting Area']},
    'Priority Darshan Assistance': {price:500, description:'This package is designed for devotees who require additional booking guidance and pilgrimage assistance. It helps ensure a smoother temple visit with coordinated support, subject to TTD regulations.', estimated:'Approximately 2 to 4 Hours (Subject to crowd conditions)', benefits:['Booking Assistance','Pilgrimage Guidance','Priority Coordination Support','Dedicated Customer Assistance']},
    'Premium Darshan Assistance': {price:2000, description:'The Premium Darshan Assistance package is suitable for devotees seeking personalized travel and darshan coordination. The service focuses on minimizing inconvenience while ensuring a well-planned temple visit.', estimated:'Approximately 1.5 to 3 Hours (Depending on TTD schedule and crowd)', benefits:['Personalized Assistance','Faster Coordination','Dedicated Support Team','Complete Visit Guidance']},
    'Express VIP Assistance': {price:2500, description:'This premium assistance package offers enhanced support for devotees looking for a more organized pilgrimage experience. Every service is provided according to temple guidelines and availability.', estimated:'Approximately 10 to 20 Minute (Subject to availability and crowd)', benefits:['Premium Coordination','Express Assistance','Dedicated Support Executive','End-to-End Guidance']},
    'SRIVANI VIP Break Darshan': {price:10500, description:'The SRIVANI VIP Break Darshan includes the official SRIVANI Trust donation along with the VIP Break Darshan ticket, subject to TTD rules and availability. This is one of the fastest official darshan options offered through the SRIVANI Trust scheme.', estimated:'Approximately 10 Minutes to 20 minute (Depending on the scheduled break darshan slot)', benefits:['Official SRIVANI Trust Donation Scheme','VIP Break Darshan Access (Subject to TTD Rules)','Dedicated Entry','Shorter Waiting Time','Premium Pilgrim Experience']},
};

function previewImage(input, targetId){
    const preview = document.getElementById(targetId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.classList.add('d-none');
    }
}

function showStep(step){
    currentStep = step;
    document.querySelectorAll('.ssw-pane').forEach((panel) => {
        panel.classList.toggle('is-active', +panel.dataset.pane === step);
    });
    document.querySelectorAll('#sswSteps .ssw-step').forEach((s) => {
        const n = +s.dataset.step;
        s.classList.toggle('is-active', n === step);
        s.classList.toggle('is-done', n < step);
    });
    document.getElementById('sswProgressText').textContent = 'Step ' + step + ' / 3';
    document.getElementById('sswProgressPct').textContent = Math.round((step / 3) * 100) + '%';
    document.getElementById('sswProgressFill').style.width = (step / 3 * 100) + '%';
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-flex';
    document.getElementById('nextBtn').style.display = step === 3 ? 'none' : 'inline-flex';
    document.getElementById('submitBtn').style.display = step === 3 ? 'inline-flex' : 'none';
    document.querySelector('.ssw-panel').scrollIntoView({behavior:'smooth', block:'start'});
}

function changeStep(direction){
    if (currentStep === 1 && direction === 1) {
        const serviceName = document.getElementById('serviceName').value;
        const price = Number(document.getElementById('sevaAmount').value || 0);
        if (!serviceName || !price) {
            return;
        }
    }
    currentStep = Math.min(3, Math.max(1, currentStep + direction));
    showStep(currentStep);
}

function addPilgrim(){
    const container = document.getElementById('pilgrimFields');
    container.insertAdjacentHTML('beforeend', `<div class="ssw-pilgrim-card pilgrim-item"><div class="ssw-grid ssw-grid-pilgrim"><div class="ssw-field"><label>Pilgrim Name <b class="ssw-req">*</b></label><input class="ssw-input" name="pilgrims[`+idx+`][pilgrim_name]" placeholder="Poora naam" required></div><div class="ssw-field"><label>Age</label><input class="ssw-input" name="pilgrims[`+idx+`][age]" placeholder="Umar"></div><div class="ssw-field"><label>Gender</label><select class="ssw-input" name="pilgrims[`+idx+`][gender]"><option value="Male">Male</option><option value="Female">Female</option><option value="Other">Other</option></select></div><div class="ssw-field"><label>Contact No</label><input class="ssw-input" name="pilgrims[`+idx+`][contact_no]" placeholder="Contact number"></div><div class="ssw-field ssw-span2"><label>Address</label><input class="ssw-input" name="pilgrims[`+idx+`][address]" placeholder="Poora address"></div></div></div>`);
    idx++;
    updateSummary();
}

function updateSummary(){
    const serviceName = document.getElementById('serviceName').value;
    const price = parseFloat(document.getElementById('sevaAmount').value || 0);
    const count = document.querySelectorAll('#pilgrimFields .pilgrim-item').length;
    const offering = parseFloat(document.getElementById('hundiOffering').value || 0);
    const total = (price * count) + offering;
    document.getElementById('selectedServiceSummary').innerHTML = `<span>${serviceName}</span> &middot; <span style="color:var(--ssw-violet-2)">₹${price.toFixed(2)} per person</span>`;
    document.getElementById('totalAmountDisplay').textContent = '₹' + total.toFixed(2);
    document.getElementById('pilgrimCountDisplay').textContent = '(' + count + ' pilgrim' + (count === 1 ? '' : 's') + ')';
    document.getElementById('noOfFreeLaddus').value = count;
}

function showServiceDetails(){
    const serviceName = document.getElementById('serviceName').value;
    const detail = serviceDetails[serviceName] || serviceDetails['Special Entry Darshan'];
    document.getElementById('serviceModalTitle').textContent = serviceName;
    document.getElementById('serviceModalBody').innerHTML = `<p>${detail.description}</p><div class="mb-3"><strong>Estimated Darshan Time</strong><div>${detail.estimated}</div></div><div><strong>Benefits</strong><ul class="mb-0">${detail.benefits.map(b => `<li>${b}</li>`).join('')}</ul></div>`;
}

document.getElementById('serviceName').addEventListener('change', function(){
    const selected = this.options[this.selectedIndex];
    document.getElementById('sevaAmount').value = selected.dataset.price || 300;
    updateSummary();
});

document.getElementById('hundiOffering').addEventListener('input', updateSummary);
window.addEventListener('load', () => {
    updateSummary();
    showStep(1);
});
</script>
@endsection
