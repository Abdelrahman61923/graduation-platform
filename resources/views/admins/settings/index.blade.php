@extends('layouts.master')
@section('title')
    Settings
@endsection
@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h3>Settings</h3>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}" data-bs-original-title="" title="">                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section>
    <div class="row">
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-body">
            <form  method="post" enctype="multipart/form-data" action="{{route('admins.settings.store')}}" id="jquery-val-form" class="needs-validation">
                {{csrf_field()}}
                <input value="{{ old('id', $setting->id) }}" class="form-control" type="hidden" name="id">
                <div class="row">
                  <div class="col-md-12">
                      <label for="title">Min Team Member<span class="redstar">*</span></label>
                      <input value="{{ old('min_team_member', $setting->min_team_member) }}" class="form-control" type="number" name="min_team_member" placeholder="Please Enter Value">
                      @if ($errors->has('min_team_member'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
                  <div class="col-md-12">
                    <label for="title">Max Team Member<span class="redstar">*</span></label>
                    <input value="{{ old('max_team_member', $setting->max_team_member) }}" class="form-control" type="number" name="max_team_member" placeholder="Please Enter Value">
                    @if ($errors->has('max_team_member'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('max_team_member') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-12">
                  <label for="title">Max Group Teacher<span class="redstar">*</span></label>
                  <input value="{{ old('max_group_teacher', $setting->max_group_teacher) }}" class="form-control" type="number" name="max_group_teacher" placeholder="Please Enter Value">
                  @if ($errors->has('max_group_teacher'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('max_group_teacher') }}</strong>
                      </span>
                  @endif
              </div>
              </div>
                <br>
                <div class="col-12  mt-2 pt-50">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
</div>
@endsection
