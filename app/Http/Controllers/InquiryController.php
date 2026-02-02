<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Store a new inquiry.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Inquiry::create($validated);

        return back()->with('success', 'Thank you! Your message has been sent. We will contact you soon.');
    }
}
