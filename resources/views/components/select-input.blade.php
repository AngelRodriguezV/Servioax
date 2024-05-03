@props(['options', 'selected' => null])

<select class="block p-2 ps-20 text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" {{ $attributes }}>
    @foreach ($options as $key => $option)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>
