@extends('admin.layout')
@section('title', 'Usuarios')
@section('content')
<h1>Usuarios registrados</h1>
<div class="card" style="padding:0; overflow:hidden;">
<table>
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Plan</th>
            <th>Webs</th>
            <th>Almacenamiento</th>
            <th>Registro</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $row)
        @php $u = $row['user']; @endphp
        <tr>
            <td><strong>{{ $u->name }}</strong>@if($u->is_superadmin) <span class="badge badge-blue">admin</span>@endif</td>
            <td>{{ $u->email }}</td>
            <td><span class="badge badge-gray">{{ $u->plan ?? 'free' }}</span></td>
            <td>{{ $row['site_count'] }}</td>
            <td>{{ $row['storage_kb'] }} KB</td>
            <td style="font-size:.8rem;color:#71717a;">{{ $u->created_at->format('d/m/Y') }}</td>
            <td>
                @if (!$u->is_superadmin)
                <form method="POST" action="{{ route('admin.users.impersonate', $u) }}" style="display:inline;">
                    @csrf
                    <button class="btn btn-dark">Acceder como</button>
                </form>
                <form method="POST" action="{{ route('admin.users.destroy', $u) }}" style="display:inline;"
                      onsubmit="return confirm('¿Eliminar a {{ $u->name }} y todos sus datos? Esta acción no se puede deshacer.')">
                    @csrf @method('DELETE')
                    <button class="btn btn-red">Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection
