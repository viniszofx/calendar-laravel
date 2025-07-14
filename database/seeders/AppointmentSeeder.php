<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        Appointment::create([
            'title' => 'Reunião de Projeto',
            'description' => 'Reunião inicial do projeto',
            'date' => Carbon::now()->toDateString(),
            'time' => Carbon::now()->format('H:i'),
            'user_id' => $user->id,
        ]);
    }
}
