@props([
    'label' => null,
    'name',
    'id' => null,
    'accept' => null,
    'helper' => null,
    'wrapperId' => null,
])

@php($fieldId = $id ?? $name)
<div class="form-group">
    @if($label)
        <label for="{{ $fieldId }}">{{ $label }}</label>
    @endif
    <label for="{{ $fieldId }}" class="image-upload" @if($wrapperId) id="{{ $wrapperId }}" @endif>
        <input type="file" id="{{ $fieldId }}" name="{{ $name }}" @if($accept) accept="{{ $accept }}" @endif>
        <div class="upload-placeholder">
            {{ $helper ?? 'Click to upload' }}
        </div>
    </label>
    @error($name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
