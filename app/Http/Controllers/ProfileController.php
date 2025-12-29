<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function store(Request $request)
{
    // Pastikan service_id diterima sebagai array (karena pilih banyak)
    $request->validate([
        'service_id' => 'required|array',
        'service_id.*' => 'exists:services,id',
    ]);

    // AMBIL HARGA DARI DATABASE & JUMLAHKAN
    $totalPrice = \App\Models\Service::whereIn('id', $request->service_id)->sum('price');

    // SIMPAN KE TABEL PESANAN
    \App\Models\ServiceOrder::create([
        'user_id'      => $request->user_id,
        'plate_number' => $request->plate_number,
        'total_price'  => $totalPrice, // Nilai ini sekarang akan akurat
        'status'       => 'pending',
        'service_date' => $request->service_date,
    ]);

    return redirect()->back()->with('success', 'Antrean berhasil dibuat!');
}
}
