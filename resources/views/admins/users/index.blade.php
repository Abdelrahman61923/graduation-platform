@extends('layouts.master')
@section('title')
    Users
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Users</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}" data-bs-original-title="" title="">                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                    <li class="breadcrumb-item active"> Users</li>
                  </ol>
                </div>
              </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ $active }}</h3>
                            <span>Active Departments</span>
                        </div>
                        <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                                <i data-feather="octagon" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ $Inactive }}</h3>
                            <span>Inactive Departments</span>
                        </div>
                        <div class="avatar bg-light-danger p-50">
                            <span class="avatar-content">
                                <i data-feather="alert-octagon" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" style="padding: 30px !important;">
                    <div class="d-flex justify-content-start">
                        <h4 class="card-title mb-0">All Users</h4>
                    </div>
                    <div class="d-flex justify-content-end" style="margin-top: -30px;">
                        <a href="{{route('users.create')}}" class="btn btn-primary">
                            Add
                        </a>
                    </div>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove" data-bs-original-title="" title=""><i class="fe fe-x"></i></a></div>
                  </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="display dataTable" id="UserTable">
                    <thead>
                      <tr>
                        <th style="width: 0px!important;"></th>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Username</th>
                        <th>Student Id</th>
                        <th>Department</th>
                        <th>phone</th>
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
    {{-- Page js files --}}

    <script>
        $(document).ready(function() {
            let dataTableUrl = "{{ route('users.get') }}";
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
                    data: 'full_name',
                },
                {
                    data: 'email',
                },
                {
                    data: 'role',
                },
                {
                    data: 'username',
                },
                {
                    data: 'student_id',
                },
                {
                    data: 'department',
                },
                {
                    data: 'phone',
                },
                {
                    data: '',
                    orderable: false,
                    searchable: false
                },
            ];
            let Buttons = [
                {
                    text: "Add User",
                    className: 'btn btn-relief-primary',
                    attr: {
                        'onclick': "Redirect('{{ route('users.create') }}')",
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-slide-in'
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ];
            let columnDefs = [
                {
                    "className": 'control',
                    orderable: false,
                    responsivePriority: 3,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return '';
                    }
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
                    targets: 2,
                    render: function(data, type, full, meta) {
                        var url = "{{ route('users.edit', ':id') }}";
                        url = url.replace(':id', full.id);
                        return ' <a href="'+url+'">'+data +'</a>';
                    },
                },
                {
                    // Actions
                    targets: 9,
                    title: "Actions",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var pk = full['id'];

                        var url2 = "{{ route('users.delete', ':id') }}";
                        url2 = url2.replace(':id', pk);
                        return (
                            '<div class="btn-group">' +
                                '<a class="btn btn-danger delete-confirm" table="UserTable" row="' + meta.row + '" data-url="' + url2 +'" >' +
                                    
                                    "Delete" + 
                                '</a>' +
                            '</div>'
                        );
                    }
                },
            ];

            let responsive = {
                details: {
                   
                    type: 'column',
                    renderer: function(api, rowIdx, columns) {
                        var data = $.map(columns, function(col, i) {
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

            initDatatable(dataTableUrl, columns, columnDefs, 'UserTable', Buttons, order = [
                [0, "DESC"]
            ], responsive);
        });
    </script>

@endsection
