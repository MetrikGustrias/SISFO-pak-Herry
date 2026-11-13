{{-- Param: name, label, type (default text), value, required (default true), step/min/max (opsional) --}}
@php($type = $type ?? 'text')
<div class="form-group">
    <label for="{{ $name }}">{{ $label }} @if ($required ?? true)<span class="text-danger">*</span>@endif</label>
    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" rows="3"
            class="form-control @error($name) is-invalid @enderror">{{ old($name, $value ?? '') }}</textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value ?? '') }}"
            @isset($step) step="{{ $step }}" @endisset
            @isset($min) min="{{ $min }}" @endisset
            @isset($max) max="{{ $max }}" @endisset
            class="form-control @error($name) is-invalid @enderror">
    @endif
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
