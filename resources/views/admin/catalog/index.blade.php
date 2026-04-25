@extends('admin.layout')
@section('title', 'Catálogo')
@section('content')
<h1>Catálogo de sectores</h1>

<div class="card">
    <h2>Añadir sector</h2>
    <form method="POST" action="{{ route('admin.catalog.store') }}">
        @csrf
        <div class="form-row">
            <div><label>Key (único, sin espacios)</label><input type="text" name="key" placeholder="arquitectura"></div>
            <div><label>Etiqueta</label><input type="text" name="label" placeholder="Arquitectura"></div>
            <div>
                <label>Icono</label>
                <div style="display:flex;align-items:center;gap:.5rem;">
                    <span id="icon-preview" style="font-size:1.5rem;line-height:1;">🏢</span>
                    <input type="hidden" name="icon" id="icon-input" value="🏢">
                    <button type="button" class="btn btn-outline" onclick="togglePicker()">Elegir</button>
                </div>
                <div id="icon-picker" style="display:none;grid-template-columns:repeat(8,1fr);gap:.25rem;margin-top:.5rem;padding:.75rem;background:#f4f4f5;border-radius:8px;max-width:320px;">
                    @foreach(['✂️','🍽️','🏗️','👗','💇','🏥','🏋️','🎓','🏠','🚗','💅','🐾','📸','🎵','⚖️','🌿','💻','🏪','🍺','☕','🍕','🔧','⚡','🏛️','🎨','📱','🏨','💐','🧘','💼','🎭','🛒','🔑','🌊','🚀','🏖️','🍰','🌺','🏢'] as $emoji)
                    <span onclick="selectIcon('{{ $emoji }}')" title="{{ $emoji }}"
                        style="cursor:pointer;font-size:1.4rem;text-align:center;padding:.25rem;border-radius:4px;line-height:1.4;"
                        onmouseover="this.style.background='#e4e4e7'" onmouseout="this.style.background='none'">{{ $emoji }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <label>Template base</label>
                <select name="template_key">
                    @foreach ($templates as $t)
                        <option value="{{ $t }}">{{ $t }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-actions"><button class="btn btn-dark">Crear sector</button></div>
    </form>
</div>

<div class="card" style="padding:0; overflow:hidden;">
<table>
    <thead>
        <tr><th>Sector</th><th>Template</th><th>Variantes</th><th></th></tr>
    </thead>
    <tbody>
    @foreach ($sectors as $sector)
    <tr>
        <td><strong>{{ $sector->icon }} {{ $sector->label }}</strong><br><small style="color:#71717a;">{{ $sector->key }}</small></td>
        <td><span class="badge badge-gray">{{ $sector->template_key }}</span></td>
        <td>{{ $sector->variants->count() }}</td>
        <td>
            <a href="{{ route('admin.catalog.sector', $sector) }}" class="btn btn-outline">Ver variantes</a>
            <form method="POST" action="{{ route('admin.catalog.sector.destroy', $sector) }}" style="display:inline;" onsubmit="return confirm('¿Borrar sector y todas sus variantes?')">
                @csrf @method('DELETE')
                <button class="btn btn-red">Borrar</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
<script>
function togglePicker() {
    const p = document.getElementById('icon-picker');
    p.style.display = p.style.display === 'none' ? 'grid' : 'none';
}
function selectIcon(emoji) {
    document.getElementById('icon-input').value = emoji;
    document.getElementById('icon-preview').textContent = emoji;
    document.getElementById('icon-picker').style.display = 'none';
}
</script>
@endsection
