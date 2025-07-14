<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Para todos os usuários (incluindo admins), mostra seus compromissos
        $appointments = Appointment::where('user_id', $user->id)->count();
        
        // Se for administrador, adiciona informações administrativas
        if ($user->is_admin) {
            $users = User::count();
            $blocked = User::where('is_blocked', true)->count();
        } else {
            $users = null;
            $blocked = null;
        }
        
        return view('dashboard', compact('appointments', 'users', 'blocked'));
    }
}
