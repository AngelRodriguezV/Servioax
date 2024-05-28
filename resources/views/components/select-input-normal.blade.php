@props(['options', 'selected' => null])

<select class="p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" {{ $attributes }}>
    @foreach ($options as $key => $option)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : ($options->keys()->first() == $key ? 'selected' : '') }}>
            {{ $option }}
        </option>
    @endforeach
</select>
