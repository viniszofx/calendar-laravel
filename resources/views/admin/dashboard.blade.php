@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h1 class="text-2xl font-bold mb-4">Painel Administrativo</h1>
            
            <!-- Estatísticas -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-sm text-blue-600">Total de usuários</div>
                    <div class="text-2xl font-bold text-blue-800">{{ $total }}</div>
                </div>
                <div class="bg-red-50 p-4 rounded-lg">
                    <div class="text-sm text-red-600">Bloqueados</div>
                    <div class="text-2xl font-bold text-red-800">{{ $blocked }}</div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-sm text-green-600">Administradores</div>
                    <div class="text-2xl font-bold text-green-800">{{ $admins }}</div>
                </div>
            </div>

            <!-- Lista de Usuários -->
            <h2 class="text-xl font-semibold mb-4">Lista de Usuários</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 border-b text-left font-medium text-gray-700">Nome</th>
                            <th class="py-3 px-4 border-b text-left font-medium text-gray-700">Email</th>
                            <th class="py-3 px-4 border-b text-center font-medium text-gray-700">Admin</th>
                            <th class="py-3 px-4 border-b text-center font-medium text-gray-700">Status</th>
                            <th class="py-3 px-4 border-b text-center font-medium text-gray-700">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">
                                    <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                </td>
                                <td class="py-3 px-4 border-b">
                                    <div class="text-gray-600">{{ $user->email }}</div>
                                </td>
                                <td class="py-3 px-4 border-b text-center">
                                    @if($user->is_admin)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Usuário
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b text-center">
                                    @if($user->is_blocked)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Bloqueado
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Ativo
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b text-center">
                                    @if(!$user->is_admin)
                                        @if(!$user->is_blocked)
                                            <form action="{{ route('admin.users.block', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                        onclick="return confirm('Tem certeza que deseja bloquear este usuário?')">
                                                    Bloquear
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.unblock', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                                        onclick="return confirm('Tem certeza que deseja desbloquear este usuário?')">
                                                    Desbloquear
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="text-gray-400 text-xs">Admin</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 px-4 text-center text-gray-500">
                                    Nenhum usuário encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>
@endsection
