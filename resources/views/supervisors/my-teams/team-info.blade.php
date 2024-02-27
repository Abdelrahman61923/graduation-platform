@extends('layouts.master')
@section('styles')

@endsection
@section('title')
    Team Info
@endsection
@section('content')
  <div class="page-body">
    @if ($team->supervisor)
      <div class="modal fade" id="SupervisorData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Supervisor Data</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="">First Name : <span>{{$team->supervisor->first_name}}</span></label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="">Last Name : <span>{{$team->supervisor->last_name}}</span></label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="">Email : <span>{{$team->supervisor->email}}</span></label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="">Phone : <span>{{$team->supervisor->phone??'Not Available'}}</span></label>
                    </div>
                  </div>
                  @if($team->status != \App\Models\Team::STATUS_APPROVED)
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label for="">Supervisor not approved your team yet, You can remove to assign another supervisor</label>
                      </div>
                    </div>
                  @endif
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
              @if($team->status != \App\Models\Team::STATUS_APPROVED)
                <a href="javascript:void(0)"  data-url="{{route('teams.supervisor.delete', $team->id)}}"  data-title="Are you sure you want to delete supervisor ({{$team->supervisor->full_name}}) ?" data-message="You can not undo this step!" name="delete" id="{{$team->id}}" class="delete-confirm btn btn-danger">Delete Supervisor</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endif
    <div class="modal fade" id="SendToSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form id="SendToSupervisor">
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Send To Supervisor</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="mb-3">
                              <label for="">Supervisors</label>
                              <select class="js-example-placeholder-single form-control col-sm-12" name="supervisor_id" id="supervisor_id">
                                <option selected disabled></option>
                                @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->full_name .' - '. $supervisor->email }}</option>
                                @endforeach
                              </select>
                              <span class="invalid-feedback-custom d-none" role="alert" id="supervisor_id_error">
                                <strong>The supervisors field is required</strong>
                            </span>
                              @error('supervisor_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary submit-supervisor-form" type="button">Save changes</button>
              </div>
          </div>
        </form>
      </div>
    </div>
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Team Information</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                  <a href="{{ route('supervisors.dashboard') }}" data-bs-original-title="" title="">                                       
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                  </a>
                @else
                  <a href="{{ route('admins.dashboard') }}" data-bs-original-title="" title="">                                       
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                  </a>
                @endif
              </li>
              <li class="breadcrumb-item active"> Team Information</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body" style="padding: 20px !important;">
          <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                <label class="form-label">Name: <span id="edited_project_title">{{$team->project_title}}</span></label>
                </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
              <label class="form-label">Status: <span>{{$team->status}}</span></label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
              <label class="form-label"><span>{{$team->project_description}}</span></label>
              </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Supervisor: 
                    @if ($team->supervisor)
                      <span>
                        @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                          <a href="javascript:void(0)">{{$team->supervisor->full_name}}</a>
                        @else
                          <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#SupervisorData">{{$team->supervisor->full_name}}</a>
                        @endif
                      </span>
                    @else
                      <span>Not assigned yet!</span>
                    @endif
                  </label>
                </div>
            </div>
            @if(auth()->user()->role == \App\Models\User::ROLE_ADMIN && $team->is_all_members_accepted && !$team->supervisor)
              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SendToSupervisor">
                  Send To Supervisor
                </button>
              </div>
            @endif
          </div>
          @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
            @if($team->status != \App\Models\Team::STATUS_APPROVED)
              <div class="d-flex justify-content-end">
                <a class="btn btn-success btn-sm approve-team" data-url="{{route('supervisors.approve', $team->id)}}" href="javascript:void(0)"> Approve</a>
                &nbsp;
                <a class="btn btn-danger btn-sm reject-team" data-url="{{route('supervisors.reject', $team->id)}}" href="javascript:void(0)"> Reject</a>
              </div>
            @else
              <div class="d-flex justify-content-end">
                <a class="btn btn-danger btn-sm reject-team" data-url="{{route('supervisors.reject', $team->id)}}" href="javascript:void(0)"> Remove Me</a>
              </div>
            @endif
          @endif
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="display dataTable" id="MembersTable">
              <thead>
                <tr>
                  <th></th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Student Number</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      let id = '{{$team->id}}';
      let url = "{{ route('supervisors.team-members', ':id') }}";
      let dataTableUrl = url.replace(':id', id);
      let columns = [
        {
          data: 'id',
          visiable: false
        },
        {
          data: 'photo',
          orderable: false,
          searchable: false
        },
        {
          data: 'full_name'
        },
        {
          data: 'username'
        },
        {
          data: 'student_id'
        },
        {
          data: 'email'
        },
        {
          data: '',
          orderable: false,
          searchable: false
        },
      ];
      let Buttons = [
          
      ];
      let columnDefs = [
        {
          "className": 'control',
          orderable: false,
          responsivePriority: 4,
          targets: 0,
          render: function(data, type, full, meta) {
            return '';
          }
        },
        {
            responsivePriority: 1,
            targets: 2,

        },
        {
            responsivePriority: 2,
            targets: 1,

        },
        {
          "targets": 1,
          "render": function(data, type, full, meta) {
              if (data) {
                  return `<img src="${data}" class="img-responsive" widht="36" height="36">`;
              } else {
                return `<img src="https://eu.ui-avatars.com/api/?name=${full.full_name }" class="img-responsive" widht="36" height="36">`;
              }
          }
        },
        {
          targets: 6,
          title: "Actions",
          orderable: false,
          render: function(data, type, full, meta) {
            let url = "{{ route('members.delete', ':id') }}";
            Deleteurl = url.replace(':id', full.id);
            return'<a table="MemberTable" row="' + meta.row + '" data-url="' + Deleteurl +
                '" class="btn btn-danger btn-sm delete-confirm">' + 
                "Delete" +
              '</a>'+
            '';
          }
        }
      ];

      let responsive = {
        details: {
          type: 'column',
          renderer: function(api, rowIdx, columns) {
              let data = $.map(columns, function(col, i) {
                  return col.columnIndex !== 100 ?
                      '<tr data-dt-row="' +
                      col.rowIdx +
                      '" data-dt-column="' +
                      col.columnIndex +
                      '">' +
                      '<td>' +
                      col.title +
                      ':' +
                      '</td> ' +
                      '<td>' +
                      col.data +
                      '</td>' +
                      '</tr>' :
                      '';
              }).join('');
              return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') :
                  false;
            }
        }
      }

      initDatatable(dataTableUrl, columns, columnDefs, 'MembersTable', Buttons, order = [
          [0, "DESC"]
      ], responsive);
    });

    $(document).on('click', '.approve-team', function (e) {
      var url = $(this).attr('data-url');
      var title = 'Are you sure do you want to accept this team?';
      var message = 'You cannot undo this action!';
      var type = 'warning';

      Swal.fire({
          title: title,
          text: message,
          type: type,
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          closeOnConfirm: false
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: "POST",
                  url: url,
                  success: function (data) {
                  location.reload();
                  },
                  error: function (data) {
                      alert('error happened')
                  }
              });
          }
      });
      e.preventDefault();
    });

    $(document).on('click', '.reject-team', function (e) {
      var url = $(this).attr('data-url');
      var title = 'Are you sure do you want to reject this team?';
      var message = 'You cannot undo this action!';
      var type = 'warning';

      Swal.fire({
          title: title,
          text: message,
          type: type,
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          closeOnConfirm: false
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: "POST",
                  url: url,
                  success: function (data) {
                    window.location.href = "{{ route('supervisors.my-teams')}}";
                  },
                  error: function (data) {
                      alert('error happened')
                  }
              });
          }
      });
      e.preventDefault();
    });

    $(".submit-supervisor-form").click(function(e){
      e.preventDefault();
      let supervisor_id = $('#supervisor_id').val();
      if (supervisor_id != null) {
        $('#supervisor_id_error').addClass('d-none');
        let id = '{{$team?->id}}';
        var route = '{{route('teams.supervisor.store', ['id' => 'team_id'])}}';
        let url = route.replace("team_id", id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url,
            data: {
              supervisor_id: supervisor_id
            },
            success: function (data) {
              location.reload();
            },
            error: function (data) {
                alert('error happened')
            }
        });
      } else {
        $('#supervisor_id_error').removeClass('d-none');
      }
    });
  </script>
@endsection
