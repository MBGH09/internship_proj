@props([
    'label' => null,
    'name',
    'id' => null,
    'placeholder' => null,
    'required' => false,
    'value' => null,
])

@php($fieldId = $id ?? $name)
<div class="form-group">
    @if($label)
        <label for="{{ $fieldId }}">{{ $label }}</label>
    @endif
    <textarea
        id="{{ $fieldId }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
