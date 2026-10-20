<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BusinessProfileController extends Controller
{
    public function edit(): View
    {
        $business = auth()->user()->business;

        abort_if(!$business, 404);

        return view('business.profile', compact('business'));
    }

    public function update(Request $request): RedirectResponse
    {
        $business = auth()->user()->business;

        abort_if(!$business, 404);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'business_type' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:50',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'province' => [
                'nullable',
                'string',
                'max:100',
            ],

            'invoice_prefix' => [
                'required',
                'string',
                'max:20',
            ],

            'invoice_notes' => [
                'nullable',
                'string',
            ],

            'bank_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'bank_account_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bank_account_number' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $business->update([
            ...$validated,
            'slug' => Str::slug($validated['name']),
        ]);

        return back()->with(
            'success',
            'Profil bisnis berhasil diperbarui.'
        );
    }
}