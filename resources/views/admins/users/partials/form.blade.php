@section('styles')
    <style>

    </style>
@endsection
<div class="row">
    <div class="col-md-6">
        <label for="title">{{ __('First Name') }}<span class="redstar">*</span></label>
        <input value="{{ old('first_name', $user->first_name) }}"
            class="form-control shadow-none @error('first_name') is-invalid @enderror" type="text" name="first_name"
            placeholder="{{ __('Please Enter First Name') }}">
        @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="title">{{ __('Last Name') }}<span class="redstar">*</span></label>
        <input value="{{ old('last_name', $user->last_name) }}"
            class="form-control shadow-none @error('last_name') is-invalid @enderror" type="text" name="last_name"
            placeholder="{{ __('Please Enter Last Name') }}">
        @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="title">{{ __('Email') }}<span class="redstar">*</span></label>
        <input value="{{ old('email', $user->email) }}" class="form-control shadow-none @error('email') is-invalid @enderror"
            type="email" name="email" placeholder="{{ __('Please Enter Email') }}">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="title">{{ __('Phone') }}<span class="redstar">*</span></label>
        <input value="{{ old('phone', $user->phone) }}" class="form-control shadow-none @error('phone') is-invalid @enderror"
            type="text" name="phone" placeholder="{{ __('Please Enter Phone') }}">
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="@if (!$user->id || ($user && $user->role == \App\Models\User::ROLE_ADMIN)) col-md-12 @else col-md-6 @endif">
        <label for="title">{{ __('Address') }}</label>
        <input value="{{ old('address', $user->address) }}" class="form-control shadow-none @error('address') is-invalid @enderror"
            type="text" name="address" placeholder="{{ __('Please Enter Address') }}">
        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @if (!$user->id || $user->role == \App\Models\User::ROLE_ADMIN || $user->role == \App\Models\User::ROLE_SUPERVISOR)
        <div class="col-md-6">
            <label for="title">{{ __('Role') }}<span class="redstar">*</span></label>
            <select class="js-example-placeholder-single form-select form-control shadow-none @error('role') is-invalid @enderror"
                name="role" id="role">
                <option selected disabled>{{ __('Select Role') }}</option>
                @foreach ($roles as $role)
                    <option value="{{ $role['id'] }}"
                        {{ old('role', $user->role) == $role['id'] ? 'selected' : '' }}>
                        {{ $role['name'] }}
                    </option>
                @endforeach
            </select>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endif
    @if (!$user || ($user && $user->role != \App\Models\User::ROLE_ADMIN))
        <div class="col-md-6" id="department_div">
            <label for="title">{{ __('Department') }}<span class="redstar">*</span></label>
            <select
                class="js-example-placeholder-single form-select form-control shadow-none @error('department_id') is-invalid @enderror"
                name="department_id" id="department">
                <option selected disabled>{{ __('Select Department') }}</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endif
</div>

@section('scripts')
    <script>

    </script>
@endsection
