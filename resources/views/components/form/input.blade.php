@props([
    'label' => null,
    'name',
    'id' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'step' => null,
    'min' => null,
])

@php($fieldId = $id ?? $name)
<div class="form-group">
    @if($label)
        <label for="{{ $fieldId }}">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        id="{{ $fieldId }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        @if($step) step="{{ $step }}" @endif
        @if(!is_null($min)) min="{{ $min }}" @endif
    >
    @error($name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
