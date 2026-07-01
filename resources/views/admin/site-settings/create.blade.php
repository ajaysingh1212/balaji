@extends('layouts.admin')
@section('title','Create Site Settings')
@section('content')

<div class="ssw-wrap">
  <div class="ssw-head">
    <div>
      <span class="ssw-eyebrow">Setup Wizard</span>
      <h1 class="ssw-title">Naya Site Settings Banayein</h1>
      <p class="ssw-sub">Step by step apni site ki poori jaankari fill karein — kabhi bhi peeche jaake edit kar sakte hain.</p>
    </div>
    <a href="{{ route('admin.site-settings.index') }}" class="ssw-back"><i class="fas fa-arrow-left"></i> List par wapas</a>
  </div>

  <form method="POST" action="{{ route('admin.site-settings.store') }}" enctype="multipart/form-data" id="sswForm" novalidate>
    @csrf

    <div class="ssw-shell">
      <!-- Rail / Stepper -->
      <aside class="ssw-rail">
        <ol class="ssw-steps" id="sswSteps">
          <li class="ssw-step is-active" data-step="1">
            <span class="ssw-step-dot"><i class="fas fa-fingerprint"></i></span>
            <span class="ssw-step-text"><b>Pehchaan</b><small>Site identity</small></span>
          </li>
          <li class="ssw-step" data-step="2">
            <span class="ssw-step-dot"><i class="fas fa-address-book"></i></span>
            <span class="ssw-step-text"><b>Sampark</b><small>Contact &amp; location</small></span>
          </li>
          <li class="ssw-step" data-step="3">
            <span class="ssw-step-dot"><i class="fas fa-share-nodes"></i></span>
            <span class="ssw-step-text"><b>Social Links</b><small>Follow &amp; share</small></span>
          </li>
          <li class="ssw-step" data-step="4">
            <span class="ssw-step-dot"><i class="fas fa-image"></i></span>
            <span class="ssw-step-text"><b>Branding</b><small>Logo &amp; images</small></span>
          </li>
          <li class="ssw-step" data-step="5">
            <span class="ssw-step-dot"><i class="fas fa-magnifying-glass-chart"></i></span>
            <span class="ssw-step-text"><b>SEO &amp; Tracking</b><small>Search visibility</small></span>
          </li>
          <li class="ssw-step" data-step="6">
            <span class="ssw-step-dot"><i class="fas fa-scale-balanced"></i></span>
            <span class="ssw-step-text"><b>Business &amp; Legal</b><small>GST, PAN, policies</small></span>
          </li>
          <li class="ssw-step" data-step="7">
            <span class="ssw-step-dot"><i class="fas fa-house-chimney"></i></span>
            <span class="ssw-step-text"><b>Homepage</b><small>Hero &amp; footer</small></span>
          </li>
          <li class="ssw-step" data-step="8">
            <span class="ssw-step-dot"><i class="fas fa-gears"></i></span>
            <span class="ssw-step-text"><b>System &amp; Mail</b><small>SMTP, currency, locale</small></span>
          </li>
        </ol>
        <div class="ssw-progress-wrap">
          <div class="ssw-progress-label"><span id="sswProgressText">Step 1 / 8</span><span id="sswProgressPct">13%</span></div>
          <div class="ssw-progress-bar"><div class="ssw-progress-fill" id="sswProgressFill"></div></div>
        </div>
      </aside>

      <!-- Panel -->
      <section class="ssw-panel">

        <div class="ssw-pane is-active" data-pane="1">
          <div class="ssw-pane-head"><span class="ssw-badge">01</span><div><h2>Site ki Pehchaan</h2><p>Yeh naam aur tagline sabse pehle dikhte hain — sahi se bharein.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>Site Name</label><input name="site_name" class="ssw-input" placeholder="Jaise: Eemot Business" value="{{ old('site_name') }}"></div>
            <div class="ssw-field"><label>Site Title</label><input name="site_title" class="ssw-input" placeholder="Browser tab par jo dikhega" value="{{ old('site_title') }}"></div>
            <div class="ssw-field"><label>Tagline / Slogan</label><input name="tagline" class="ssw-input" placeholder="Ek line ka catchy slogan" value="{{ old('tagline') }}"></div>
            <div class="ssw-field"><label>Company Name</label><input name="company_name" class="ssw-input" value="{{ old('company_name') }}"></div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="2">
          <div class="ssw-pane-head"><span class="ssw-badge">02</span><div><h2>Sampark Jaankari</h2><p>Customer aapse yahin se contact karenge.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>Contact Number</label><input name="contact_number" class="ssw-input" placeholder="+91" value="{{ old('contact_number') }}"></div>
            <div class="ssw-field"><label>WhatsApp Number</label><input name="whatsapp_number" class="ssw-input" placeholder="+91" value="{{ old('whatsapp_number') }}"></div>
            <div class="ssw-field"><label>Email Address</label><input name="email_address" type="email" class="ssw-input" value="{{ old('email_address') }}"></div>
            <div class="ssw-field"><label>Support Email</label><input name="support_email" type="email" class="ssw-input" value="{{ old('support_email') }}"></div>
            <div class="ssw-field ssw-span2"><label>Office Address</label><textarea name="office_address" class="ssw-input" rows="2">{{ old('office_address') }}</textarea></div>
            <div class="ssw-field ssw-span2"><label>Google Map Embed Link</label><input name="google_map_embed_link" class="ssw-input" placeholder="https://maps.google.com/..." value="{{ old('google_map_embed_link') }}"></div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="3">
          <div class="ssw-pane-head"><span class="ssw-badge">03</span><div><h2>Social Media Links</h2><p>Sirf jo channels use karte hain wahi bharein, baaki khaali chhod sakte hain.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label><i class="fab fa-facebook ssw-ic"></i> Facebook URL</label><input name="facebook_url" class="ssw-input" value="{{ old('facebook_url') }}"></div>
            <div class="ssw-field"><label><i class="fab fa-instagram ssw-ic"></i> Instagram URL</label><input name="instagram_url" class="ssw-input" value="{{ old('instagram_url') }}"></div>
            <div class="ssw-field"><label><i class="fab fa-youtube ssw-ic"></i> YouTube URL</label><input name="youtube_url" class="ssw-input" value="{{ old('youtube_url') }}"></div>
            <div class="ssw-field"><label><i class="fab fa-x-twitter ssw-ic"></i> X (Twitter) URL</label><input name="x_url" class="ssw-input" value="{{ old('x_url') }}"></div>
            <div class="ssw-field"><label><i class="fab fa-linkedin ssw-ic"></i> LinkedIn URL</label><input name="linkedin_url" class="ssw-input" value="{{ old('linkedin_url') }}"></div>
            <div class="ssw-field"><label><i class="fab fa-telegram ssw-ic"></i> Telegram URL</label><input name="telegram_url" class="ssw-input" value="{{ old('telegram_url') }}"></div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="4">
          <div class="ssw-pane-head"><span class="ssw-badge">04</span><div><h2>Branding &amp; Images</h2><p>Upload karte hi neeche preview dikh jayega.</p></div></div>
          <div class="ssw-grid ssw-grid-media">
            <div class="ssw-upload"><label>Logo</label><div class="ssw-drop" data-target="logoPreview"><img id="logoPreview" class="ssw-preview d-none"><i class="fas fa-cloud-arrow-up"></i><span>Logo choose karein</span><input type="file" name="logo" accept="image/*" onchange="sswPreview(this,'logoPreview')"></div></div>
            <div class="ssw-upload"><label>Favicon</label><div class="ssw-drop" data-target="faviconPreview"><img id="faviconPreview" class="ssw-preview d-none"><i class="fas fa-cloud-arrow-up"></i><span>Favicon choose karein</span><input type="file" name="favicon" accept="image/*" onchange="sswPreview(this,'faviconPreview')"></div></div>
            <div class="ssw-upload"><label>Loading Logo</label><div class="ssw-drop" data-target="loadingPreview"><img id="loadingPreview" class="ssw-preview d-none"><i class="fas fa-cloud-arrow-up"></i><span>Loader logo choose karein</span><input type="file" name="loading_logo" accept="image/*" onchange="sswPreview(this,'loadingPreview')"></div></div>
            <div class="ssw-upload"><label>OG Image</label><div class="ssw-drop" data-target="ogPreview"><img id="ogPreview" class="ssw-preview d-none"><i class="fas fa-cloud-arrow-up"></i><span>Share preview image</span><input type="file" name="og_image" accept="image/*" onchange="sswPreview(this,'ogPreview')"></div></div>
            <div class="ssw-upload"><label>Banner Image</label><div class="ssw-drop" data-target="bannerPreview"><img id="bannerPreview" class="ssw-preview d-none"><i class="fas fa-cloud-arrow-up"></i><span>Homepage banner</span><input type="file" name="banner_image" accept="image/*" onchange="sswPreview(this,'bannerPreview')"></div></div>
            <div class="ssw-upload"><label>Footer Logo</label><div class="ssw-drop" data-target="footerLogoPreview"><img id="footerLogoPreview" class="ssw-preview d-none"><i class="fas fa-cloud-arrow-up"></i><span>Footer logo</span><input type="file" name="footer_logo" accept="image/*" onchange="sswPreview(this,'footerLogoPreview')"></div></div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="5">
          <div class="ssw-pane-head"><span class="ssw-badge">05</span><div><h2>SEO &amp; Tracking</h2><p>Google aur social par site sahi tarike se dikhne ke liye.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>Meta Title</label><input name="meta_title" class="ssw-input" value="{{ old('meta_title') }}"></div>
            <div class="ssw-field"><label>Meta Keywords</label><input name="meta_keywords" class="ssw-input" value="{{ old('meta_keywords') }}"></div>
            <div class="ssw-field ssw-span2"><label>Meta Description</label><textarea name="meta_description" class="ssw-input" rows="3">{{ old('meta_description') }}</textarea></div>
            <div class="ssw-field"><label>Robots Meta</label><input name="robots_meta" class="ssw-input" placeholder="index, follow" value="{{ old('robots_meta') }}"></div>
            <div class="ssw-field"><label>Canonical URL</label><input name="canonical_url" class="ssw-input" value="{{ old('canonical_url') }}"></div>
            <div class="ssw-field"><label>Google Analytics ID</label><input name="google_analytics_id" class="ssw-input" placeholder="G-XXXXXXX" value="{{ old('google_analytics_id') }}"></div>
            <div class="ssw-field"><label>Google Tag Manager ID</label><input name="google_tag_manager_id" class="ssw-input" placeholder="GTM-XXXXXXX" value="{{ old('google_tag_manager_id') }}"></div>
            <div class="ssw-field"><label>Facebook Pixel ID</label><input name="facebook_pixel_id" class="ssw-input" value="{{ old('facebook_pixel_id') }}"></div>
            <div class="ssw-field ssw-span2"><label>Google Search Console Verification</label><input name="google_search_console_verification" class="ssw-input" value="{{ old('google_search_console_verification') }}"></div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="6">
          <div class="ssw-pane-head"><span class="ssw-badge">06</span><div><h2>Business &amp; Legal</h2><p>Compliance aur legal documents ke liye zaroori details.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>GST Number</label><input name="gst_number" class="ssw-input" placeholder="22AAAAA0000A1Z5" value="{{ old('gst_number') }}"></div>
            <div class="ssw-field"><label>PAN Number</label><input name="pan_number" class="ssw-input" placeholder="AAAAA0000A" value="{{ old('pan_number') }}"></div>
            <div class="ssw-field"><label>CIN Number</label><input name="cin_number" class="ssw-input" value="{{ old('cin_number') }}"></div>
            <div class="ssw-field"><label>Copyright Text</label><input name="copyright_text" class="ssw-input" placeholder="© 2026 Company Name" value="{{ old('copyright_text') }}"></div>
            <div class="ssw-field ssw-span2"><label>Terms &amp; Conditions</label><textarea name="terms_conditions" class="ssw-input" rows="3">{{ old('terms_conditions') }}</textarea></div>
            <div class="ssw-field ssw-span2"><label>Privacy Policy</label><textarea name="privacy_policy" class="ssw-input" rows="3">{{ old('privacy_policy') }}</textarea></div>
            <div class="ssw-field ssw-span2"><label>Refund Policy</label><textarea name="refund_policy" class="ssw-input" rows="3">{{ old('refund_policy') }}</textarea></div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="7">
          <div class="ssw-pane-head"><span class="ssw-badge">07</span><div><h2>Homepage &amp; Footer</h2><p>Website khulte hi jo sabse pehle dikhta hai.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>Hero Title</label><input name="hero_title" class="ssw-input" value="{{ old('hero_title') }}"></div>
            <div class="ssw-field"><label>Hero Subtitle</label><input name="hero_subtitle" class="ssw-input" value="{{ old('hero_subtitle') }}"></div>
            <div class="ssw-field"><label>Hero Button Text</label><input name="hero_button_text" class="ssw-input" placeholder="Jaise: Shuru Karein" value="{{ old('hero_button_text') }}"></div>
            <div class="ssw-field"><label>Hero Button Link</label><input name="hero_button_link" class="ssw-input" value="{{ old('hero_button_link') }}"></div>
            <div class="ssw-field ssw-span2"><label>Footer About Text</label><textarea name="footer_about_text" class="ssw-input" rows="3">{{ old('footer_about_text') }}</textarea></div>
            <div class="ssw-field ssw-span2"><label>Footer Menu</label><textarea name="footer_menu" class="ssw-input" rows="3" placeholder="Ek line mein ek menu item">{{ old('footer_menu') }}</textarea></div>
          </div>
        </div>

        <div class="ssw-pane" data-pane="8">
          <div class="ssw-pane-head"><span class="ssw-badge">08</span><div><h2>System &amp; Mail Settings</h2><p>Yeh technical settings site ke peeche kaam karti hain.</p></div></div>
          <div class="ssw-grid">
            <div class="ssw-field"><label>SMTP Host</label><input name="smtp_host" class="ssw-input" value="{{ old('smtp_host') }}"></div>
            <div class="ssw-field"><label>SMTP Port</label><input name="smtp_port" class="ssw-input" value="{{ old('smtp_port') }}"></div>
            <div class="ssw-field"><label>SMTP Username</label><input name="smtp_username" class="ssw-input" value="{{ old('smtp_username') }}"></div>
            <div class="ssw-field"><label>SMTP Password</label><input name="smtp_password" type="password" class="ssw-input" autocomplete="new-password"></div>
            <div class="ssw-field"><label>Mail From Name</label><input name="mail_from_name" class="ssw-input" value="{{ old('mail_from_name') }}"></div>
            <div class="ssw-field"><label>Mail From Email</label><input name="mail_from_email" type="email" class="ssw-input" value="{{ old('mail_from_email') }}"></div>
            <div class="ssw-field"><label>Timezone</label><input name="timezone" class="ssw-input" placeholder="Asia/Kolkata" value="{{ old('timezone','Asia/Kolkata') }}"></div>
            <div class="ssw-field"><label>Currency</label><input name="currency" class="ssw-input" placeholder="INR" value="{{ old('currency','INR') }}"></div>
            <div class="ssw-field"><label>Currency Symbol</label><input name="currency_symbol" class="ssw-input" placeholder="₹" value="{{ old('currency_symbol','₹') }}"></div>
            <div class="ssw-field"><label>Date Format</label><input name="date_format" class="ssw-input" placeholder="d-m-Y" value="{{ old('date_format','d-m-Y') }}"></div>
            <div class="ssw-field"><label>Language</label><input name="language" class="ssw-input" placeholder="Hindi / English" value="{{ old('language') }}"></div>
            <div class="ssw-field">
              <label>Maintenance Mode</label>
              <select name="maintenance_mode" class="ssw-input">
                <option value="off">Off — Site chalu rahegi</option>
                <option value="on">On — Site band rahegi</option>
              </select>
            </div>
          </div>
        </div>

        <div class="ssw-actions">
          <button type="button" class="ssw-btn ssw-btn-ghost" id="sswPrev"><i class="fas fa-arrow-left"></i> Peeche</button>
          <div class="ssw-actions-right">
            <span class="ssw-autosave"><i class="fas fa-shield-halved"></i> Data safe rahega jab tak submit na karein</span>
            <button type="button" class="ssw-btn ssw-btn-primary" id="sswNext">Aage Badhein <i class="fas fa-arrow-right"></i></button>
            <button type="submit" class="ssw-btn ssw-btn-success d-none" id="sswSubmit"><i class="fas fa-check"></i> Settings Save Karein</button>
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
    --ssw-bg:#f7f5fc;
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
  .ssw-progress-fill{height:100%;width:12.5%;background:var(--ssw-gold);border-radius:99px;transition:width .35s ease;}

  .ssw-panel{background:var(--ssw-glass);border:1px solid var(--ssw-line);border-radius:20px;padding:28px;box-shadow:0 20px 45px -30px rgba(30,27,46,.35);min-height:460px;display:flex;flex-direction:column;}
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
  .ssw-ic{color:var(--ssw-violet-2);margin-right:4px;}
  .ssw-input{width:100%;border:1.5px solid var(--ssw-line);background:#fff;border-radius:11px;padding:11px 14px;font-family:'Inter',sans-serif;font-size:13.5px;color:var(--ssw-ink);transition:.18s;}
  .ssw-input:focus{outline:none;border-color:var(--ssw-violet-2);box-shadow:0 0 0 4px rgba(124,58,237,.14);}
  textarea.ssw-input{resize:vertical;}

  .ssw-grid-media{grid-template-columns:repeat(3,1fr);}
  @media(max-width:900px){.ssw-grid-media{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:520px){.ssw-grid-media{grid-template-columns:1fr;}}
  .ssw-upload label{display:block;font-family:'Inter',sans-serif;font-size:12.5px;font-weight:600;margin-bottom:6px;color:#443f5c;}
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
