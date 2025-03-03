@props([
    'label', 'type'
])

<label for="">{{ $label }}</label>
<input type="{{$type}}" {{$attributes}}>