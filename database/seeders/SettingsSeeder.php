<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'TanzaAdmin'],
            ['key' => 'site_email', 'value' => 'support@tanzaadmin.com'],
            ['key' => 'site_phone', 'value' => '123-456-7890'],
            ['key' => 'address', 'value' => '123 Main Street, Anytown, USA'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/yourpage'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/yourpage'],
            ['key' => 'telegram_url', 'value' => 'https://t.me/yourchannel'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/yourpage'],
            ['key' => 'primary_color', 'value' => '#3498db'],
            ['key' => 'footer_copyright', 'value' => '© 2024 Your Company. All rights reserved.'],
            ['key' => 'logo_light', 'value' => 'settings/logo_light.png'], // Update with actual file path
            ['key' => 'logo_dark', 'value' => 'settings/logo_dark.png'], // Update with actual file path
            ['key' => 'favicon', 'value' => 'settings/favicon.png'], // Update with actual file path
            ['key' => 'header_code', 'value' => '<!-- Header Custom Code -->'],
            ['key' => 'footer_code', 'value' => '<!-- Footer Custom Code -->'],
            ['key' => 'email_method', 'value' => 'smtp'],
            ['key' => 'smtp_host', 'value' => 'panel.tanzahost.com'],
            ['key' => 'smtp_port', 'value' => '465'],
            ['key' => 'smtp_username', 'value' => 'hire@almirfrances.com'],
            ['key' => 'smtp_password', 'value' => 'tanzahostA1@'],
            ['key' => 'smtp_encryption', 'value' => 'tls'],
            ['key' => 'smtp_from_email', 'value' => 'hire@almirfrances.com'],
            ['key' => 'smtp_from_name', 'value' => 'Your Company Name'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}