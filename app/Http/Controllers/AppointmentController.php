<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        if ($request->get('view', 'list') === 'calendar') {
            $now = now();
            $firstDay = $now->copy()->startOfMonth();
            $lastDay = $now->copy()->endOfMonth();
            $start = $firstDay->copy()->startOfWeek();
            $end = $lastDay->copy()->endOfWeek();

            $days = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
            $weeks = [];
            $date = $start->copy();
            while ($date->lte($end)) {
                $week = [];
                for ($i = 0; $i < 7; $i++) {
                    $week[] = $date->copy();
                    $date->addDay();
                }
                $weeks[] = $week;
            }
            return view('appointments.index', compact('appointments', 'days', 'weeks'));
        }
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $now = Carbon::now();
        return view('appointments.create', [
            'default_date' => $now->toDateString(),
            'default_time' => $now->format('H:i'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);
        $data['user_id'] = Auth::id();
        Appointment::create($data);
        return redirect()->route('appointments.index')->with('success', 'Compromisso criado!');
    }

    public function edit(Appointment $appointment)
    {
        // Verificar se o appointment pertence ao usuário autenticado
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }
        
        return view('appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Verificar se o appointment pertence ao usuário autenticado
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }
        
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);
        $appointment->update($data);
        return redirect()->route('appointments.index')->with('success', 'Compromisso atualizado!');
    }

    public function destroy(Appointment $appointment)
    {
        // Verificar se o appointment pertence ao usuário autenticado
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }
        
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Compromisso removido!');
    }
}
