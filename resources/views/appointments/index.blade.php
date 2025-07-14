@php
    $appointments = $appointments ?? collect();
@endphp
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Meus Compromissos</h1>
                <a href="{{ route('appointments.create') }}">
                    <x-button>Novo Compromisso</x-button>
                </a>
            </div>
            <div class="mb-6">
                <a href="?view=list" class="mr-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 {{ request('view', 'list') == 'list' ? 'font-bold underline' : '' }}">Lista</a>
                <a href="?view=calendar" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 {{ request('view') == 'calendar' ? 'font-bold underline' : '' }}">Calendário</a>
            </div>
            @if(request('view', 'list') == 'calendar' && isset($days) && isset($weeks))
                <x-calendar :appointments="$appointments" :days="$days" :weeks="$weeks" />
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">Título</th>
                                <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">Data</th>
                                <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">Hora</th>
                                <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">{{ $appointment->title }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">{{ $appointment->date }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">{{ $appointment->time }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">
                                        <a href="{{ route('appointments.edit', $appointment) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Editar</a>
                                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 ml-2" onclick="return confirm('Remover compromisso?')">Remover</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </x-card>
    </div>
</div>
@endsection
