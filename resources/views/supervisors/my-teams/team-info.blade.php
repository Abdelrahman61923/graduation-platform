@extends('layouts.master')
@section('styles')
@endsection
@section('title')
    {{ __('Team Information') }}
@endsection

@section('content')
    <div class="page-body">
        @if ($team->supervisor)
            <div class="modal fade" id="SupervisorData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Supervisor Data') }}</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">{{ __('First Name :') }}
                                            <span>{{ $team->supervisor->first_name }}</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">{{ __('Last Name :') }}
                                            <span>{{ $team->supervisor->last_name }}</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">{{ __('Email :') }}
                                            <span>{{ $team->supervisor->email }}</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">{{ __('Phone :') }}
                                            <span>{{ $team->supervisor->phone ?? 'Not Available' }}</span></label>
                                    </div>
                                </div>
                                @if ($team->status != \App\Models\Team::STATUS_APPROVED)
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label
                                                for="">{{ __('Supervisor not approved your team yet, You can remove to assign another supervisor') }}</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button"
                                data-bs-dismiss="modal">ْ{{ __('Close') }}</button>
                            {{-- @if ($team->status != \App\Models\Team::STATUS_APPROVED || auth()->user()->role == \App\Models\User::ROLE_ADMIN) --}}
                            <a href="javascript:void(0)" data-url="{{ route('teams.supervisor.delete', $team->id) }}"
                                data-title="Are you sure you want to delete supervisor ({{ $team->supervisor->full_name }}) ?"
                                data-message="You can not undo this step!" name="delete" id="{{ $team->id }}"
                                class="delete-confirm btn btn-danger">{{ __('Delete Supervisor') }}</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="modal fade" id="SendToSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="SendToSupervisor">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Send To Supervisor') }}</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">{{ __('Supervisors') }}</label>
                                        <select class="js-example-placeholder-single form-control col-sm-12"
                                            name="supervisor_id" id="supervisor_id">
                                            <option selected disabled>{{ __('Select Supervisor') }}</option>
                                            @foreach ($supervisors as $supervisor)
                                                <option value="{{ $supervisor->id }}">
                                                    {{ $supervisor->full_name . ' - ' . $supervisor->email }}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback-custom d-none" role="alert"
                                            id="supervisor_id_error">
                                            <strong>{{ __('The supervisors field is required') }}</strong>
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
                            <button class="btn btn-secondary" type="button"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button class="btn btn-primary submit-supervisor-form"
                                type="button">{{ __('Save changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="AddAnotherMembers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{ route('store.member', $team->id) }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Add Another Member') }}</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">{{ __('Students') }}</label>
                                        <select class="js-example-placeholder-multiple form-control col-sm-12"
                                            name="member_ids[]" id="members_ids" multiple>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->student_id . ' - ' . $user->full_name . ' - ' . $user->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback-custom d-none" role="alert" id="memberIdsError">
                                            <strong>{{ __('The students field is required') }}</strong>
                                        </span>
                                        @error('member_ids')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button class="btn btn-primary submit-member-form"
                                type="submit">{{ __('Save changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{ __('Team Information') }}</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                                    <a href="{{ route('supervisors.dashboard') }}">
                                        <i data-feather="home"></i>
                                    </a>
                                @else
                                    <a href="{{ route('admins.dashboard') }}">
                                        <i data-feather="home"></i>
                                    </a>
                                @endif
                            </li>
                            <li class="breadcrumb-item active">{{ __('Team Information') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header" style="padding: 10px !important;">
                                <h5 class="card-title mb-0">{{ __('Leader Information') }}</h5>
                            </div>
                            <div class="card-body" style="padding: 20px !important;">
                                <div class="row mb-2">
                                    <div class="profile-title">
                                        <div class="media">
                                            <img style="border-radius: 4px; width: 33px !important;"
                                                src="{{ $team->leader->photo ? url('assets/upload/student_images/' . $team->leader->photo) : 'https://eu.ui-avatars.com/api/?name=' . $team->leader->full_name }}"
                                                alt="">
                                            <div class="media-body">
                                                <h5 class="mb-1">{{ $team->leader->full_name }}</h5>
                                                <p>{{ $team->leader->student_id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-header" style="padding: 10px !important;">
                                <div class="d-flex justify-content-start">
                                    <h4 class="card-title mb-0">{{ __('Team') }}
                                        ({{ $team->team_number ?? 'Information' }})
                                    </h4>
                                </div>
                                {{-- <div class="d-flex justify-content-end" style="margin-top: -30px;">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#EditTeamModal" id="show-edit-form">
                                        {{ __('Edit Team') }}
                                    </button>
                                </div> --}}
                            </div>
                            <div class="card-body" style="padding: 20px !important;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Name:') }} <span
                                                    id="edited_project_title">{{ $team->project_title }}</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Status:') }}
                                                <span>{{ $team->status }}</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label
                                                class="form-label"><span>{{ $team->project_description }}</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Supervisor:') }}
                                                @if ($team->supervisor)
                                                    <span>
                                                        @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                                                            <a
                                                                href="javascript:void(0)">{{"Dr/" . $team->supervisor->full_name }}</a>
                                                        @else
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#SupervisorData">{{ "Dr/" . $team->supervisor->full_name }}</a>
                                                        @endif
                                                    </span>
                                                @else
                                                    <span>{{ __('Not assigned yet!') }}</span>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="display: flex; flex-direction: column;">
                                        @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN && !$team->supervisor)
                                            <div class="d-flex justify-content-end" style="margin-bottom: 10px">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#SendToSupervisor">
                                                    {{ __('Send To Supervisor') }}
                                                </button>
                                            </div>
                                        @endif
                                        @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN &&
                                                $settings &&
                                                $team->members()->count() < $settings->max_team_member)
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-primary m-b-5"
                                                    data-bs-toggle="modal" data-bs-target="#AddAnotherMembers">
                                                    {{ __('Add Another Member') }}
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                                    @if ($team->status != \App\Models\Team::STATUS_APPROVED)
                                        <div class="d-flex justify-content-end">
                                            <a class="btn btn-success btn-sm approve-team"
                                                data-url="{{ route('supervisors.approve', $team->id) }}"
                                                href="javascript:void(0)">
                                                {{ __('Approve') }}</a>
                                            &nbsp;
                                            <a class="btn btn-danger btn-sm reject-team"
                                                data-url="{{ route('supervisors.reject', $team->id) }}"
                                                href="javascript:void(0)">
                                                {{ __('Reject') }}</a>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-end">
                                            <a class="btn btn-danger btn-sm reject-team"
                                                data-url="{{ route('supervisors.reject', $team->id) }}"
                                                href="javascript:void(0)">
                                                {{ __('Remove Me') }}</a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display dataTable" id="MembersTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ __('Photo') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('University ID') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Department') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                                            <th>{{ __('Actions') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header" style="padding: 10px !important;">
                            <h5 class="card-title mb-0">{{ __('Documentation') }}</h5>
                        </div>
                        <div class="card-body" style="padding: 20px !important;">
                            <div class="row mb-2">
                                @if ($team->book)
                                    <div class="profile-title">
                                        <div class="media">
                                            <div class="media-body">
                                                <a href="{{ !empty($team) ? url('assets/upload/docs/' . $team->book) : 'null' }}"
                                                    class="btn btn-primary"
                                                    download>{{ __('Download Documentation') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="profile-title">
                                        <div class="media" style="text-align: center;">
                                            {{ __('No Documentation Uploaded Yet!') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header" style="padding: 10px !important;">
                            <h5 class="card-title mb-0">{{ __('Presentation') }}</h5>
                        </div>
                        <div class="card-body" style="padding: 20px !important;">
                            <div class="row mb-2">
                                @if ($team->presentation)
                                    <div class="profile-title">
                                        <div class="media">
                                            <div class="media-body">
                                                <a href="{{ !empty($team) ? url('assets/upload/docs/' . $team->presentation) : 'null' }}"
                                                    class="btn btn-primary" download>{{ __('Download Presentation') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="profile-title">
                                        <div class="media" style="text-align: center;">
                                            {{ __('No Presentation Uploaded Yet!') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let id = '{{ $team->id }}';
            let url = "{{ route('supervisors.team-members', ':id') }}";
            let dataTableUrl = url.replace(':id', id);
            let columns = [{
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
                    data: 'student_id'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'department'
                },
                {
                    data: 'email'
                },
                @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                    {
                        data: '',
                        orderable: false,
                        searchable: false
                    },
                @endif
            ];
            let Buttons = [

            ];
            let columnDefs = [{
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
                @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                    {
                        targets: 7,
                        title: "{{ __('Actions') }}",
                        orderable: false,
                        render: function(data, type, full, meta) {
                            let url = "{{ route('delete.member', 'id') }}";
                            url = url.replace('id', full.id);

                            return (
                                '<a class="btn btn-danger btn-sm delete-confirm" table="DepartmentTable" row="' +
                                meta.row + '" data-url="' + url + '" >' +
                                "{{ __('Delete') }}" +
                                '</a>'
                            );
                        }
                    }
                @endif
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

        $(document).on('click', '.approve-team', function(e) {
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
                        success: function(data) {
                            location.reload();
                        },
                        error: function(data) {
                            alert('error happened')
                        }
                    });
                }
            });
            e.preventDefault();
        });

        $(document).on('click', '.reject-team', function(e) {
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
                        success: function(data) {
                            window.location.href = "{{ route('supervisors.my-teams') }}";
                        },
                        error: function(data) {
                            alert('error happened')
                        }
                    });
                }
            });
            e.preventDefault();
        });

        $(".submit-supervisor-form").click(function(e) {
            e.preventDefault();
            let supervisor_id = $('#supervisor_id').val();
            if (supervisor_id != null) {
                $('#supervisor_id_error').addClass('d-none');
                let id = '{{ $team?->id }}';
                var route = '{{ route('teams.supervisor.store', ['id' => 'team_id']) }}';
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
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        alert('error happened')
                    }
                });
            } else {
                $('#supervisor_id_error').removeClass('d-none');
            }
        });
    </script>
@endsection
