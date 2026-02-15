<?php


use App\Models\Settings;

if (!function_exists('setting')) {
    /**
     * گرفتن مقدار تنظیمات بر اساس کلید
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        $setting = Settings::where('key', $key)->first();
        return $setting->value ?? $default;
    }
}
