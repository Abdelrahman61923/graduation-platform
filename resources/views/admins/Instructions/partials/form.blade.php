@section('styles')
    <style></style>
@endsection

<input value="{{ $instruction->id }}" type="hidden" class="form-control" name="id" value="{{ old('id') }}">
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="">{{ __('Instruction') }}<span class="redstar">*</span></label>
            <textarea id="instruction" class="form-control shadow-none"
                name="instruction" value="{{ old('instruction') }}" autocomplete="instruction"
                placeholder="{{ __('Instruction') }}" autofocus>{{ old('instruction', $instruction->instruction) }}</textarea>

        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="">{{ __('Type') }}<span class="redstar">*</span></label>
            <select class="form-select shadow-none " name="type" id="type">
                <option selected>{{ __('Select Type') }}</option>
                @foreach ($types as $type)
                    <option value="{{ $type['id'] }}"
                        {{ old('type', $instruction->type) == $type['id'] ? 'selected' : '' }}>
                        {{ $type['name'] }}
                    </option>
                @endforeach
            </select>

        </div>
    </div>
</div>

@section('scripts')
    <script></script>
@endsection
