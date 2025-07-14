@extends('layouts.app')

@section('content')
<x-card>
    <h1 class="text-2xl font-bold mb-4">Editar Compromisso</h1>
    <form method="POST" action="{{ route('appointments.update', $appointment) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block mb-1">Título</label>
            <x-input id="title" name="title" value="{{ old('title', $appointment->title) }}" required />
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-1">Descrição</label>
            <x-input id="description" name="description" value="{{ old('description', $appointment->description) }}" />
        </div>
        <div class="mb-4">
            <label for="date" class="block mb-1">Data</label>
            <x-input id="date" name="date" type="date" value="{{ old('date', $appointment->date) }}" required />
        </div>
        <div class="mb-4">
            <label for="time" class="block mb-1">Hora</label>
            <x-input id="time" name="time" type="time" value="{{ old('time', $appointment->time) }}" required />
        </div>
        <x-button type="submit">Atualizar</x-button>
        <a href="{{ route('appointments.index') }}" class="ml-2 text-gray-600">Cancelar</a>
    </form>
</x-card>
@endsection
