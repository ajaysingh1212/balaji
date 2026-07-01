<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name', 'site_title', 'tagline', 'site_slogan', 'company_name', 'contact_number', 'whatsapp_number',
        'email_address', 'support_email', 'office_address', 'google_map_embed_link', 'facebook_url', 'instagram_url',
        'youtube_url', 'x_url', 'linkedin_url', 'telegram_url', 'logo', 'favicon', 'loading_logo', 'meta_title',
        'meta_description', 'meta_keywords', 'og_image', 'robots_meta', 'canonical_url', 'gst_number', 'pan_number',
        'cin_number', 'copyright_text', 'hero_title', 'hero_subtitle', 'hero_button_text', 'hero_button_link',
        'banner_1', 'banner_2', 'banner_3', 'banner_4', 'banner_image', 'smtp_host', 'smtp_port', 'smtp_username',
        'smtp_password', 'mail_from_name', 'mail_from_email', 'google_analytics_id', 'google_tag_manager_id',
        'facebook_pixel_id', 'google_search_console_verification', 'timezone', 'currency', 'currency_symbol',
        'date_format', 'language', 'maintenance_mode', 'footer_about_text', 'footer_logo', 'footer_menu',
        'terms_conditions', 'privacy_policy', 'refund_policy',
    ];
}
