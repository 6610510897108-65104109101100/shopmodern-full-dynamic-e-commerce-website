<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingAdminController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_button_text' => 'nullable|string|max:255',
            'hero_button_link' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|max:5120', // 5MB max
        ]);

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => '/storage/' . $path]);
        }

        foreach (['hero_title', 'hero_subtitle', 'hero_button_text', 'hero_button_link'] as $key) {
            if (isset($data[$key])) {
                Setting::updateOrCreate(['key' => $key], ['value' => $data[$key]]);
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
