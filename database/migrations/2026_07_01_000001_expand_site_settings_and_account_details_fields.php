<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('site_title')->nullable()->after('site_name');
            $table->string('site_slogan')->nullable()->after('tagline');
            $table->string('company_name')->nullable()->after('site_slogan');
            $table->string('contact_number')->nullable()->after('company_name');
            $table->string('whatsapp_number')->nullable()->after('contact_number');
            $table->string('email_address')->nullable()->after('whatsapp_number');
            $table->string('support_email')->nullable()->after('email_address');
            $table->text('office_address')->nullable()->after('support_email');
            $table->text('google_map_embed_link')->nullable()->after('office_address');
            $table->string('facebook_url')->nullable()->after('google_map_embed_link');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('youtube_url')->nullable()->after('instagram_url');
            $table->string('x_url')->nullable()->after('youtube_url');
            $table->string('linkedin_url')->nullable()->after('x_url');
            $table->string('telegram_url')->nullable()->after('linkedin_url');
            $table->string('loading_logo')->nullable()->after('favicon');
            $table->string('og_image')->nullable()->after('meta_keywords');
            $table->string('robots_meta')->nullable()->after('og_image');
            $table->string('canonical_url')->nullable()->after('robots_meta');
            $table->string('gst_number')->nullable()->after('canonical_url');
            $table->string('pan_number')->nullable()->after('gst_number');
            $table->string('cin_number')->nullable()->after('pan_number');
            $table->text('copyright_text')->nullable()->after('cin_number');
            $table->string('hero_title')->nullable()->after('copyright_text');
            $table->string('hero_subtitle')->nullable()->after('hero_title');
            $table->string('hero_button_text')->nullable()->after('hero_subtitle');
            $table->string('hero_button_link')->nullable()->after('hero_button_text');
            $table->string('banner_image')->nullable()->after('hero_button_link');
            $table->string('smtp_host')->nullable()->after('banner_image');
            $table->string('smtp_port')->nullable()->after('smtp_host');
            $table->string('smtp_username')->nullable()->after('smtp_port');
            $table->string('smtp_password')->nullable()->after('smtp_username');
            $table->string('mail_from_name')->nullable()->after('smtp_password');
            $table->string('mail_from_email')->nullable()->after('mail_from_name');
            $table->string('google_analytics_id')->nullable()->after('mail_from_email');
            $table->string('google_tag_manager_id')->nullable()->after('google_analytics_id');
            $table->string('facebook_pixel_id')->nullable()->after('google_tag_manager_id');
            $table->string('google_search_console_verification')->nullable()->after('facebook_pixel_id');
            $table->string('timezone')->nullable()->after('google_search_console_verification');
            $table->string('currency')->nullable()->after('timezone');
            $table->string('currency_symbol')->nullable()->after('currency');
            $table->string('date_format')->nullable()->after('currency_symbol');
            $table->string('language')->nullable()->after('date_format');
            $table->string('maintenance_mode')->nullable()->after('language');
            $table->text('footer_about_text')->nullable()->after('maintenance_mode');
            $table->string('footer_logo')->nullable()->after('footer_about_text');
            $table->text('footer_menu')->nullable()->after('footer_logo');
            $table->text('terms_conditions')->nullable()->after('footer_menu');
            $table->text('privacy_policy')->nullable()->after('terms_conditions');
            $table->text('refund_policy')->nullable()->after('privacy_policy');
        });

        Schema::table('account_details', function (Blueprint $table) {
            $table->string('confirm_account_number')->nullable()->after('account_number');
            $table->string('branch_name')->nullable()->after('ifsc_code');
            $table->string('account_type')->nullable()->after('branch_name');
            $table->string('upi_id')->nullable()->after('upi_number');
            $table->string('swift_code')->nullable()->after('upi_id');
            $table->string('micr_code')->nullable()->after('swift_code');
            $table->string('gst_number')->nullable()->after('micr_code');
            $table->string('pan_number')->nullable()->after('gst_number');
            $table->text('payment_instructions')->nullable()->after('pan_number');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'site_title','site_slogan','company_name','contact_number','whatsapp_number','email_address','support_email','office_address','google_map_embed_link','facebook_url','instagram_url','youtube_url','x_url','linkedin_url','telegram_url','loading_logo','og_image','robots_meta','canonical_url','gst_number','pan_number','cin_number','copyright_text','hero_title','hero_subtitle','hero_button_text','hero_button_link','banner_image','smtp_host','smtp_port','smtp_username','smtp_password','mail_from_name','mail_from_email','google_analytics_id','google_tag_manager_id','facebook_pixel_id','google_search_console_verification','timezone','currency','currency_symbol','date_format','language','maintenance_mode','footer_about_text','footer_logo','footer_menu','terms_conditions','privacy_policy','refund_policy',
            ]);
        });

        Schema::table('account_details', function (Blueprint $table) {
            $table->dropColumn(['confirm_account_number','branch_name','account_type','upi_id','swift_code','micr_code','gst_number','pan_number','payment_instructions']);
        });
    }
};
