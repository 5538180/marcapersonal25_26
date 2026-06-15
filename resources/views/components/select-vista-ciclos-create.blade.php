<p>
    <label for="familia_profesional_id">Familia profesional</label><br>
    <select name="familia_profesional_id" id="familia_profesional_id">
        <option value="">Selecciona una familia</option>
        @foreach ($familias as $familia)
            <option value="{{ $familia->id }}" @selected(old('familia_profesional_id') == $familia->id)>
                {{ $familia->nombre }}
            </option>
        @endforeach
    </select>
</p>
