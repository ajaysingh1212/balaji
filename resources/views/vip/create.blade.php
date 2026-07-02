<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP Darshan Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --vl-maroon:#6b1420;
            --vl-maroon-dark:#4a0e17;
            --vl-gold:#c9992c;
            --vl-gold-light:#e7c876;
            --vl-ivory:#faf6ec;
            --vl-ink:#2b1810;
            --vl-muted:#8a7566;
            --vl-line:#ecdfc8;
            --vl-green:#2f6b46;
        }
        *{box-sizing:border-box;}
        body{
            font-family:'Work Sans',sans-serif;
            color:var(--vl-ink);
            min-height:100vh;
            background:
                radial-gradient(circle at 10% 0%, rgba(201,153,44,.10), transparent 40%),
                radial-gradient(circle at 90% 100%, rgba(107,20,32,.08), transparent 45%),
                var(--vl-ivory);
        }
        .vl-container{max-width:1080px;margin:0 auto;padding:36px 18px 60px;}

        /* ---- Gopuram tier stepper (signature element) ---- */
        .vl-crown{display:flex;justify-content:center;margin-bottom:-1px;position:relative;z-index:2;}
        .vl-tier{width:120px;height:56px;position:relative;margin:0 -6px;transition:.4s;}
        .vl-tier svg{width:100%;height:100%;display:block;}
        .vl-tier:nth-child(1){transform:translateY(18px) scale(.86);}
        .vl-tier:nth-child(3){transform:translateY(18px) scale(.86);}
        .vl-tier-label{position:absolute;bottom:10px;left:0;right:0;text-align:center;font-family:'Work Sans',sans-serif;font-size:10.5px;font-weight:700;letter-spacing:.04em;color:rgba(255,255,255,.85);text-transform:uppercase;}
        .vl-tier.is-done .vl-tier-label, .vl-tier.is-active .vl-tier-label{color:#4a0e17;}

        .vl-card{
            border:1px solid var(--vl-line);
            border-radius:26px;
            background:#fff;
            box-shadow:0 40px 90px -50px rgba(74,14,23,.55);
            overflow:hidden;
            position:relative;
        }
        .vl-head{
            background:linear-gradient(160deg,var(--vl-maroon) 0%, var(--vl-maroon-dark) 100%);
            padding:34px 34px 26px;
            color:#fff;
            position:relative;
        }
        .vl-head::before{
            content:'';position:absolute;inset:0;
            background:repeating-linear-gradient(90deg, rgba(255,255,255,.03) 0 2px, transparent 2px 22px);
            pointer-events:none;
        }
        .vl-head-top{display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;position:relative;z-index:1;}
        .vl-eyebrow{display:inline-flex;align-items:center;gap:7px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.25);padding:6px 14px;border-radius:99px;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;}
        .vl-title{font-family:'Marcellus',serif;font-size:2rem;margin:10px 0 2px;font-weight:400;letter-spacing:.01em;}
        .vl-subtitle{color:rgba(255,255,255,.72);font-size:13.5px;margin:0;}
        .vl-stepnote{color:rgba(255,255,255,.72);font-size:12px;text-align:right;}

        .vl-body{padding:32px;}
        @media(max-width:576px){.vl-body{padding:20px;} .vl-head{padding:26px 20px 20px;}}

        .vl-panel{background:#fffdf9;border:1px solid var(--vl-line);border-radius:20px;padding:26px;animation:vlFade .35s ease;}
        @keyframes vlFade{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
        .vl-panel-title{font-family:'Marcellus',serif;font-size:1.3rem;color:var(--vl-maroon);margin-bottom:4px;}
        .vl-panel-sub{color:var(--vl-muted);font-size:13px;margin-bottom:20px;}

        .vl-label{font-weight:600;color:#5c4326;font-size:12.5px;margin-bottom:7px;display:block;text-transform:uppercase;letter-spacing:.03em;}
        .form-control,.form-select{border-radius:13px;border:1.5px solid var(--vl-line);padding:12px 14px;background:#fff;font-size:14px;color:var(--vl-ink);}
        .form-control:focus,.form-select:focus{border-color:var(--vl-gold);box-shadow:0 0 0 4px rgba(201,153,44,.16);}
        .form-control[readonly]{background:#faf6ee;}

        .vl-summary{background:linear-gradient(135deg,#fdf6e8,#fbeed2);border:1px solid #f0dcac;border-radius:16px;padding:18px 20px;margin-top:6px;}
        .vl-summary-title{font-weight:700;color:var(--vl-maroon);font-size:14.5px;}
        .vl-summary p{color:var(--vl-muted);font-size:12.5px;margin:6px 0 0;}

        .vl-btn-link{border:1.5px solid var(--vl-gold);color:var(--vl-maroon);background:#fff;border-radius:12px;padding:9px 16px;font-weight:600;font-size:13px;}
        .vl-btn-link:hover{background:var(--vl-gold);color:#fff;}

        .vl-pilgrim-toolbar{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:16px;}
        .vl-pilgrim-toolbar span{color:var(--vl-muted);font-size:12.5px;}
        .vl-pilgrim-card{border:1px solid var(--vl-line);border-radius:16px;padding:16px;background:#fffefb;margin-bottom:14px;}

        .vl-total-box{background:linear-gradient(135deg,var(--vl-maroon),var(--vl-maroon-dark));color:#fff;border-radius:16px;padding:18px 20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-top:6px;}
        .vl-total-box b{font-family:'Marcellus',serif;font-size:1.5rem;color:var(--vl-gold-light);}
        .vl-total-box small{color:rgba(255,255,255,.7);}

        .vl-bank-card{border:1px solid var(--vl-line);border-radius:16px;padding:16px 18px;margin-bottom:14px;background:#fffefb;display:flex;gap:16px;flex-wrap:wrap;}
        .vl-bank-info{flex:1;min-width:200px;font-size:13px;line-height:1.85;}
        .vl-bank-info strong{display:block;font-family:'Marcellus',serif;font-size:1.05rem;color:var(--vl-maroon);margin-bottom:2px;}
        .vl-bank-qr img{border-radius:12px;border:1px solid var(--vl-line);}

        .vl-payable{background:linear-gradient(135deg,#fdf6e8,#fbeed2);border:1px solid #f0dcac;border-radius:16px;padding:18px 20px;margin-bottom:18px;}
        .vl-payable strong{color:var(--vl-maroon);}

        .vl-upload{position:relative;border:2px dashed var(--vl-line);border-radius:16px;background:#fffefb;min-height:120px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;color:var(--vl-muted);font-size:12.5px;overflow:hidden;}
        .vl-upload:hover{border-color:var(--vl-gold);background:#fffaf0;}
        .vl-upload i{font-size:20px;color:var(--vl-gold);}
        .vl-upload input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;}
        .vl-upload img{position:absolute;inset:0;width:100%;height:100%;object-fit:contain;background:#fff;padding:8px;}

        .vl-actions{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:14px;margin-top:26px;}
        .btn-nav{border-radius:13px;padding:12px 22px;font-weight:700;font-size:13.5px;min-width:120px;}
        .btn-back-link{background:#faf6ee;color:var(--vl-maroon);border:1.5px solid var(--vl-line);}
        .btn-back-link:hover{background:#f1e6cf;color:var(--vl-maroon);}
        .btn-nav-back{background:#faf6ee;color:var(--vl-maroon);border:1.5px solid var(--vl-line);}
        .btn-nav-back:hover{background:#f1e6cf;color:var(--vl-maroon);}
        .btn-nav-next,.btn-nav-book{background:linear-gradient(135deg,var(--vl-gold),#a97a1f);color:#fff;border:none;box-shadow:0 14px 30px -16px rgba(107,20,32,.5);}
        .btn-nav-next:hover,.btn-nav-book:hover{color:#fff;filter:brightness(1.05);}

        .modal-content{border-radius:20px;border:none;font-family:'Work Sans',sans-serif;}
        .modal-title{font-family:'Marcellus',serif;color:var(--vl-maroon);}
    </style>
</head>
<body>
<div class="vl-container">

    <!-- Gopuram tier stepper -->
    <div class="vl-crown">
        <div class="vl-tier" id="tierWrap1">
            <svg viewBox="0 0 120 56"><path d="M4 56 L4 30 Q60 -6 116 30 L116 56 Z" fill="url(#g1)"/><defs><linearGradient id="g1" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#c9992c"/><stop offset="1" stop-color="#8a6a1f"/></linearGradient></defs></svg>
            <span class="vl-tier-label">Booking</span>
        </div>
        <div class="vl-tier" id="tierWrap2" style="z-index:1;">
            <svg viewBox="0 0 120 56"><path d="M4 56 L4 22 Q60 -14 116 22 L116 56 Z" fill="url(#g2)"/><defs><linearGradient id="g2" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#e7c876"/><stop offset="1" stop-color="#c9992c"/></linearGradient></defs></svg>
            <span class="vl-tier-label">Pilgrims</span>
        </div>
        <div class="vl-tier" id="tierWrap3">
            <svg viewBox="0 0 120 56"><path d="M4 56 L4 30 Q60 -6 116 30 L116 56 Z" fill="url(#g3)"/><defs><linearGradient id="g3" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#c9992c"/><stop offset="1" stop-color="#8a6a1f"/></linearGradient></defs></svg>
            <span class="vl-tier-label">Payment</span>
        </div>
    </div>

    <div class="vl-card">
        <div class="vl-head">
            <div class="vl-head-top">
                <div>
                    <span class="vl-eyebrow"><i class="fas fa-om"></i> Tirumala &middot; Sacred Booking</span>
                    <h2 class="vl-title">VIP Darshan Registration</h2>
                    <p class="vl-subtitle">Ek shaant aur seamless darshan anubhav ke liye — 3 aasan steps.</p>
                </div>
                <div class="vl-stepnote" id="stepBadgeWrap">Step <b id="stepBadge">1</b> of 3</div>
            </div>
        </div>

        <div class="vl-body">
            <form method="POST" action="{{ route('vip.store') }}" enctype="multipart/form-data" id="vipBookingForm">
                @csrf

                <div class="vl-panel" id="step1">
                    <h4 class="vl-panel-title">Booking Details</h4>
                    <p class="vl-panel-sub">Group aur seva ki jaankari bharein.</p>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="vl-label">Group Name</label><input class="form-control" name="group_name" placeholder="Enter group name"></div>
                        <div class="col-md-6"><label class="vl-label">Booking Date <b class="ssw-req">*</b></label><input class="form-control" name="booking_date" type="date" value="{{ old('booking_date') }}" required></div>
                        <div class="col-md-6"><label class="vl-label">Photo Type ID Number <b class="ssw-req">*</b></label><input class="form-control" name="photo_id_number" placeholder="Enter Photo Type ID Number" required></div>
                        <div class="col-md-6"><label class="vl-label">Mobile Number</label><input class="form-control" name="mobile_number" required placeholder="10 digit mobile number"></div>
                        <div class="col-md-6"><label class="vl-label">Email</label><input class="form-control" name="email" type="email" placeholder="name@example.com"></div>
                        <div class="col-md-6">
                            <label class="vl-label">Service Name</label>
                            <select class="form-select" name="service_name" id="serviceName" required>
                                <option value="Special Entry Darshan" data-price="300">Special Entry Darshan — ₹300</option>
                                <option value="Priority Darshan Assistance" data-price="500">Priority Darshan Assistance — ₹500</option>
                                <option value="Premium Darshan Assistance" data-price="2000">Premium Darshan Assistance — ₹2000</option>
                                <option value="Express VIP Assistance" data-price="2500">Express VIP Assistance — ₹2500</option>
                                <option value="SRIVANI VIP Break Darshan" data-price="10500">SRIVANI VIP Break Darshan — ₹10500</option>
                            </select>
                        </div>
                        <div class="col-md-6"><label class="vl-label">Seva Amount (per person)</label><input class="form-control" name="seva_amount" id="sevaAmount" type="number" step="0.01" value="300" required readonly></div>
                        <div class="col-md-6"><label class="vl-label">No. of Free Laddus</label><input class="form-control" name="no_of_free_laddus" id="noOfFreeLaddus" value="0" type="number" readonly></div>
                        <div class="col-md-12"><label class="vl-label">Hundi Offering</label><input class="form-control" name="hundi_offering" type="number" step="0.01" value="0" placeholder="0.00"></div>
                        <div class="col-md-12">
                            <div class="vl-summary">
                                <div id="selectedServiceSummary" class="vl-summary-title"></div>
                                <p>Aage badhne se pehle chuni gayi package details ek baar zaroor dekh lein.</p>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="button" class="vl-btn-link" data-bs-toggle="modal" data-bs-target="#serviceDetailModal" onclick="showServiceDetails()">
                                <i class="fas fa-circle-info"></i> Package Details Dekhein
                            </button>
                        </div>
                    </div>
                </div>

                <div class="vl-panel d-none" id="step2">
                    <h4 class="vl-panel-title">Pilgrim Details</h4>
                    <p class="vl-panel-sub">Darshan karne wale sabhi devotees ki jaankari add karein.</p>
                    <div class="vl-pilgrim-toolbar">
                        <span>Har pilgrim ka amount total mein automatically jud jayega</span>
                        <button type="button" class="vl-btn-link" onclick="addPilgrim()"><i class="fas fa-user-plus"></i> Pilgrim Add Karein</button>
                    </div>
                    <div id="pilgrimFields">
                        <div class="row g-3 pilgrim-item vl-pilgrim-card mx-0">
                            <div class="col-md-3"><input class="form-control" name="pilgrims[0][pilgrim_name]" placeholder="Pilgrim Name" required></div>
                            <div class="col-md-2"><input class="form-control" name="pilgrims[0][age]" placeholder="Age"></div>
                            <div class="col-md-2"><select class="form-select" name="pilgrims[0][gender]"><option value="Male">Male</option><option value="Female">Female</option><option value="Other">Other</option></select></div>
                            <div class="col-md-2"><input class="form-control" name="pilgrims[0][contact_no]" placeholder="Contact No"></div>
                            <div class="col-md-3"><input class="form-control" name="pilgrims[0][address]" placeholder="Address"></div>
                        </div>
                    </div>
                    <div class="vl-total-box">
                        <div><small>Total Amount</small><br><b id="totalAmountDisplay">₹300.00</b></div>
                        <small id="pilgrimCountDisplay">(1 pilgrim)</small>
                    </div>
                </div>

                <div class="vl-panel d-none" id="step3">
                    <h4 class="vl-panel-title">Payment Details</h4>
                    <p class="vl-panel-sub">Neeche diye gaye kisi bhi account mein payment karke proof upload karein.</p>

                    <div class="vl-payable">
                        <strong>Selected Service:</strong> <span id="selectedServiceLabel">Special Entry Darshan</span><br>
                        <strong>Amount Payable:</strong> <span id="amountPayableLabel">₹300.00</span>
                    </div>

                    @foreach($accountDetails as $account)
                    <div class="vl-bank-card">
                        <div class="vl-bank-info">
                            <strong>{{ $account->bank_name }}</strong>
                            A/C Holder: {{ $account->account_holder_name }}<br>
                            A/C No: {{ $account->account_number }}<br>
                            IFSC: {{ $account->ifsc_code }}<br>
                            Account Type: {{ $account->account_type ?? 'N/A' }}<br>
                            UPI ID: {{ $account->upi_id ?? 'N/A' }}<br>
                            UPI Number: {{ $account->upi_number ?? 'N/A' }}
                        </div>
                        @if($account->upi_qr_code)
                        <div class="vl-bank-qr"><img src="{{ asset($account->upi_qr_code) }}" width="140"></div>
                        @endif
                    </div>
                    @endforeach

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="vl-label">Upload Payment Screenshot</label>
                            <div class="vl-upload">
                                <img id="paymentImagePreview" class="d-none">
                                <i class="fas fa-cloud-arrow-up"></i><span>Screenshot choose karein</span>
                                <input type="file" name="screen_short" accept="image/*" required onchange="previewImage(this,'paymentImagePreview')">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="vl-label">UTR Number</label>
                            <input class="form-control" name="utr_number" placeholder="Enter UTR / Transaction ID" required>
                        </div>
                    </div>
                </div>

                <div class="vl-actions">
                    <a href="{{ route('vip.landing') }}" class="btn btn-nav btn-back-link">Back</a>
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button" class="btn btn-nav btn-nav-back" id="prevBtn" onclick="changeStep(-1)" style="display:none;">Previous</button>
                        <button type="button" class="btn btn-nav btn-nav-next" id="nextBtn" onclick="changeStep(1)">Next</button>
                        <button type="submit" class="btn btn-nav btn-nav-book" id="submitBtn" style="display:none;">Submit Booking</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="serviceDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header border-0"><h5 class="modal-title" id="serviceModalTitle"></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body" id="serviceModalBody"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/js/all.min.js"></script>
<script>
let idx = 1;
let currentStep = 1;
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
        reader.onload = function(e){ preview.src = e.target.result; preview.classList.remove('d-none'); };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = ''; preview.classList.add('d-none');
    }
}

function showStep(step){
    currentStep = step;
    document.querySelectorAll('.vl-panel').forEach((panel, index) => panel.classList.toggle('d-none', index + 1 !== step));
    document.getElementById('stepBadge').textContent = step;
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = step === 3 ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = step === 3 ? 'inline-block' : 'none';
    for (let i = 1; i <= 3; i++) {
        const tier = document.getElementById('tierWrap' + i);
        tier.classList.toggle('is-active', i === step);
        tier.classList.toggle('is-done', i < step);
    }
    window.scrollTo({top: 0, behavior:'smooth'});
}

function changeStep(direction){
    if (currentStep === 1 && direction === 1) {
        const serviceName = document.getElementById('serviceName').value;
        const price = Number(document.getElementById('sevaAmount').value || 0);
        if (!serviceName || !price) { return; }
    }
    currentStep = Math.min(3, Math.max(1, currentStep + direction));
    showStep(currentStep);
}

function addPilgrim(){
    const container = document.getElementById('pilgrimFields');
    container.insertAdjacentHTML('beforeend', `<div class="row g-3 pilgrim-item vl-pilgrim-card mx-0"><div class="col-md-3"><input class="form-control" name="pilgrims[`+idx+`][pilgrim_name]" placeholder="Pilgrim Name" required></div><div class="col-md-2"><input class="form-control" name="pilgrims[`+idx+`][age]" placeholder="Age"></div><div class="col-md-2"><select class="form-select" name="pilgrims[`+idx+`][gender]"><option value="Male">Male</option><option value="Female">Female</option><option value="Other">Other</option></select></div><div class="col-md-2"><input class="form-control" name="pilgrims[`+idx+`][contact_no]" placeholder="Contact No"></div><div class="col-md-3"><input class="form-control" name="pilgrims[`+idx+`][address]" placeholder="Address"></div></div>`);
    idx++;
    updateSummary();
}

function updateSummary(){
    const serviceName = document.getElementById('serviceName').value;
    const price = parseFloat(document.getElementById('sevaAmount').value || 0);
    const count = document.querySelectorAll('#pilgrimFields .pilgrim-item').length;
    const total = (price * count) + (parseFloat(document.querySelector('input[name="hundi_offering"]').value || 0));
    document.getElementById('selectedServiceSummary').innerHTML = `${serviceName} &middot; ₹${price.toFixed(2)} per person`;
    document.getElementById('totalAmountDisplay').textContent = '₹' + total.toFixed(2);
    document.getElementById('pilgrimCountDisplay').textContent = '(' + count + ' pilgrim' + (count === 1 ? '' : 's') + ')';
    document.getElementById('selectedServiceLabel').textContent = serviceName;
    document.getElementById('amountPayableLabel').textContent = '₹' + total.toFixed(2);
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

window.addEventListener('load', () => {
    updateSummary();
    showStep(1);
});
</script>
</body>
</html>
