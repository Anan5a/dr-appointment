<div class="form-group">
    @isset($label) <label>{{ $label }}</label> @endisset
    <select name="{{ $name }}" class="select2"
            @isset($multiple) multiple="multiple" @endisset
            data-placeholder="select option"
            style="width: 100%;"
            @isset($form_id)
                onchange="$('#{{ $form_id }}').submit()"
        @endisset
    >
        {{ $options }}
    </select>
</div>
