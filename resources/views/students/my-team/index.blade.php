@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@section('title')
    My Team
@endsection
@section('styles')
    <style>
        .d-none {
            display: none;
        }

        .select2-container {
            z-index: 100000;
        }

        .invalid-feedback-custom {
            width: 100%;
            margin-top: 0.25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .border-style {
            border-top: 3px solid #8091a3 !important;
            border-bottom: 2px solid #8091a3;
            border-right: 2px solid #8091a3;
            border-left: 2px solid #697685;
        }
    </style>
@endsection
@section('content')
    <div class="page-body">
        <!-- Modal -->
        <div class="modal fade" id="AddTeamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="storeTeam">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Team</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Project Title</label>
                                        <input id="project_title" type="text"
                                            class="form-control @error('project_title') is-invalid @enderror"
                                            name="project_title" value="{{ old('project_title') }}" required
                                            autocomplete="project_title" placeholder="Project Title" autofocus>
                                        <span class="invalid-feedback-custom d-none" role="alert" id="projectname">
                                            <strong>The project title field is required</strong>
                                        </span>
                                        @error('project_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Project Description</label>
                                        <textarea id="project_description" class="form-control @error('project_description') is-invalid @enderror"
                                            name="project_description" value="{{ old('project_description') }}" required autocomplete="project_description"
                                            placeholder="Project Description" autofocus></textarea>
                                        <span class="invalid-feedback-custom d-none" role="alert" id="description">
                                            <strong>The project description field is required</strong>
                                        </span>
                                        @error('project_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Students</label>
                                        <select class="js-example-basic-multiple-limit-custom form-control col-sm-12"
                                            name="member_ids[]" id="member_ids" multiple>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->student_id . ' - ' . $user->full_name . ' - ' . $user->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback-custom d-none" role="alert" id="memberIds">
                                            <strong>The students field is required</strong>
                                        </span>
                                        @error('member_ids')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Tags</label>
                                        <select class="js-example-placeholder-multiple form-control col-sm-12"
                                            name="tag_ids[]" id="tag_ids" multiple>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback-custom d-none" role="alert" id="tagIds">
                                            <strong>The tag field is required</strong>
                                        </span>
                                        @error('tag_ids')
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
                            <button class="btn btn-primary submit-form" type="button">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="EditTeamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="editTeam">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Team</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Project Title</label>
                                        <input id="project_name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name"
                                            placeholder="Project Name" autofocus>
                                        <span class="invalid-feedback-custom d-none" role="alert" id="project_name">
                                            <strong>The project title field is required</strong>
                                        </span>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Project Description</label>
                                            <textarea id="project_description_edit" class="form-control @error('project_description') is-invalid @enderror"
                                                name="project_description" value="{{ old('project_description') }}" required autocomplete="project_description"
                                                placeholder="Project Description" autofocus></textarea>
                                            <span class="invalid-feedback-custom d-none" role="alert"
                                                id="description_error">
                                                <strong>The project description field is required</strong>
                                            </span>
                                            @error('project_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary submit-edit-form" type="button">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="SendToSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="SendToSupervisor">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Send To Supervisor</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Supervisors</label>
                                        <select class="js-example-placeholder-single form-control col-sm-12"
                                            name="supervisor_id" id="supervisor_id">
                                            <option selected disabled></option>
                                            @foreach ($supervisors as $supervisor)
                                                <option value="{{ $supervisor->id }}">
                                                    {{ $supervisor->full_name . ' - ' . $supervisor->email }}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback-custom d-none" role="alert"
                                            id="supervisor_id_error">
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
        <div class="modal fade" id="AddAnotherMembers" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="memberForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Another Members</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Students</label>
                                        <select class="js-example-basic-multiple-limit-members form-control col-sm-12"
                                            name="member_ids[]" id="members_ids" multiple>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->student_id . ' - ' . $user->full_name . ' - ' . $user->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback-custom d-none" role="alert" id="memberIdsError">
                                            <strong>The students field is required</strong>
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
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary submit-member-form" type="button">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if ($authUser->team?->supervisor)
            <div class="modal fade" id="SupervisorData" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Supervisor Data</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">First Name :
                                            <span>{{ $authUser->team->supervisor->first_name }}</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Last Name :
                                            <span>{{ $authUser->team->supervisor->last_name }}</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Email :
                                            <span>{{ $authUser->team->supervisor->email }}</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Phone :
                                            <span>{{ $authUser->team->supervisor->phone ?? 'Not Available' }}</span></label>
                                    </div>
                                </div>
                                @if ($authUser->team->status != \App\Models\Team::STATUS_APPROVED && $authUser->team->leader_id == $authUser->id)
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Supervisor not approved your team yet, You can remove to
                                                assign another supervisor</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            @if ($authUser->team->status != \App\Models\Team::STATUS_APPROVED && $authUser->team->leader_id == $authUser->id)
                                <a href="javascript:void(0)"
                                    data-url="{{ route('teams.supervisor.delete', $authUser->team->id) }}"
                                    data-title="Are you sure you want to delete supervisor ({{ $authUser->team->supervisor->full_name }}) ?"
                                    data-message="You can not undo this step!" name="delete"
                                    id="{{ $authUser->team->id }}" class="delete-confirm btn btn-danger">Delete
                                    Supervisor</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>My Team</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('students.dashboard') }}"> <i
                                        data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item active"> My Team</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header" style="padding: 10px !important;">
                                <h5 class="card-title mb-0">Leader Information</h5>
                            </div>
                            <div class="card-body" style="padding: 20px !important;">
                                <div class="row mb-2">
                                    @if ($authUser->team)
                                        <div class="profile-title">
                                            <div class="media">
                                                <img style="border-radius: 4px;width: 33px !important;"
                                                    src="{{ $authUser->team->leader->photo ? url('assets/upload/student_images/' . $authUser->team->leader->photo) : 'https://eu.ui-avatars.com/api/?name=' . $authUser->team->leader->full_name }}"
                                                    alt="">
                                                <div class="media-body">
                                                    <h5 class="mb-1">{{ $authUser->team->leader->full_name }}</h5>
                                                    <p>{{ $authUser->team->leader->student_id }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="profile-title">
                                            <div class="media" style="text-align: center;">
                                                No leader Yet!
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <form class="card">
                            <div class="card-header" style="padding: 10px !important;">
                                <div class="d-flex justify-content-start">
                                    <h4 class="card-title mb-0">Team
                                        ({{ $authUser?->team?->team_number ?? 'Information' }})
                                    </h4>
                                </div>
                                @if ($settings && !$authUser->team)
                                    <div class="d-flex justify-content-end" style="margin-top: -30px;">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#AddTeamModal">
                                            Add New Team
                                        </button>
                                    </div>
                                @elseif($settings && $authUser->team && $authUser->team->leader_id == $authUser->id)
                                    <div class="d-flex justify-content-end" style="margin-top: -30px;">
                                        @if (!$authUser->team->supervisor)
                                            <a href="javascript:void(0)"
                                                data-url="{{ route('teams.delete', $authUser->team->id) }}"
                                                data-title="Are you sure you want to delete team number ({{ $authUser->team->id }}) ?"
                                                data-message="You can not undo this step!" name="delete"
                                                id="{{ $authUser->team->id }}"
                                                class="delete-confirm btn btn-danger">Delete</a>
                                        @endif
                                        <button type="button" class="btn btn-primary" id="show-edit-form">
                                            Edit Team
                                        </button>
                                    </div>
                                @endif
                                <div class="card-options"><a class="card-options-collapse" href="#"
                                        data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i
                                            class="fe fe-chevron-up"></i></a><a class="card-options-remove"
                                        href="#" data-bs-toggle="card-remove" data-bs-original-title=""
                                        title=""><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="card-body" style="padding: 20px !important;">
                                @if ($authUser->team)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Name: <span
                                                        id="edited_project_title">{{ $authUser->team->project_title }}</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status:
                                                    <span>{{ $authUser->team->status }}</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"><span>{{ $authUser->team->project_description }}</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Supervisor:
                                                    @if ($authUser->team->supervisor)
                                                        <span>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#SupervisorData">{{ $authUser->team->supervisor->full_name }}</a>
                                                        </span>
                                                    @else
                                                        <span>Not assigned yet!</span>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if (
                                        $authUser->team->leader_id == $authUser->id &&
                                            $authUser->team->is_all_members_accepted &&
                                            !$authUser->team?->supervisor)
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#SendToSupervisor">
                                                Send To Supervisor
                                            </button>
                                        </div>
                                    @endif
                                @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div style="text-align: center;">
                                                    No Team Yet!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="padding: 10px !important;">
                                <div class="d-flex justify-content-start">
                                    <h4 class="card-title mb-0">Members</h4>
                                </div>
                                @if (
                                    $authUser->team &&
                                        !$authUser->team->supervisor &&
                                        $settings &&
                                        $authUser->team->members()->count() < $settings->max_team_member)
                                    <div class="d-flex justify-content-end" style="margin-top: -30px;">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#AddAnotherMembers">
                                            Add Another Member
                                        </button>
                                    </div>
                                @endif
                                <div class="card-options"><a class="card-options-collapse" href="#"
                                        data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i
                                            class="fe fe-chevron-up"></i></a><a class="card-options-remove"
                                        href="#" data-bs-toggle="card-remove" data-bs-original-title=""
                                        title=""><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="table-responsive add-project">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Student Id</th>
                                            <th>UserName</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th colspan="2" style="text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    @if ($authUser->team)
                                        <tbody>
                                            @foreach ($authUser->team->members as $member)
                                                <tr>
                                                    <td><a class="text-inherit" href="#" data-bs-original-title=""
                                                            title=""> {{ $member->user->full_name }} </a></td>
                                                    <td>{{ $member->user->student_id }}</td>
                                                    <td><span class="status-icon bg-success"></span>
                                                        {{ $member->user->username }}</td>
                                                    <td>{{ $member->user->email }}</td>
                                                    <td>{{ $member->status }}</td>

                                                    @if ($authUser->team->leader_id != $member->member_id)
                                                        @if ($authUser->team->leader_id == $authUser->id)
                                                            @if (!$authUser->team->supervisor)
                                                                <td class="text-end" colspan="2">
                                                                    <a href="javascript:void(0)"
                                                                        data-url="{{ route('members.delete', $member->id) }}"
                                                                        data-title="Are you sure you want to delete member ({{ $member->user->full_name }}) ?"
                                                                        data-message="You can not undo this step!"
                                                                        name="delete" id="{{ $member->id }}"
                                                                        class="delete-confirm btn btn-danger">Delete</a>
                                                                </td>
                                                            @else
                                                                <td colspan="2">
                                                                    <p style="text-align: center;font-weight: bold;">Member
                                                                    </p>
                                                                </td>
                                                            @endif
                                                        @elseif($member->status != \App\Models\Member::STATUS_ACCEPTED && $authUser->id == $member->member_id)
                                                            <td>
                                                                <a class="btn btn-success btn-sm accept-team"
                                                                    data-url="{{ route('members.accept', $member->id) }}"
                                                                    href="javascript:void(0)"> Accept</a>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-danger btn-sm refus-team"
                                                                    data-url="{{ route('members.delete', $member->id) }}"
                                                                    href="javascript:void(0)"><i class="fa fa-trash"></i>
                                                                    Refus</a>
                                                            </td>
                                                        @elseif($member->status == \App\Models\Member::STATUS_ACCEPTED && $authUser->id == $member->member_id)
                                                            <td colspan="2">
                                                                <p style="text-align: center;font-weight: bold;">Member</p>
                                                            </td>
                                                        @elseif($authUser->id != $member->member_id)
                                                            <td colspan="2">
                                                                <p style="text-align: center;font-weight: bold;">Member</p>
                                                            </td>
                                                        @endif
                                                    @else
                                                        <td colspan="2">
                                                            <p style="text-align: center;font-weight: bold;">Leader</p>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr>
                                                <td colspan="5" style="text-align: center;">
                                                    No Members Yet!
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script>
        let max_team_member = '{{ $settings?->max_team_member ?? 0 }}';
        $(function() {
            $("addNewTeamBtn").click(function() {
                $("#exampleModalCenter").modal("show");
            });
        });

        $(".js-example-basic-multiple-limit-custom").select2({
            placeholder: "Select Students",
            maximumSelectionLength: (max_team_member - 1),

        });

        let memberCount = '{{ $authUser?->team?->members()?->count() ?? 0 }}';
        $(".js-example-basic-multiple-limit-members").select2({
            placeholder: "Select Students",
            maximumSelectionLength: (max_team_member - memberCount),
        });

        $(".submit-form").click(function(e) {
            e.preventDefault();
            let project_title = $('#project_title').val();
            let project_description = $('#project_description').val();
            let member_ids = $('#member_ids').val();
            let tag_ids = $('#tag_ids').val();
            if (project_title == '') {
                $('#projectname').removeClass('d-none');
            } else {
                $('#projectname').addClass('d-none');
            }
            if (project_description == '') {
                $('#description').removeClass('d-none');
            } else {
                $('#description').addClass('d-none');
            }
            if (tag_ids.length == 0) {
                $('#tagIds').removeClass('d-none');
            } else {
                $('#tagIds').addClass('d-none');
            }
            if (member_ids.length == 0) {
                $('#memberIds').removeClass('d-none');
            } else {
                $('#memberIds').addClass('d-none');
            }
            if (project_title != '' && project_description != '' && tag_ids.length > 0 && member_ids.length > 0) {
                let url = '{{ route('teams.store') }}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        project_title: project_title,
                        project_description: project_description,
                        member_ids: member_ids,
                        tag_ids: tag_ids
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        alert('error happened')
                    }
                });
            }
        });

        $("#show-edit-form").click(function(e) {
            let name = '{{ $authUser?->team?->project_title ?? '' }}';
            let project_description = '{{ $authUser?->team?->project_description ?? '' }}';
            $('#project_name').val(name);
            $('#project_description_edit').val(project_description);
            $('#EditTeamModal').modal('show');
        });

        $(".submit-edit-form").click(function(e) {
            e.preventDefault();
            let name = $('#project_name').val();
            let project_description = $('#project_description_edit').val();
            if (name == '') {
                $('#project_name').removeClass('d-none');
            } else {
                $('#project_name').addClass('d-none');
            }
            if (project_description == '') {
                $('#description_error').removeClass('d-none');
            } else {
                $('#description_error').addClass('d-none');
            }
            if (name != '' && project_description != '') {
                let id = '{{ $authUser->team?->id }}';
                var route = '{{ route('teams.update', ['id' => 'team_id']) }}';
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
                        project_title: name,
                        project_description: project_description
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        alert('error happened')
                    }
                });
            }
        });

        $(".submit-supervisor-form").click(function(e) {
            e.preventDefault();
            let supervisor_id = $('#supervisor_id').val();

            if (supervisor_id != '') {
                $('#supervisor_id_error').addClass('d-none');
                let id = '{{ $authUser->team?->id }}';
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

        $(".submit-member-form").click(function(e) {
            e.preventDefault();
            let member_ids = $('#members_ids').val();

            if (member_ids.length > 0) {
                $('#memberIdsError').addClass('d-none');
                let id = '{{ $authUser->team?->id }}';
                var route = '{{ route('members.store', ['id' => 'team_id']) }}';
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
                        member_ids: member_ids
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        alert('error happened')
                    }
                });
            } else {
                $('#memberIdsError').removeClass('d-none');
            }
        });

        $(document).on('click', '.accept-team', function(e) {
            var url = $(this).attr('data-url');
            var title = 'Are you sure do you want to accept to join this team?';
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

            // prevent defult action from being executed.
            e.preventDefault();
        });

        $(document).on('click', '.refus-team', function(e) {
            var url = $(this).attr('data-url');
            var title = 'Are you sure do you want to refus to join this team?';
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

            // prevent defult action from being executed.
            e.preventDefault();
        });
    </script>
@endsection
