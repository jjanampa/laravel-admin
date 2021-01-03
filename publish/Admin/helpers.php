<?php

if (!function_exists('setting')) {
    function setting($key, $defaultValue = false) {
        $keyCachePrefixSetting = 'admin.cache.setting_';
        $keyCache = $keyCachePrefixSetting.$key;
        return cache()->rememberForever($keyCache, function () use ($key, $defaultValue){
            $settingModel = app('Modules\Admin\Entities\Setting');
            $setting = $settingModel::where('key', $key)->first();
            return $setting ? $setting->value : $defaultValue;
        });

    }

}
