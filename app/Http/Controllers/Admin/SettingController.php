<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Show the settings form.
     */
    public function edit(): View
    {
        $settings = Setting::first();

        if (!$settings) {
            $settings = new Setting(Setting::defaults());
        }

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message_template' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:30',
            'email_destination' => 'nullable|email|max:255',
            'social_links' => 'nullable|array',
            'social_links.facebook' => 'nullable|url',
            'social_links.instagram' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
            'social_links.youtube' => 'nullable|url',
            'products' => 'nullable|array',
            'products.*.name' => 'nullable|string|max:255',
            'products.*.url' => 'nullable|url|max:255',
            'products.*.description' => 'nullable|string|max:500',
            'products.*.category' => 'nullable|string|max:100',
            'products.*.status' => 'nullable|string|max:50',
            'products.*.icon' => 'nullable|string|max:100',
        ]);

        $validated['products'] = collect($validated['products'] ?? [])
            ->map(function (array $product): array {
                return [
                    'name' => trim($product['name'] ?? ''),
                    'url' => trim($product['url'] ?? ''),
                    'description' => trim($product['description'] ?? ''),
                    'category' => trim($product['category'] ?? ''),
                    'status' => trim($product['status'] ?? ''),
                    'icon' => trim($product['icon'] ?? ''),
                ];
            })
            ->filter(fn (array $product) => $product['name'] !== '' && $product['url'] !== '')
            ->values()
            ->all();

        $settings = Setting::first();

        if (!$settings) {
            $settings = Setting::create(array_merge(Setting::defaults(), $validated));
        } else {
            $settings->update($validated);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
