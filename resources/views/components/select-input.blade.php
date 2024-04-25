@props(['options', 'selected' => null])

<select class="border-bone-200 focus:border-bone-400 focus:ring-bone-400 rounded-md shadow-sm" {{ $attributes }}>
    @foreach ($options as $key => $option)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>