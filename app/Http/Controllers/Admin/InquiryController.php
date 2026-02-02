<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index(): View
    {
        $inquiries = Inquiry::latest()->paginate(20);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * Display the specified inquiry.
     */
    public function show(Inquiry $inquiry): View
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * Update inquiry status.
     */
    public function update(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:new,replied,archived',
        ]);

        $inquiry->update($validated);

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Inquiry updated successfully.');
    }
}
