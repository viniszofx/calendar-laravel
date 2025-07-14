<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $total = $users->count();
        $blocked = $users->where('is_blocked', true)->count();
        $admins = $users->where('is_admin', true)->count();
        return view('admin.dashboard', compact('users', 'total', 'blocked', 'admins'));
    }

    public function block(User $user)
    {
        $user->is_blocked = true;
        $user->save();
        return back()->with('success', 'Usuário bloqueado!');
    }

    public function unblock(User $user)
    {
        $user->is_blocked = false;
        $user->save();
        return back()->with('success', 'Usuário desbloqueado!');
    }
}
