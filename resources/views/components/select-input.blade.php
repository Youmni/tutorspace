<div class="mb-4">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $name }}</label>
    <select id="{{ $id }}" name="{{ $name }}" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        <option value="" disabled selected>Kies een optie</option>
        @foreach($options as $key => $value)
            <option value="{{ $key }}" {{ old($name, $oldValue) == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>
