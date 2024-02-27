@extends('layouts.master')
@section('title')
    Edit Department
@endsection
@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h3>Edit Department</h3>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}" data-bs-original-title="" title="">                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
            <li class="breadcrumb-item active">Edit Department</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="bs-validation">
    <div class="row">
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-body">
            <form  method="post" enctype="multipart/form-data" action="{{route('departments.update',$department->id)}}" id="jquery-val-form" class="needs-validation">
              {{csrf_field()}}
              {{ method_field('PUT') }}
              @include('admins.departments.partials.form', ['department'=>$department])
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

@section('scripts')


@endsection
