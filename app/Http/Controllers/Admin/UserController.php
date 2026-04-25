<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function impersonate(User $user)
    {
        session(['_admin_id' => auth()->id()]);
        Auth::loginUsingId($user->id);
        return redirect('/dashboard');
    }

    public function destroy(User $user)
    {
        foreach ($user->sites as $site) {
            Storage::disk('public')->deleteDirectory("sites/{$site->id}");
        }

        $user->delete();

        return back()->with('success', "Usuario {$user->email} eliminado.");
    }

    public function stopImpersonating()
    {
        $adminId = session('_admin_id');
        if (! $adminId) return redirect('/dashboard');

        $admin = User::find($adminId);
        if (! $admin) {
            session()->forget('_admin_id');
            Auth::logout();
            return redirect('/login');
        }

        session()->forget('_admin_id');
        Auth::loginUsingId($adminId);
        return redirect('/admin');
    }
}
