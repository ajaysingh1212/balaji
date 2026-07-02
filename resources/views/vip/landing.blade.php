<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->meta_title ?? (($settings->site_name ?? 'TTD') . ' | VIP Entry Darshan') }}</title>
    <meta name="description" content="{{ $settings->meta_description ?? 'Book your VIP Entry Darshan at Tirumala Tirupati — fast approval, secure payment and an instant digital ticket for your whole group.' }}">
    @if(!empty($settings->meta_keywords))
    <meta name="keywords" content="{{ $settings->meta_keywords }}">
    @endif
    <meta name="robots" content="{{ $settings->robots_meta ?? 'index, follow' }}">
    @if(!empty($settings->canonical_url))
    <link rel="canonical" href="{{ $settings->canonical_url }}">
    @endif
    @if(!empty($settings->google_search_console_verification))
    <meta name="google-site-verification" content="{{ $settings->google_search_console_verification }}">
    @endif
    <meta property="og:title" content="{{ $settings->meta_title ?? ($settings->site_name ?? 'TTD') }}">
    <meta property="og:description" content="{{ $settings->meta_description ?? 'Book your VIP Entry Darshan at Tirumala Tirupati.' }}">
    @if($settings && !empty($settings->og_image))
    <meta property="og:image" content="{{ asset($settings->og_image) }}">
    @endif
    @if($settings && !empty($settings->favicon))
    <link rel="icon" href="{{ asset($settings->favicon) }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Yatra+One&family=Mukta:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @if(!empty($settings->google_tag_manager_id))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $settings->google_tag_manager_id }}');</script>
    @endif
    @if(!empty($settings->google_analytics_id))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->google_analytics_id }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $settings->google_analytics_id }}');</script>
    @endif

    <style>
        :root{
            --maroon-deep:#450D13;
            --maroon:#6B1420;
            --maroon-soft:#8C2233;
            --gold:#C99A2E;
            --gold-bright:#F3C969;
            --gold-pale:#F6E3B4;
            --saffron:#E1652C;
            --cream:#FFF8EA;
            --cream-2:#FCEFD6;
            --night:#170B28;
            --night-2:#2A1246;
            --ink:#2B140F;
            --ink-soft:#6B4A34;
            --ease:cubic-bezier(.22,.7,.24,1);
        }
        *{box-sizing:border-box;}
        html{scroll-behavior:smooth;}
        body{margin:0;font-family:'Mukta',sans-serif;background:var(--cream);color:var(--ink);overflow-x:hidden;}
        h1,h2,h3{font-family:'Cormorant Garamond',serif;margin:0;font-weight:700;}
        .eyebrow{font-family:'Yatra One',cursive;letter-spacing:.03em;color:var(--saffron);font-size:1rem;}
        a{color:inherit;}
        img{max-width:100%;display:block;}
        @media (prefers-reduced-motion: reduce){
            *{animation-duration:.001ms !important;animation-iteration-count:1 !important;transition-duration:.001ms !important;scroll-behavior:auto !important;}
        }

        /* ---------- Loader ---------- */
        #loader{position:fixed;inset:0;z-index:999;background:radial-gradient(circle at 50% 30%,var(--maroon-soft),var(--maroon-deep) 70%);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:18px;transition:opacity .7s var(--ease),visibility .7s;}
        #loader.hide{opacity:0;visibility:hidden;pointer-events:none;}
        .loader-ring{width:86px;height:86px;border-radius:50%;border:2px solid rgba(243,201,105,.25);border-top-color:var(--gold-bright);animation:spin 1.4s linear infinite;display:grid;place-items:center;}
        .loader-logo{width:52px;height:52px;object-fit:contain;filter:drop-shadow(0 0 10px rgba(243,201,105,.6));animation:pulse 1.6s ease-in-out infinite;}
        .loader-text{font-family:'Yatra One',cursive;color:var(--gold-pale);letter-spacing:.06em;font-size:.95rem;}
        @keyframes spin{to{transform:rotate(360deg);}}
        @keyframes pulse{0%,100%{transform:scale(1);opacity:1;}50%{transform:scale(1.08);opacity:.75;}}

        /* ---------- Maintenance banner ---------- */
        .maint-banner{background:var(--saffron);color:#fff;text-align:center;padding:10px 16px;font-weight:600;font-size:.92rem;}

        /* ---------- Nav ---------- */
        .nav{position:sticky;top:0;z-index:40;display:flex;align-items:center;justify-content:space-between;padding:16px 6%;background:rgba(255,248,234,.9);backdrop-filter:blur(14px);border-bottom:1px solid rgba(201,154,46,.25);}
        .logo-wrap{display:flex;align-items:center;gap:12px;}
        .logo{width:56px;height:56px;object-fit:contain;}
        .brand{font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-weight:700;letter-spacing:.02em;color:var(--maroon-deep);line-height:1.1;}
        .brand small{display:block;font-family:'Yatra One',cursive;font-size:.55em;font-weight:400;color:var(--saffron);letter-spacing:.03em;}
        .nav-links{display:flex;gap:30px;align-items:center;}
        .nav-links a{text-decoration:none;color:var(--ink-soft);font-weight:600;font-size:.96rem;position:relative;}
        .nav-links a:not(.btn):after{content:'';position:absolute;left:0;bottom:-5px;width:0;height:2px;background:var(--saffron);transition:width .3s var(--ease);}
        .nav-links a:not(.btn):hover:after{width:100%;}
        .btn{padding:13px 26px;border-radius:6px;background:linear-gradient(135deg,var(--maroon),var(--maroon-deep));color:var(--gold-pale);border:1px solid var(--gold);text-decoration:none;font-weight:700;box-shadow:0 14px 30px -16px rgba(69,13,19,.7);transition:transform .25s var(--ease),box-shadow .25s var(--ease);}
        .btn:hover{transform:translateY(-2px);box-shadow:0 18px 34px -14px rgba(69,13,19,.8);}
        .btn-ghost{background:#fff;color:var(--maroon-deep);border:1px solid var(--gold-pale);box-shadow:none;}
        a:focus-visible,button:focus-visible{outline:2px solid var(--saffron);outline-offset:3px;}
        @media (max-width:900px){.nav-links{display:none;}}

        /* ---------- Hero ---------- */
        .hero{position:relative;display:grid;grid-template-columns:1.05fr .95fr;gap:48px;padding:76px 6% 60px;align-items:center;background:
            radial-gradient(ellipse at 15% -10%,rgba(201,154,46,.18),transparent 45%),
            linear-gradient(180deg,var(--cream),#fff9ee 60%,var(--cream));overflow:hidden;}
        .hero:before{content:'';position:absolute;inset:0;background-image:repeating-linear-gradient(90deg,rgba(107,20,32,.035) 0 2px,transparent 2px 34px);pointer-events:none;}
        .tag{display:inline-flex;background:#fff;color:var(--saffron);padding:9px 18px;border-radius:999px;font-weight:700;font-size:.85rem;box-shadow:0 8px 26px -18px #000;border:1px solid var(--gold-pale);}
        h1.hero-title{font-size:clamp(2.7rem,5.4vw,4.4rem);line-height:1.04;margin:18px 0 16px;color:var(--maroon-deep);}
        h1.hero-title em{font-style:normal;color:var(--saffron);}
        .hero p.lead{font-size:1.08rem;line-height:1.9;color:var(--ink-soft);max-width:560px;}
        .hero-actions{display:flex;gap:16px;margin-top:28px;flex-wrap:wrap;}
        .feature-band{display:flex;gap:12px;margin-top:26px;flex-wrap:wrap;}
        .feature-pill{padding:10px 16px;background:#fff;border-radius:10px;box-shadow:0 10px 26px -18px rgba(107,20,32,.5);font-weight:600;font-size:.88rem;border:1px solid var(--cream-2);display:flex;align-items:center;gap:8px;}
        .feature-pill .dot{width:7px;height:7px;border-radius:50%;background:var(--saffron);}

        .hero-art{position:relative;height:520px;border-radius:26px;overflow:hidden;background:radial-gradient(circle at 50% 20%,var(--maroon-soft),var(--maroon-deep) 75%);box-shadow:0 40px 90px -40px rgba(69,13,19,.65);}
        .hero-art .sky-glow{position:absolute;top:-40px;left:50%;transform:translateX(-50%);width:340px;height:340px;border-radius:50%;background:radial-gradient(circle,rgba(243,201,105,.55),transparent 65%);animation:glow-breathe 5s ease-in-out infinite;}
        @keyframes glow-breathe{0%,100%{opacity:.6;transform:translateX(-50%) scale(1);}50%{opacity:1;transform:translateX(-50%) scale(1.08);}}
        .gopuram-svg{position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:280px;}
        .hero-art .star{position:absolute;width:3px;height:3px;background:var(--gold-pale);border-radius:50%;animation:twinkle 3s ease-in-out infinite;}
        @keyframes twinkle{0%,100%{opacity:.15;}50%{opacity:.9;}}
        .diya{position:absolute;width:14px;height:18px;}
        .diya .flame{transform-origin:50% 100%;animation:flicker 1.6s ease-in-out infinite;}
        @keyframes flicker{0%,100%{transform:scaleY(1) rotate(0deg);}30%{transform:scaleY(1.12) rotate(-3deg);}60%{transform:scaleY(.94) rotate(2deg);}}
        .hero-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;position:absolute;left:20px;right:20px;bottom:20px;}
        .hstat{background:rgba(255,248,234,.1);border:1px solid rgba(243,201,105,.35);backdrop-filter:blur(6px);border-radius:14px;padding:14px 10px;text-align:center;color:var(--gold-pale);}
        .hstat strong{font-family:'Poppins',sans-serif;display:block;font-size:1.4rem;color:#fff;}
        .hstat span{font-size:.74rem;letter-spacing:.03em;text-transform:uppercase;opacity:.85;}
        @media (max-width:900px){.hero{grid-template-columns:1fr;padding-top:40px;}.hero-art{height:400px;}}

        /* ---------- Section shell ---------- */
        .sections{padding:70px 6%;}
        .section-eyebrow{text-align:center;display:block;margin-bottom:10px;}
        .section-title{text-align:center;font-size:clamp(2rem,4vw,2.7rem);color:var(--maroon-deep);margin-bottom:14px;}
        .section-subtitle{text-align:center;max-width:600px;margin:0 auto 46px;color:var(--ink-soft);line-height:1.75;}
        .reveal{opacity:0;transform:translateY(26px);transition:opacity .7s var(--ease),transform .7s var(--ease);}
        .reveal.in-view{opacity:1;transform:none;}

        /* ---------- How it works ---------- */
        .steps{display:grid;grid-template-columns:repeat(3,1fr);gap:28px;max-width:1100px;margin:0 auto;position:relative;}
        .step{background:#fff;padding:30px 26px;border-radius:4px 4px 4px 26px;box-shadow:0 16px 40px -32px rgba(107,20,32,.6);border:1px solid var(--cream-2);position:relative;}
        .step-crest{width:52px;height:52px;display:grid;place-items:center;background:linear-gradient(135deg,var(--gold),var(--saffron));clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);color:#fff;font-family:'Poppins',sans-serif;font-weight:800;font-size:1.15rem;margin-bottom:16px;}
        .step h3{font-size:1.3rem;color:var(--maroon-deep);margin-bottom:8px;}
        .step p{color:var(--ink-soft);line-height:1.7;font-size:.95rem;margin:0;}
        @media (max-width:900px){.steps{grid-template-columns:1fr;}}

        /* ---------- Virtual Yatra (signature) ---------- */
        .yatra{background:
            radial-gradient(ellipse at 20% 0%,rgba(201,154,46,.14),transparent 45%),
            radial-gradient(ellipse at 80% 100%,rgba(225,101,44,.12),transparent 45%),
            linear-gradient(180deg,var(--night),var(--night-2) 55%,var(--night));
            padding:80px 6% 100px;position:relative;overflow:hidden;}
        .yatra .starfield span{position:absolute;background:#fff;border-radius:50%;opacity:.5;animation:twinkle 4s ease-in-out infinite;}
        .yatra .section-title, .yatra .section-subtitle{color:var(--gold-pale);}
        .yatra .section-subtitle{color:#cbb8e3;}
        .yatra-track{max-width:880px;margin:60px auto 0;position:relative;}
        .yatra-line{position:absolute;top:0;bottom:0;left:50%;transform:translateX(-50%);width:3px;background:linear-gradient(180deg,rgba(201,154,46,.12),rgba(201,154,46,.12));}
        .yatra-line-fill{position:absolute;top:0;left:0;width:100%;height:0;background:linear-gradient(180deg,var(--saffron),var(--gold-bright));box-shadow:0 0 18px 2px rgba(243,201,105,.6);transition:height .1s linear;}
        .yatra-stage{position:relative;display:grid;grid-template-columns:1fr 70px 1fr;align-items:center;gap:0;margin-bottom:64px;}
        .yatra-stage:last-child{margin-bottom:0;}
        .yatra-card{background:rgba(255,248,234,.05);border:1px solid rgba(201,154,46,.28);border-radius:16px;padding:22px 24px;backdrop-filter:blur(4px);}
        .yatra-stage:nth-child(odd) .yatra-card{grid-column:1;text-align:right;}
        .yatra-stage:nth-child(even) .yatra-card{grid-column:3;text-align:left;}
        .yatra-card h3{color:var(--gold-bright);font-size:1.35rem;margin-bottom:6px;}
        .yatra-card p{color:#d9cdee;font-size:.92rem;line-height:1.7;margin:0;}
        .yatra-node{grid-column:2;width:64px;height:64px;border-radius:50%;background:var(--night-2);border:2px solid rgba(201,154,46,.4);display:grid;place-items:center;position:relative;z-index:2;transition:all .5s var(--ease);}
        .yatra-node svg{width:30px;height:30px;stroke:var(--gold-pale);opacity:.55;transition:opacity .5s var(--ease),stroke .5s var(--ease);}
        .yatra-stage.lit .yatra-node{border-color:var(--gold-bright);box-shadow:0 0 0 6px rgba(243,201,105,.1),0 0 24px 4px rgba(243,201,105,.5);}
        .yatra-stage.lit .yatra-node svg{opacity:1;stroke:var(--gold-bright);}
        .yatra-stage.lit .yatra-card{border-color:rgba(243,201,105,.55);}
        .yatra-stage{opacity:.35;transform:translateY(18px);transition:opacity .6s var(--ease),transform .6s var(--ease);}
        .yatra-stage.lit{opacity:1;transform:none;}
        @media (max-width:760px){
            .yatra-stage{grid-template-columns:56px 1fr;}
            .yatra-node{grid-column:1;width:52px;height:52px;}
            .yatra-stage:nth-child(odd) .yatra-card,.yatra-stage:nth-child(even) .yatra-card{grid-column:2;text-align:left;}
            .yatra-line{left:26px;}
        }

        /* ---------- Gallery ---------- */
        .gallery-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;max-width:1180px;margin:0 auto;}
        .gallery-item{position:relative;border-radius:14px;overflow:hidden;aspect-ratio:3/4;box-shadow:0 18px 40px -28px rgba(107,20,32,.55);}
        .gallery-item img{width:100%;height:100%;object-fit:cover;transition:transform .6s var(--ease);}
        .gallery-item:hover img{transform:scale(1.08);}
        .gallery-item:after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,transparent 50%,rgba(69,13,19,.55));}
        @media (max-width:900px){.gallery-grid{grid-template-columns:repeat(2,1fr);}}

        /* ---------- About ---------- */
        .about{background:linear-gradient(135deg,var(--maroon-deep),var(--maroon) 70%);color:var(--gold-pale);border-radius:0;padding:72px 6%;position:relative;}
        .about-inner{max-width:820px;margin:0 auto;text-align:center;}
        .about h2{font-size:clamp(1.9rem,3.6vw,2.5rem);color:#fff;margin-bottom:18px;}
        .about p{line-height:1.9;font-size:1.02rem;color:#e9d7c2;}
        .about-meta{display:flex;justify-content:center;gap:28px;margin-top:30px;flex-wrap:wrap;font-size:.85rem;color:var(--gold-pale);}
        .about-meta span strong{display:block;color:#fff;font-family:'Poppins',sans-serif;}

        /* ---------- Contact ---------- */
        .contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:36px;max-width:1080px;margin:0 auto;align-items:start;}
        .contact-card{background:#fff;border-radius:18px;padding:30px;box-shadow:0 16px 40px -32px rgba(107,20,32,.6);border:1px solid var(--cream-2);}
        .contact-row{display:flex;gap:14px;align-items:flex-start;padding:14px 0;border-bottom:1px dashed var(--cream-2);}
        .contact-row:last-child{border-bottom:none;}
        .contact-row .ic{width:38px;height:38px;border-radius:10px;background:var(--cream-2);display:grid;place-items:center;flex-shrink:0;color:var(--maroon-deep);}
        .contact-row a{text-decoration:none;font-weight:600;color:var(--ink);}
        .contact-row span.label{display:block;font-size:.78rem;color:var(--ink-soft);text-transform:uppercase;letter-spacing:.03em;}
        .social-row{display:flex;gap:12px;margin-top:20px;flex-wrap:wrap;}
        .social-row a{width:40px;height:40px;border-radius:50%;background:var(--maroon-deep);color:#fff;display:grid;place-items:center;text-decoration:none;font-size:.85rem;font-weight:700;transition:transform .25s var(--ease),background .25s var(--ease);}
        .social-row a:hover{transform:translateY(-3px);background:var(--saffron);}
        .map-embed{border-radius:18px;overflow:hidden;height:100%;min-height:340px;box-shadow:0 16px 40px -32px rgba(107,20,32,.6);border:1px solid var(--cream-2);}
        .map-embed iframe{width:100%;height:100%;min-height:340px;border:0;}
        @media (max-width:900px){.contact-grid{grid-template-columns:1fr;}}

        /* ---------- Final CTA ---------- */
        .cta-band{position:relative;margin:0 6%;border-radius:28px;padding:64px 40px;text-align:center;overflow:hidden;background:radial-gradient(circle at 30% 20%,var(--maroon-soft),var(--maroon-deep) 70%);}
        .cta-band h2{color:#fff;font-size:clamp(1.9rem,3.8vw,2.7rem);margin-bottom:14px;}
        .cta-band p{color:var(--gold-pale);max-width:520px;margin:0 auto 26px;line-height:1.8;}

        /* ---------- Footer ---------- */
        footer{background:var(--night);color:#cbb8e3;padding:64px 6% 26px;margin-top:60px;}
        .footer-grid{display:grid;grid-template-columns:1.4fr 1fr 1fr;gap:40px;max-width:1180px;margin:0 auto;padding-bottom:40px;border-bottom:1px solid rgba(201,154,46,.2);}
        .footer-brand{display:flex;align-items:center;gap:12px;margin-bottom:14px;}
        .footer-brand img{width:44px;height:44px;object-fit:contain;}
        .footer-brand span{font-family:'Cormorant Garamond',serif;font-size:1.3rem;color:#fff;}
        footer h4{font-family:'Yatra One',cursive;font-weight:400;color:var(--gold-bright);margin-bottom:16px;font-size:1rem;letter-spacing:.02em;}
        footer ul{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:10px;}
        footer ul a{text-decoration:none;color:#cbb8e3;font-size:.92rem;transition:color .2s;}
        footer ul a:hover{color:var(--gold-bright);}
        footer p.about-text{color:#b7a6d4;font-size:.92rem;line-height:1.8;max-width:380px;}
        .footer-bottom{max-width:1180px;margin:24px auto 0;display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;font-size:.82rem;color:#8a79ab;}
        @media (max-width:900px){.footer-grid{grid-template-columns:1fr;}}
    </style>
</head>
<body>

@php
    $footerMenu = [];
    if(!empty($settings->footer_menu)){
        $decoded = json_decode($settings->footer_menu, true);
        if(is_array($decoded)){ $footerMenu = $decoded; }
    }
@endphp

<div id="loader">
    <div class="loader-ring">
        @if($settings && !empty($settings->loading_logo))
            <img class="loader-logo" src="{{ asset($settings->loading_logo) }}" alt="loading">
        @endif
    </div>
    <div class="loader-text">॥ श्री वेंकटेश्वराय नमः ॥</div>
</div>

@if($settings && !empty($settings->maintenance_mode))
<div class="maint-banner">This site is currently under scheduled maintenance — some features may be temporarily unavailable.</div>
@endif

<nav class="nav">
    <div class="logo-wrap">
        <img class="logo" src="{{ $settings && $settings->logo ? asset($settings->logo) : asset('images/logo.png') }}" alt="logo">
        <div class="brand">{{ $settings->site_name ?? 'TTD' }}<small>{{ $settings->site_title ?? 'VIP Entry Darshan' }}</small></div>
    </div>
    <div class="nav-links">
        <a href="#how-it-works">How it works</a>
        <a href="#yatra">Virtual Darshan</a>
        <a href="{{ route('vip.status') }}">Check Status</a>
        <a href="{{ route('vip.create') }}" class="btn">Book Now</a>
    </div>
</nav>

<section class="hero">
    <div class="reveal in-view">
        <span class="tag">{{ $settings->company_name ?? 'Tirumala Tirupati Devasthanams' }}</span>
        <h1 class="hero-title">{{ $settings->hero_title ?? 'VIP Entry' }} <em>{{ $settings->tagline ?? 'Darshan' }}</em></h1>
        <p class="lead">{{ $settings->hero_subtitle ?? ($settings->site_slogan ?? 'Experience a smooth and sacred Tirumala visit with a premium VIP entry plan, easy booking, secure payment, and instant updates for your entire group.') }}</p>
        <div class="hero-actions">
            <a href="{{ route('vip.create') }}" class="btn">{{ $settings->hero_button_text ?? 'Book VIP Darshan' }}</a>
            <a href="{{ route('vip.status') }}" class="btn btn-ghost">Check Booking</a>
        </div>
        <div class="feature-band">
            <div class="feature-pill"><span class="dot"></span>Fast Approval</div>
            <div class="feature-pill"><span class="dot"></span>Secure Payment</div>
            <div class="feature-pill"><span class="dot"></span>Instant Ticket</div>
        </div>
    </div>

    <div class="hero-art reveal in-view">
        <div class="sky-glow"></div>
        <div class="star" style="top:12%;left:20%;animation-delay:.2s;"></div>
        <div class="star" style="top:22%;left:70%;animation-delay:1s;"></div>
        <div class="star" style="top:8%;left:50%;animation-delay:1.6s;"></div>
        <div class="star" style="top:32%;left:34%;animation-delay:.7s;"></div>
        <div class="star" style="top:18%;left:85%;animation-delay:2.1s;"></div>

        <svg class="gopuram-svg" viewBox="0 0 200 300" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="gopGold" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#F3C969"/>
                    <stop offset="100%" stop-color="#C99A2E"/>
                </linearGradient>
            </defs>
            <circle cx="100" cy="18" r="9" fill="url(#gopGold)"/>
            <rect x="96" y="4" width="8" height="16" fill="url(#gopGold)"/>
            <polygon points="70,60 130,60 118,30 82,30" fill="url(#gopGold)"/>
            <polygon points="60,100 140,100 128,64 72,64" fill="url(#gopGold)" opacity="0.95"/>
            <polygon points="48,145 152,145 138,104 62,104" fill="url(#gopGold)" opacity="0.9"/>
            <polygon points="34,195 166,195 150,149 50,149" fill="url(#gopGold)" opacity="0.85"/>
            <rect x="30" y="195" width="140" height="90" fill="url(#gopGold)" opacity="0.8"/>
            <rect x="88" y="230" width="24" height="55" fill="#450D13"/>
        </svg>

        <div class="hero-stats">
            <div class="hstat"><strong>24/7</strong><span>Support</span></div>
            <div class="hstat"><strong>100%</strong><span>Secure</span></div>
            <div class="hstat"><strong>Fast</strong><span>Approval</span></div>
        </div>
    </div>
</section>

<section class="sections" id="how-it-works">
    <span class="eyebrow section-eyebrow reveal">तीन चरण</span>
    <h2 class="section-title reveal">How it works</h2>
    <p class="section-subtitle reveal">A simple 3-step journey from registration to sacred darshan.</p>
    <div class="steps">
        <div class="step reveal"><div class="step-crest">1</div><h3>Register</h3><p>Fill pilgrim details for your group and submit the booking form.</p></div>
        <div class="step reveal"><div class="step-crest">2</div><h3>Pay &amp; Approve</h3><p>Choose your payment method, upload the screenshot, and wait for admin approval.</p></div>
        <div class="step reveal"><div class="step-crest">3</div><h3>Receive Ticket</h3><p>Once approved, get your registration number and download the digital ticket.</p></div>
    </div>
</section>

<section class="yatra" id="yatra">
    <div class="starfield">
        <span style="width:2px;height:2px;top:10%;left:8%;animation-delay:.3s;"></span>
        <span style="width:2px;height:2px;top:30%;left:88%;animation-delay:1.2s;"></span>
        <span style="width:3px;height:3px;top:60%;left:15%;animation-delay:.8s;"></span>
        <span style="width:2px;height:2px;top:80%;left:75%;animation-delay:2s;"></span>
        <span style="width:2px;height:2px;top:45%;left:50%;animation-delay:1.6s;"></span>
    </div>
    <span class="eyebrow section-eyebrow reveal" style="color:var(--gold-bright);">आभासी यात्रा</span>
    <h2 class="section-title reveal">Your Virtual Darshan Yatra</h2>
    <p class="section-subtitle reveal">Scroll to walk the path every pilgrim takes — from the foothills of Alipiri to the golden gopuram of Lord Venkateswara.</p>

    <div class="yatra-track" id="yatraTrack">
        <div class="yatra-line"><div class="yatra-line-fill" id="yatraFill"></div></div>

        <div class="yatra-stage">
            <div class="yatra-card"><h3>Alipiri Padala Mandapam</h3><p>The sacred foothills where every yatra begins — the footprints of the Lord mark the start of the climb.</p></div>
            <div class="yatra-node"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><path d="M4 20c2-6 4-9 8-9s6 3 8 9"/><circle cx="12" cy="6" r="3"/></svg></div>
        </div>
        <div class="yatra-stage">
            <div class="yatra-card"><h3>The Winding Ghat Road</h3><p>Seven hills, endless curves — the road climbs through misty forest toward the abode of the seven-hilled Lord.</p></div>
            <div class="yatra-node"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><path d="M3 18c4-2 4 2 8 0s4-8 10-4"/></svg></div>
        </div>
        <div class="yatra-stage">
            <div class="yatra-card"><h3>Vaikuntam Queue Complex</h3><p>Pilgrims gather in devotion, moving steadily forward — the anticipation of darshan builds with every step.</p></div>
            <div class="yatra-node"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><circle cx="7" cy="9" r="2.4"/><circle cx="17" cy="9" r="2.4"/><path d="M2.5 19c0-3 2-5 4.5-5s4.5 2 4.5 5M12.5 19c0-3 2-5 4.5-5s4.5 2 4.5 5"/></svg></div>
        </div>
        <div class="yatra-stage">
            <div class="yatra-card"><h3>Maha Dwaram &amp; Gopuram</h3><p>The towering golden gateway rises before you — the threshold between the earthly and the divine.</p></div>
            <div class="yatra-node"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><path d="M6 21V10l6-6 6 6v11"/><path d="M9 21v-7h6v7"/></svg></div>
        </div>
        <div class="yatra-stage">
            <div class="yatra-card"><h3>Garbhagriha Darshan</h3><p>A fleeting, radiant glimpse of the Lord in the sanctum — the moment every pilgrim carries home.</p></div>
            <div class="yatra-node"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><path d="M12 3c1.5 2.5 2 4 0 6-2-2-1.5-3.5 0-6z"/><path d="M6 21c0-5 2.5-8 6-8s6 3 6 8"/></svg></div>
        </div>
        <div class="yatra-stage">
            <div class="yatra-card"><h3>Prasadam &amp; Blessings</h3><p>The journey closes with the famed Tirupati laddu prasadam — sweetness carried beyond the hills.</p></div>
            <div class="yatra-node"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><circle cx="12" cy="13" r="7"/><path d="M9 7c0-1.5 1-2.5 3-2.5s3 1 3 2.5"/></svg></div>
        </div>
    </div>
</section>

@php
    $banners = array_filter([$settings->banner_1 ?? null, $settings->banner_2 ?? null, $settings->banner_3 ?? null, $settings->banner_4 ?? null]);
@endphp
@if(count($banners))
<section class="sections">
    <span class="eyebrow section-eyebrow reveal">झलकियाँ</span>
    <h2 class="section-title reveal">Glimpses of Tirumala</h2>
    <p class="section-subtitle reveal">A few sacred moments from the hill of the seven peaks.</p>
    <div class="gallery-grid">
        @foreach($banners as $b)
        <div class="gallery-item reveal"><img src="{{ asset($b) }}" alt="Tirumala glimpse"></div>
        @endforeach
    </div>
</section>
@endif

<section class="about">
    <div class="about-inner reveal">
        <span class="eyebrow" style="color:var(--gold-bright);">हमारे बारे में</span>
        <h2>{{ $settings->company_name ?? 'Tirumala Tirupati Devasthanams' }}</h2>
        <p>{{ $settings->footer_about_text ?? 'We help pilgrims across the world plan a smooth, dignified and well-organised VIP Entry Darshan at Tirumala — handling approvals, payments and tickets so your only focus is the journey itself.' }}</p>
        @if($settings && ($settings->gst_number || $settings->pan_number || $settings->cin_number))
        <div class="about-meta">
            @if($settings->gst_number)<span><strong>{{ $settings->gst_number }}</strong>GST No.</span>@endif
            @if($settings->pan_number)<span><strong>{{ $settings->pan_number }}</strong>PAN No.</span>@endif
            @if($settings->cin_number)<span><strong>{{ $settings->cin_number }}</strong>CIN No.</span>@endif
        </div>
        @endif
    </div>
</section>

<section class="sections" id="contact">
    <span class="eyebrow section-eyebrow reveal">संपर्क करें</span>
    <h2 class="section-title reveal">Connect With Us</h2>
    <p class="section-subtitle reveal">Reach out any time — our team is here to help with your booking.</p>
    <div class="contact-grid">
        <div class="contact-card reveal">
            @if($settings && $settings->contact_number)
            <div class="contact-row"><div class="ic">☎</div><div><span class="label">Phone</span><a href="tel:{{ $settings->contact_number }}">{{ $settings->contact_number }}</a></div></div>
            @endif
            @if($settings && $settings->whatsapp_number)
            <div class="contact-row"><div class="ic">💬</div><div><span class="label">WhatsApp</span><a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$settings->whatsapp_number) }}" target="_blank" rel="noopener">{{ $settings->whatsapp_number }}</a></div></div>
            @endif
            @if($settings && $settings->email_address)
            <div class="contact-row"><div class="ic">✉</div><div><span class="label">Email</span><a href="mailto:{{ $settings->email_address }}">{{ $settings->email_address }}</a></div></div>
            @endif
            @if($settings && $settings->support_email)
            <div class="contact-row"><div class="ic">🛟</div><div><span class="label">Support</span><a href="mailto:{{ $settings->support_email }}">{{ $settings->support_email }}</a></div></div>
            @endif
            @if($settings && $settings->office_address)
            <div class="contact-row"><div class="ic">📍</div><div><span class="label">Office</span><span>{{ $settings->office_address }}</span></div></div>
            @endif

            @if($settings && ($settings->facebook_url || $settings->instagram_url || $settings->youtube_url || $settings->x_url || $settings->linkedin_url || $settings->telegram_url))
            <div class="social-row">
                @if($settings->facebook_url)<a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook">f</a>@endif
                @if($settings->instagram_url)<a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram">ig</a>@endif
                @if($settings->youtube_url)<a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube">yt</a>@endif
                @if($settings->x_url)<a href="{{ $settings->x_url }}" target="_blank" rel="noopener" aria-label="X">x</a>@endif
                @if($settings->linkedin_url)<a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener" aria-label="LinkedIn">in</a>@endif
                @if($settings->telegram_url)<a href="{{ $settings->telegram_url }}" target="_blank" rel="noopener" aria-label="Telegram">tg</a>@endif
            </div>
            @endif
        </div>

        @if($settings && $settings->google_map_embed_link)
        <div class="map-embed reveal">
            <iframe src="{{ $settings->google_map_embed_link }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Location map"></iframe>
        </div>
        @endif
    </div>
</section>

<div class="cta-band reveal">
    <h2>Ready for your VIP Darshan?</h2>
    <p>Register your group in minutes and let us take care of approvals, payment and your digital ticket.</p>
    <a href="{{ route('vip.create') }}" class="btn">{{ $settings->hero_button_text ?? 'Book VIP Darshan' }}</a>
</div>

<footer>
    <div class="footer-grid">
        <div>
            <div class="footer-brand">
                <img src="{{ $settings && $settings->footer_logo ? asset($settings->footer_logo) : ($settings && $settings->logo ? asset($settings->logo) : asset('images/logo.png')) }}" alt="logo">
                <span>{{ $settings->site_name ?? 'TTD' }}</span>
            </div>
            <p class="about-text">{{ $settings->footer_about_text ?? 'Helping pilgrims plan a peaceful, well-organised VIP Entry Darshan at Tirumala.' }}</p>
        </div>
        <div>
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#how-it-works">How it works</a></li>
                <li><a href="#yatra">Virtual Darshan</a></li>
                <li><a href="{{ route('vip.status') }}">Check Status</a></li>
                <li><a href="{{ route('vip.create') }}">Book Now</a></li>
            </ul>
        </div>
        <div>
            <h4>Legal</h4>
            <ul>
                @if(count($footerMenu))
                    @foreach($footerMenu as $item)
                    <li><a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? 'Link' }}</a></li>
                    @endforeach
                @else
                    @if($settings && $settings->terms_conditions)<li><a href="#">Terms &amp; Conditions</a></li>@endif
                    @if($settings && $settings->privacy_policy)<li><a href="#">Privacy Policy</a></li>@endif
                    @if($settings && $settings->refund_policy)<li><a href="#">Refund Policy</a></li>@endif
                @endif
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <span>{{ $settings->copyright_text ?? ('© '.date('Y').' '.($settings->site_name ?? 'TTD').'. All rights reserved.') }}</span>
        <span>Built for a peaceful pilgrimage.</span>
    </div>
</footer>

@if(!empty($settings->facebook_pixel_id))
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '{{ $settings->facebook_pixel_id }}');
fbq('track', 'PageView');
</script>
@endif

<script>
    window.addEventListener('load', function(){
        var loader = document.getElementById('loader');
        setTimeout(function(){ loader.classList.add('hide'); }, 500);
    });

    // Scroll-reveal
    var revealEls = document.querySelectorAll('.reveal');
    var revealObserver = new IntersectionObserver(function(entries){
        entries.forEach(function(entry){
            if(entry.isIntersecting){
                entry.target.classList.add('in-view');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    revealEls.forEach(function(el){ revealObserver.observe(el); });

    // Yatra stage lighting
    var stages = document.querySelectorAll('.yatra-stage');
    var stageObserver = new IntersectionObserver(function(entries){
        entries.forEach(function(entry){
            if(entry.isIntersecting){ entry.target.classList.add('lit'); }
        });
    }, { threshold: 0.4 });
    stages.forEach(function(s){ stageObserver.observe(s); });

    // Yatra progress line fill
    var track = document.getElementById('yatraTrack');
    var fill = document.getElementById('yatraFill');
    var ticking = false;
    function updateYatraFill(){
        if(!track || !fill) return;
        var rect = track.getBoundingClientRect();
        var vh = window.innerHeight;
        var total = rect.height + vh;
        var progressed = vh - rect.top;
        var pct = Math.max(0, Math.min(1, progressed / total));
        fill.style.height = (pct * 100) + '%';
        ticking = false;
    }
    window.addEventListener('scroll', function(){
        if(!ticking){ window.requestAnimationFrame(updateYatraFill); ticking = true; }
    });
    updateYatraFill();
</script>
</body>
</html>
