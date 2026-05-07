@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Gestión de Usuarios</h1>
            <a href="{{ route('admin.dashboard') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver al Panel
            </a>
        </div>

        @if(session('success'))
            <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background: #e74c3c; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                    <tr>
                        <th style="padding: 15px; color: #555;">ID</th>
                        <th style="padding: 15px; color: #555;">Nombre</th>
                        <th style="padding: 15px; color: #555;">Email</th>
                        <th style="padding: 15px; color: #555;">Rol</th>
                        <th style="padding: 15px; color: #555;">Pedidos</th>
                        <th style="padding: 15px; color: #555; text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px; color: #999;">#{{ $user->id }}</td>
                            <td style="padding: 15px; font-weight: bold; color: #070D59;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <div style="width: 30px; height: 30px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #777;">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    @endif
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td style="padding: 15px; color: #777;">{{ $user->email }}</td>
                            <td style="padding: 15px;">
                                @if($user->is_admin)
                                    <span style="background: #070D59; color: white; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase;">Administrador</span>
                                @else
                                    <span style="background: #f1f1f1; color: #777; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase;">Usuario</span>
                                @endif
                            </td>
                            <td style="padding: 15px; color: #555; font-weight: bold;">{{ $user->orders_count }}</td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="{{ route('admin.users.edit', $user->id) }}" style="color: #F7B633; margin-right: 15px; text-decoration: none;" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; padding: 0;" title="Eliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
