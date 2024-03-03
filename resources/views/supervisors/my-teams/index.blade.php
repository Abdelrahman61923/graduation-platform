@extends('layouts.master')
@section('title')
    @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
        My Teams
    @else
        Teams
    @endif
@endsection
@section('styles')
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                            <h3>My Teams</h3>
                        @else
                            <h3>Teams</h3>
                        @endif
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
                            @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                                <li class="breadcrumb-item active"> My Teams</li>
                            @else
                                <li class="breadcrumb-item active"> Teams</li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display dataTable" id="TeamsTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Team Number</th>
                                    <th>Leader</th>
                                    <th>Project Title</th>
                                    <th>Project Description</th>
                                    @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                                        <th>Supervisor</th>
                                    @endif
                                    <th>Status</th>
                                    <th style="width: 100px !important">Action</th>
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
            let dataTableUrl = "{{ route('supervisors.teams') }}";
            let columns = [{
                    data: 'id',
                    visiable: false
                },
                {
                    data: 'team_number'
                },
                {
                    data: 'leader'
                },
                {
                    data: 'project_title'
                },
                {
                    data: 'project_description'
                },
                @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                {
                    data: 'supervisor'
                },
                @endif
                {
                    data: 'status',
                },
                {
                    data: '',
                    orderable: false,
                    searchable: false
                },
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
                    @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                        targets: 6,
                    @else
                        targets: 7,
                    @endif
                    title: "Actions",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        let url = "{{ route('teams.delete', ':id') }}";
                        Deleteurl = url.replace(':id', full.id);
                        let deleteBtn = '';
                        let url2 = "";
                        @if (auth()->user()->role == \App\Models\User::ROLE_SUPERVISOR)
                            url2 = "{{ route('supervisors.teams.show', ':id') }}";
                        @else
                            url2 = "{{ route('admins.teams.show', ':id') }}";
                            deleteBtn = '</a>&nbsp;' +
                                '<a table="TeamTable" row="' + meta.row + '" data-url="' + Deleteurl +
                                '" class="btn btn-danger btn-sm delete-confirm">' +
                                "Delete" +
                                '</a>';
                        @endif

                        Showurl = url2.replace(':id', full.id);
                        return '<a href="' + Showurl +
                            '" class="btn btn-primary btn-sm">' +
                            "Show </a>" + deleteBtn +
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

            initDatatable(dataTableUrl, columns, columnDefs, 'TeamsTable', Buttons, order = [
                [0, "DESC"]
            ], responsive);
        });
    </script>
@endsection
