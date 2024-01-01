<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.pages.profile', [
            'title' => 'Profile'
        ]);
    }

    public function update()
    {
        request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
            'password' => [Rule::when(request('password'), ['required', 'min:5', 'confirmed'])],
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        DB::beginTransaction();
        try {
            $data = request()->all();
            if (request('password')) {
                $data['password'] = bcrypt(request('password'));
            } else {
                $data['password'] = auth()->user()->password;
            }
            if (request()->file('image')) {
                if (auth()->user()->avatar)
                    Storage::disk('public')->delete(auth()->user()->avatar);
                $data['image'] = request()->file('image')->store('user', 'public');
            }
            auth()->user()->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Profile berhasil diupdate.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
