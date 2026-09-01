@props([
    'label' => null,
    'name',
    'id' => null,
    'options' => [],
    'optionValue' => 'value',
    'optionLabel' => 'label',
    'placeholder' => null,
    'selected' => null,
    'required' => false,
    'onchange' => null,
])

@php($fieldId = $id ?? $name)
<div class="form-group">
    @if($label)
        <label for="{{ $fieldId }}">{{ $label }}</label>
    @endif
    <select id="{{ $fieldId }}" name="{{ $name }}" @if($required) required @endif @if($onchange) onchange="{{ $onchange }}" @endif>
        @if($placeholder)
            <option value="" disabled selected>{{ $placeholder }}</option>
        @endif
        @foreach($options as $option)
            @php($value = is_array($option) ? ($option[$optionValue] ?? null) : ($option->$optionValue ?? null))
            @php($labelText = is_array($option) ? ($option[$optionLabel] ?? null) : ($option->$optionLabel ?? null))
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>{{ $labelText }}</option>
        @endforeach
    </select>
    @error($name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
