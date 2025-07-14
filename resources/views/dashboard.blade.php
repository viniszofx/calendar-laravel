@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Painel</h1>
            <div class="mb-6">
                <div class="text-gray-900 dark:text-gray-100">Meus compromissos: <b>{{ $appointments }}</b></div>
                @if(!is_null($users))
                    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <h3 class="font-semibold text-blue-800 dark:text-blue-200 mb-2">Informações Administrativas:</h3>
                        <div class="text-blue-700 dark:text-blue-300">Total de usuários: <b>{{ $users }}</b></div>
                        <div class="text-blue-700 dark:text-blue-300">Bloqueados: <b>{{ $blocked }}</b></div>
                        <div class="mt-2">
                            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 hover:underline">
                                Ir para Painel Administrativo
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <a href="{{ route('appointments.index') }}">
                <x-button>Ver Compromissos</x-button>
            </a>
        </x-card>
    </div>
</div>
@endsection
