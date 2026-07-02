<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\UploadService;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderByDesc('created_at')->get();

        return view('admin.site-settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.site-settings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'nullable|string',
            'site_title' => 'nullable|string',
            'tagline' => 'nullable|string',
            'site_slogan' => 'nullable|string',
            'company_name' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'email_address' => 'nullable|email',
            'support_email' => 'nullable|email',
            'office_address' => 'nullable|string',
            'google_map_embed_link' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'x_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'robots_meta' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'gst_number' => 'nullable|string',
            'pan_number' => 'nullable|string',
            'cin_number' => 'nullable|string',
            'copyright_text' => 'nullable|string',
            'hero_title' => 'nullable|string',
            'hero_subtitle' => 'nullable|string',
            'hero_button_text' => 'nullable|string',
            'hero_button_link' => 'nullable|url',
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|string',
            'smtp_username' => 'nullable|string',
            'smtp_password' => 'nullable|string',
            'mail_from_name' => 'nullable|string',
            'mail_from_email' => 'nullable|email',
            'google_analytics_id' => 'nullable|string',
            'google_tag_manager_id' => 'nullable|string',
            'facebook_pixel_id' => 'nullable|string',
            'google_search_console_verification' => 'nullable|string',
            'timezone' => 'nullable|string',
            'currency' => 'nullable|string',
            'currency_symbol' => 'nullable|string',
            'date_format' => 'nullable|string',
            'language' => 'nullable|string',
            'maintenance_mode' => 'nullable|string',
            'footer_about_text' => 'nullable|string',
            'footer_menu' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
            'privacy_policy' => 'nullable|string',
            'refund_policy' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
            'loading_logo' => 'nullable|image|max:2048',
            'og_image' => 'nullable|image|max:2048',
            'banner_1' => 'nullable|image|max:2048',
            'banner_2' => 'nullable|image|max:2048',
            'banner_3' => 'nullable|image|max:2048',
            'banner_4' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'footer_logo' => 'nullable|image|max:2048',
        ]);

        foreach (['logo', 'favicon', 'loading_logo', 'og_image', 'banner_1', 'banner_2', 'banner_3', 'banner_4', 'banner_image', 'footer_logo'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = UploadService::storePublicFile($request->file($field), 'site-settings');
            }
        }

        SiteSetting::create($data);

        return redirect()->route('admin.site-settings.index')->with('success', 'Site settings created');
    }

    public function edit($id)
    {
        $setting = SiteSetting::findOrFail($id);

        return view('admin.site-settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = SiteSetting::findOrFail($id);

        $data = $request->validate([
            'site_name' => 'nullable|string',
            'site_title' => 'nullable|string',
            'tagline' => 'nullable|string',
            'site_slogan' => 'nullable|string',
            'company_name' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'email_address' => 'nullable|email',
            'support_email' => 'nullable|email',
            'office_address' => 'nullable|string',
            'google_map_embed_link' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'x_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'robots_meta' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'gst_number' => 'nullable|string',
            'pan_number' => 'nullable|string',
            'cin_number' => 'nullable|string',
            'copyright_text' => 'nullable|string',
            'hero_title' => 'nullable|string',
            'hero_subtitle' => 'nullable|string',
            'hero_button_text' => 'nullable|string',
            'hero_button_link' => 'nullable|url',
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|string',
            'smtp_username' => 'nullable|string',
            'smtp_password' => 'nullable|string',
            'mail_from_name' => 'nullable|string',
            'mail_from_email' => 'nullable|email',
            'google_analytics_id' => 'nullable|string',
            'google_tag_manager_id' => 'nullable|string',
            'facebook_pixel_id' => 'nullable|string',
            'google_search_console_verification' => 'nullable|string',
            'timezone' => 'nullable|string',
            'currency' => 'nullable|string',
            'currency_symbol' => 'nullable|string',
            'date_format' => 'nullable|string',
            'language' => 'nullable|string',
            'maintenance_mode' => 'nullable|string',
            'footer_about_text' => 'nullable|string',
            'footer_menu' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
            'privacy_policy' => 'nullable|string',
            'refund_policy' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
            'loading_logo' => 'nullable|image|max:2048',
            'og_image' => 'nullable|image|max:2048',
            'banner_1' => 'nullable|image|max:2048',
            'banner_2' => 'nullable|image|max:2048',
            'banner_3' => 'nullable|image|max:2048',
            'banner_4' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'footer_logo' => 'nullable|image|max:2048',
        ]);

        foreach (['logo', 'favicon', 'loading_logo', 'og_image', 'banner_1', 'banner_2', 'banner_3', 'banner_4', 'banner_image', 'footer_logo'] as $field) {
            if ($request->hasFile($field)) {
                if ($setting->$field) {
                    UploadService::deletePublicFile($setting->$field);
                }
                $data[$field] = UploadService::storePublicFile($request->file($field), 'site-settings');
            }
        }

        $setting->update($data);

        return redirect()->route('admin.site-settings.index')->with('success', 'Site settings updated');
    }

    public function destroy($id)
    {
        $setting = SiteSetting::findOrFail($id);

        foreach (['logo', 'favicon', 'banner_1', 'banner_2', 'banner_3', 'banner_4'] as $field) {
            if ($setting->$field) {
                UploadService::deletePublicFile($setting->$field);
            }
        }

        $setting->delete();

        return back()->with('success', 'Site settings deleted');
    }
}
