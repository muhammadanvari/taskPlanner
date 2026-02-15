<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token', '_method') as $key => $value) {
            $setting = Settings::where('key', $key)->first();
            if ($setting && $setting->type === 'image' && $request->hasFile($key)) {

                $path = $this->uploader($request->file($key));

                if ($setting->value && File::exists(public_path($setting->value))) {
                    File::delete($setting->value);
                }
                $value = $path;
            }
            Settings::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'تنظیمات با موفقیت ذخیره شد.');
    }

    public function uploader($image)
    {
        $path = 'uploads/settings/';
        $filename = time() . '-' . rand() . '.' . $image->getClientOriginalExtension();
        $image->move($path, $filename);
        return $path . $filename;
    }
}
