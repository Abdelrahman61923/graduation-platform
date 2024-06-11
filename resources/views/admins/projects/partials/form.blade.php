@section('styles')
    <style></style>
@endsection

<input value="{{ $project->id }}" type="hidden" class="form-control" name="id" value="{{ old('id') }}">
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="title">{{ __('Name') }}<span class="redstar">*</span></label>
            <input value="{{ old('name', $project->name) }}" class="form-control shadow-none @error('name') is-invalid @enderror"
                type="text" name="name" placeholder="{{ __('Please Enter Name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="">{{ __('Description') }}<span class="redstar">*</span></label>
            <textarea id="description_edit" class="form-control shadow-none @error('description') is-invalid @enderror"
                name="description" value="{{ old('description') }}" autocomplete="project_description"
                placeholder="Description" autofocus></textarea>
            @error('description')
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
