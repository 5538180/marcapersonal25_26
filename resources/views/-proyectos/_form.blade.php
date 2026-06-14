{{-- Parcial reutilizable antiguo: create/edit -> @include('proyectos._form') --}}
<form action="{{ $action }}" method="POST">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="row">
        <div class="col-6 col-12-small">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proyecto?->nombre) }}" />
            @error('nombre')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="col-6 col-12-small">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $proyecto?->slug) }}" />
            @error('slug')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="col-12">
            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion" rows="6">{{ old('descripcion', $proyecto?->descripcion) }}</textarea>
            @error('descripcion')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="col-6 col-12-small">
            <label for="url">URL</label>
            <input type="url" name="url" id="url" value="{{ old('url', $proyecto?->url) }}" />
            @error('url')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="col-6 col-12-small">
            <label for="imagen">Imagen</label>
            <input type="text" name="imagen" id="imagen" value="{{ old('imagen', $proyecto?->imagen) }}" />
            @error('imagen')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="col-12">
            <label for="dificultad">Dificultad</label>
            <select name="dificultad" id="dificultad">
                <option value="">Selecciona una dificultad</option>
                @foreach (['baja', 'media', 'alta'] as $dificultad)
                    <option value="{{ $dificultad }}" @selected(old('dificultad', $proyecto?->dificultad) === $dificultad)>
                        {{ ucfirst($dificultad) }}
                    </option>
                @endforeach
            </select>
            @error('dificultad')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="col-12">
            <ul class="actions">
                <li><button type="submit" class="button">{{ $boton }}</button></li>
                <li><a href="{{ route('proyectos.index') }}" class="button alt">Cancelar</a></li>
            </ul>
        </div>
    </div>
</form>
