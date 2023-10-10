@props([
    'forLabel',
    'labelInput',
    'typeInput',
    'nameInput',
    'idInput',
    'valueInput'
])

<label for="{{ $forLabel }}">{{ $labelInput }}</label>
<input type="{{ $typeInput }}" name="{{ $nameInput }}" id="{{ $idInput }}" value="{{ $valueInput }}">