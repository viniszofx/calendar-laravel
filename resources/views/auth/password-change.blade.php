@extends('layouts.app')

@section('content')
<x-card>
    <h1 class="text-2xl font-bold mb-4">Trocar Senha</h1>
    <form method="POST" action="{{ route('password.change.update') }}">
        @csrf
        <div class="mb-4">
            <label for="password" class="block mb-1">Nova Senha</label>
            <x-input id="password" name="password" type="password" required />
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block mb-1">Confirme a Senha</label>
            <x-input id="password_confirmation" name="password_confirmation" type="password" required />
        </div>
        <x-button type="submit">Salvar</x-button>
    </form>
</x-card>
@endsection
