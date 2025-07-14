@extends('layouts.app')

@section('content')
<x-card>
    <h1 class="text-2xl font-bold mb-4">Novo Compromisso</h1>
    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf
        <div class="mb-4">
            <label for="title" class="block mb-1">Título</label>
            <x-input id="title" name="title" value="{{ old('title') }}" required />
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-1">Descrição</label>
            <x-input id="description" name="description" value="{{ old('description') }}" />
        </div>
        <div class="mb-4">
            <label for="date" class="block mb-1">Data</label>
            <x-input id="date" name="date" type="date" value="{{ old('date', $default_date) }}" required />
        </div>
        <div class="mb-4">
            <label for="time" class="block mb-1">Hora</label>
            <x-input id="time" name="time" type="time" value="{{ old('time', $default_time) }}" required />
        </div>
        <x-button type="submit">Salvar</x-button>
        <a href="{{ route('appointments.index') }}" class="ml-2 text-gray-600">Cancelar</a>
    </form>
</x-card>
@endsection
