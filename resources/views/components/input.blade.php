<div class="form-group">
    @if($label)
        <label for="{{ $field }}">
            {{ ucwords($label) }}
            @if($isRequired) <span class="text-danger">*</span> @endif
        </label>
    @endif
    @if($type === 'textarea')

        <textarea
            class="form-control"
            id="{{ $field }}"
            name="{{ $field }}"
            rows="3"
            placeholder="{{ $placeholder }}"
            spellcheck="false"
            @if($isRequired) required="required" @endif
            style="resize: none;"
        >{{ $value }}</textarea>

    @else
        <input type="{{ $type }}" class="form-control @error($field) is-invalid @enderror"
               name="{{ $field }}"
               @if($placeholder) placeholder="{{ $placeholder }}" @endif
               @if($value) value="{{ $value }}" @else value="{{ old($field) }}" @endif
               autocomplete="off"
               @if($isRequired) required="required" @endif
               @if($isReadOnly) readonly @endif
        >
    @endif

    @error($field)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
