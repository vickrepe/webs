@extends('admin.layout')
@section('title', 'Sites')
@section('content')
<h1>Sites</h1>
<div class="card" style="padding:0;overflow:hidden;">
<table>
    <thead><tr><th>Site</th><th>Usuario</th><th>Template</th><th>Publicado</th><th></th></tr></thead>
    <tbody>
    @foreach($sites as $site)
    <tr>
        <td>
            <strong>{{ $site->config['business_name'] ?? $site->slug }}</strong><br>
            <span style="font-size:.8rem;color:#71717a;">/site/{{ $site->slug }}</span>
        </td>
        <td>{{ $site->user->email }}</td>
        <td><span class="badge badge-gray">{{ $site->template ?? $site->sector }}</span></td>
        <td>{{ $site->published_at ? $site->published_at->format('d/m/Y') : '—' }}</td>
        <td><a href="{{ route('admin.sites.show', $site) }}" class="btn btn-dark">Editar</a></td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
{{ $sites->links() }}
@endsection
