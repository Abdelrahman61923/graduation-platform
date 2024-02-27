@section('styles')
<style>

</style>
@endsection
<div class="row">
    <div class="col-md-6">
        <label for="title">First Name<span class="redstar">*</span></label>
        <input value="{{ old('first_name', $user->first_name) }}" class="form-control" type="text" name="first_name" placeholder="Please Enter First Name">
        @if ($errors->has('first_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6">
        <label for="title">Last Name<span class="redstar">*</span></label>
        <input value="{{ old('last_name', $user->last_name) }}" class="form-control" type="text" name="last_name" placeholder="Please Enter Last Name">
        @if ($errors->has('last_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6">
        <label for="title">Email<span class="redstar">*</span></label>
        <input value="{{ old('email', $user->email) }}" class="form-control" type="email" name="email" placeholder="Please Enter Email">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6">
        <label for="title">Phone<span class="redstar">*</span></label>
        <input value="{{ old('phone', $user->phone) }}" class="form-control" type="text" name="phone" placeholder="Please Enter Phone">
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
    <div class="@if (!$user->id || ($user && $user->role == \App\Models\User::ROLE_ADMIN)) col-md-12 @else col-md-6 @endif" >
        <label for="title">Address</label>
        <input value="{{ old('address', $user->address) }}" class="form-control" type="text" name="address" placeholder="Please Enter Address">
        @if ($errors->has('address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
    @if (!$user->id)
        <div class="col-md-6">
            <label for="title">Role<span class="redstar">*</span></label>
            <select class="js-example-placeholder-single form-select form-control @error('role') is-invalid @enderror" name="role" id="role">
                <option selected disabled></option>
                @foreach ($roles as $role)
                    <option value="{{ $role['id'] }}" {{ old('role', $user->role) == $role['id'] ? 'selected' : '' }}>
                        {{ $role['name'] }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('role'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
            @endif
        </div>
    @endif
    @if (!$user || $user && $user->role != \App\Models\User::ROLE_ADMIN)
        <div class="col-md-6" id="department_div">
            <label for="title">Department<span class="redstar">*</span></label>
            <select class="js-example-placeholder-single form-select form-control @error('department_id') is-invalid @enderror" name="department_id" id="department">
                <option selected disabled></option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('department_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('department_id') }}</strong>
                </span>
            @endif
        </div>
    @endif
</div>

@section('scripts')
    <script>
    $('#department').on("change", function(e) {
        let val = $(this).val();
        let type = '{{\App\Models\User::ROLE_ADMIN}}';
        if (val == type) {
            $('#department_div').addClass('d-none');
        } else {
            $('#department_div').removeClass('d-none');
        }
    });
    </script>
@endsection