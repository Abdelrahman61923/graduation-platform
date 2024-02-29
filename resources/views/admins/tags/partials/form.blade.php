@section('styles')
    <style></style>
@endsection

<input value="{{ $tag->id }}" type="hidden" class="form-control" name="id" value="{{ old('id') }}">
<div class="row">
    <div class="col-md-6">
        <label for="title">Name<span class="redstar">*</span></label>
        <input value="{{ old('name', $tag->name) }}" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
            placeholder="Please Enter Name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="customSwitch3">Status</label>
        <div class="form-check form-check-primary form-switch">
            <input type="checkbox" class="form-check-input" id="customSwitch3" name="status"
                {{ old('status', $tag->status) == \App\Models\Tag::STATUS_ACTIVE ? 'checked' : '' }} />
        </div>
        @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

@section('scripts')
    <script></script>
@endsection
