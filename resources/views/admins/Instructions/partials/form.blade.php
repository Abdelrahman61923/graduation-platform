@section('styles')
    <style></style>
@endsection

<input value="{{ $instruction->id }}" type="hidden" class="form-control" name="id" value="{{ old('id') }}">
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="">{{ __('Instruction') }}<span class="redstar">*</span></label>
            <textarea id="instruction" class="form-control shadow-none @error('instruction') is-invalid @enderror"
                name="instruction" value="{{ old('instruction') }}" autocomplete="instruction"
                placeholder="{{ __('Instruction') }}" autofocus>{{ old('instruction', $instruction->instruction) }}</textarea>
            @error('instruction')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="">{{ __('Type') }}<span class="redstar">*</span></label>
            <select class="form-select shadow-none @error('type') is-invalid @enderror" name="type" id="type">
                <option selected>{{ __('Select Type') }}</option>
                @foreach ($types as $type)
                    <option value="{{ $type['id'] }}"
                        {{ old('type', $instruction->type) == $type['id'] ? 'selected' : '' }}>
                        {{ $type['name'] }}
                    </option>
                @endforeach
            </select>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

@section('scripts')
    <script></script>
@endsection
