@extends('layouts.master')
@section('title')
    {{ __('Departments') }}
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{ __('Departments') }}</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"> <i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('Departments') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container-fluid">
            <div class="row second-chart-list third-news-update">
                <div class="col-sm-6 col-xl-4 col-lg-6">
                    <div class="card o-hidden static-top-widget-card">
                        <div class="card-body">
                            <div class="media static-top-widget">
                                <div class="media-body">
                                    <h6 class="font-roboto">{{ __('Active Departments') }}</h6>
                                    <h4 class="mb-0 counter">{{ $active }}</h4>
                                </div>
                                <svg class="fill-success" width="45" height="39" viewBox="0 0 45 39" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.92047 8.49509C5.81037 8.42629 5.81748 8.25971 5.93378 8.20177C7.49907 7.41686 9.01464 6.65821 10.5302 5.89775C14.4012 3.95495 18.2696 2.00762 22.1478 0.0792996C22.3387 -0.0157583 22.6468 -0.029338 22.8359 0.060288C28.2402 2.64315 33.6357 5.24502 39.033 7.84327C39.0339 7.84327 39.0339 7.84417 39.0348 7.84417C39.152 7.90121 39.1582 8.06869 39.0472 8.1375C38.9939 8.17009 38.9433 8.20087 38.8918 8.22984C33.5398 11.2228 28.187 14.2121 22.8385 17.2115C22.5793 17.3572 22.3839 17.3762 22.1131 17.2296C16.7851 14.3507 11.4518 11.4826 6.12023 8.61188C6.05453 8.57748 5.98972 8.53855 5.92047 8.49509Z">
                                    </path>
                                    <path
                                        d="M21.1347 23.3676V38.8321C21.1347 38.958 21.0042 39.0386 20.895 38.9806C20.4182 38.7271 19.9734 38.4918 19.5295 38.2528C14.498 35.5441 9.46833 32.8317 4.43154 30.1339C4.12612 29.97 4.02046 29.7944 4.02224 29.4422C4.03822 26.8322 4.03023 24.2222 4.02934 21.6122C4.02934 21.4719 4.02934 21.3325 4.02934 21.1659C4.02934 21.0428 4.15542 20.9622 4.26373 21.0147C4.35252 21.0581 4.43065 21.0962 4.50434 21.1396C8.18539 23.2888 11.8664 25.438 15.5457 27.5909C16.5081 28.154 17.0622 28.0453 17.7627 27.1464C18.7748 25.8472 19.7896 24.5508 20.8045 23.2535C20.8053 23.2526 20.8062 23.2517 20.8071 23.2499C20.9172 23.1132 21.1347 23.192 21.1347 23.3676Z">
                                    </path>
                                    <path
                                        d="M23.83 23.3784C23.83 23.2019 24.0484 23.1241 24.1567 23.2626C25.2168 24.6178 26.2192 25.9016 27.2233 27.1835C27.8928 28.039 28.4504 28.1494 29.3719 27.6117C33.0521 25.4643 36.7323 23.316 40.4133 21.1686C40.4914 21.1233 40.5713 21.0799 40.6592 21.0337C40.7613 20.9803 40.8856 21.0473 40.8972 21.164C40.9025 21.2184 40.9069 21.2691 40.9069 21.3189C40.9087 23.928 40.9052 26.5371 40.9132 29.1462C40.914 29.4006 40.8421 29.5518 40.6131 29.6794C35.1057 32.7539 29.6037 35.8365 24.099 38.9163C24.0892 38.9218 24.0803 38.9263 24.0706 38.9317C23.9605 38.9879 23.8309 38.9082 23.8309 38.7833L23.83 23.3784Z">
                                    </path>
                                    <path
                                        d="M28.4752 24.454C27.2908 22.9385 26.118 21.4384 24.9203 19.9066C24.6983 19.6232 24.7809 19.2031 25.0925 19.0293L41.3092 9.95809C41.5746 9.80962 41.9076 9.89743 42.0692 10.1582C43.0147 11.6791 43.9541 13.1891 44.9103 14.7264C45.0852 15.0079 44.9946 15.3818 44.7114 15.5475C39.5414 18.5649 34.3875 21.5742 29.2086 24.5979C28.9627 24.74 28.651 24.6794 28.4752 24.454Z">
                                    </path>
                                    <path
                                        d="M20.0132 19.931C18.819 21.4592 17.6506 22.9539 16.4804 24.4512C16.3037 24.6767 15.9921 24.7373 15.747 24.5943C10.586 21.5814 5.45504 18.5857 0.288619 15.5701C6.65486e-05 15.4017 -0.087831 15.0188 0.0968427 14.7372C1.02554 13.3204 1.94269 11.9208 2.86872 10.5085C3.03209 10.2596 3.35349 10.1763 3.61363 10.3157C9.018 13.2254 14.3975 16.1215 19.833 19.0483C20.1508 19.2194 20.2378 19.644 20.0132 19.931Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="progress-widget">
                                <div class="progress sm-progress-bar progress-animate">
                                    <div class="progress-gradient-success" role="progressbar" style="width: 60%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span
                                            class="animate-circle"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4 col-lg-6">
                    <div class="card o-hidden static-top-widget-card">
                        <div class="card-body">
                            <div class="media static-top-widget">
                                <div class="media-body">
                                    <h6 class="font-roboto">{{ __('Inactive Departments') }}</h6>
                                    <h4 class="mb-0 counter">{{ $Inactive }}</h4>
                                </div>
                                <svg class="fill-success" width="45" height="39" viewBox="0 0 45 39" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.92047 8.49509C5.81037 8.42629 5.81748 8.25971 5.93378 8.20177C7.49907 7.41686 9.01464 6.65821 10.5302 5.89775C14.4012 3.95495 18.2696 2.00762 22.1478 0.0792996C22.3387 -0.0157583 22.6468 -0.029338 22.8359 0.060288C28.2402 2.64315 33.6357 5.24502 39.033 7.84327C39.0339 7.84327 39.0339 7.84417 39.0348 7.84417C39.152 7.90121 39.1582 8.06869 39.0472 8.1375C38.9939 8.17009 38.9433 8.20087 38.8918 8.22984C33.5398 11.2228 28.187 14.2121 22.8385 17.2115C22.5793 17.3572 22.3839 17.3762 22.1131 17.2296C16.7851 14.3507 11.4518 11.4826 6.12023 8.61188C6.05453 8.57748 5.98972 8.53855 5.92047 8.49509Z">
                                    </path>
                                    <path
                                        d="M21.1347 23.3676V38.8321C21.1347 38.958 21.0042 39.0386 20.895 38.9806C20.4182 38.7271 19.9734 38.4918 19.5295 38.2528C14.498 35.5441 9.46833 32.8317 4.43154 30.1339C4.12612 29.97 4.02046 29.7944 4.02224 29.4422C4.03822 26.8322 4.03023 24.2222 4.02934 21.6122C4.02934 21.4719 4.02934 21.3325 4.02934 21.1659C4.02934 21.0428 4.15542 20.9622 4.26373 21.0147C4.35252 21.0581 4.43065 21.0962 4.50434 21.1396C8.18539 23.2888 11.8664 25.438 15.5457 27.5909C16.5081 28.154 17.0622 28.0453 17.7627 27.1464C18.7748 25.8472 19.7896 24.5508 20.8045 23.2535C20.8053 23.2526 20.8062 23.2517 20.8071 23.2499C20.9172 23.1132 21.1347 23.192 21.1347 23.3676Z">
                                    </path>
                                    <path
                                        d="M23.83 23.3784C23.83 23.2019 24.0484 23.1241 24.1567 23.2626C25.2168 24.6178 26.2192 25.9016 27.2233 27.1835C27.8928 28.039 28.4504 28.1494 29.3719 27.6117C33.0521 25.4643 36.7323 23.316 40.4133 21.1686C40.4914 21.1233 40.5713 21.0799 40.6592 21.0337C40.7613 20.9803 40.8856 21.0473 40.8972 21.164C40.9025 21.2184 40.9069 21.2691 40.9069 21.3189C40.9087 23.928 40.9052 26.5371 40.9132 29.1462C40.914 29.4006 40.8421 29.5518 40.6131 29.6794C35.1057 32.7539 29.6037 35.8365 24.099 38.9163C24.0892 38.9218 24.0803 38.9263 24.0706 38.9317C23.9605 38.9879 23.8309 38.9082 23.8309 38.7833L23.83 23.3784Z">
                                    </path>
                                    <path
                                        d="M28.4752 24.454C27.2908 22.9385 26.118 21.4384 24.9203 19.9066C24.6983 19.6232 24.7809 19.2031 25.0925 19.0293L41.3092 9.95809C41.5746 9.80962 41.9076 9.89743 42.0692 10.1582C43.0147 11.6791 43.9541 13.1891 44.9103 14.7264C45.0852 15.0079 44.9946 15.3818 44.7114 15.5475C39.5414 18.5649 34.3875 21.5742 29.2086 24.5979C28.9627 24.74 28.651 24.6794 28.4752 24.454Z">
                                    </path>
                                    <path
                                        d="M20.0132 19.931C18.819 21.4592 17.6506 22.9539 16.4804 24.4512C16.3037 24.6767 15.9921 24.7373 15.747 24.5943C10.586 21.5814 5.45504 18.5857 0.288619 15.5701C6.65486e-05 15.4017 -0.087831 15.0188 0.0968427 14.7372C1.02554 13.3204 1.94269 11.9208 2.86872 10.5085C3.03209 10.2596 3.35349 10.1763 3.61363 10.3157C9.018 13.2254 14.3975 16.1215 19.833 19.0483C20.1508 19.2194 20.2378 19.644 20.0132 19.931Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="progress-widget">
                                <div class="progress sm-progress-bar progress-animate">
                                    <div class="progress-gradient-success" role="progressbar" style="width: 60%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span
                                            class="animate-circle"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" style="padding: 30px !important;">
                    <div class="d-flex justify-content-start">
                        <h4 class="card-title mb-0">{{ __('All Departments') }}</h4>
                    </div>
                    <div class="d-flex justify-content-end" style="margin-top: -30px;">
                        <a href="{{ route('departments.create') }}" class="btn btn-primary">
                            {{ __('Add') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display dataTable" id="DepartmentTable">
                            <thead>
                                <tr>
                                    <th style="width: 0px!important;"></th>
                                    <th>ْ{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th style="width: 100px !important">{{ __('Actions') }}</th>
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
            let dataTableUrl = "{{ route('departments.get') }}";
            let columns = [{
                    data: 'id',
                    visiable: false
                },
                {
                    data: 'name',
                },
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
                    targets: 0,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return '';
                    }
                },
                {
                    targets: 1,
                    render: function(data, type, full, meta) {
                        var url = "{{ route('departments.edit', 'id') }}";
                        url = url.replace('id', full.id);
                        return ' <a href="' + url + '">' + data + '</a>';
                    },
                },
                {
                    targets: 2,
                    render: function(data, type, full, meta) {
                        var status = full['status'];
                        var btnclass, btntitle;
                        var route = "{{ route('departments.change-status', ':id') }}";
                        route = route.replace(':id', full.id);
                        var checked = " ";
                        if (status == 'active') {
                            btnclass = "btn btn-outline-primary round";
                            btntitle = "Active";
                            checked = "checked";
                        } else {
                            btnclass = "btn btn-outline-danger round";
                            btntitle = "Deactive";
                        }
                        var disabled = "";

                        return `
                            <div class="form-check form-check-primary form-switch">
                                <input type="checkbox" ` + checked +
                            ` ` + disabled +
                            `  class="form-check-input changestatus" id="customSwitch3" table="Table" route="` +
                            route + `" >
                            </div>`;
                    }
                },
                {
                    // Actions
                    targets: 3,
                    title: "{{ __('Actions') }}",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var pk = full['id'];

                        var url2 = "{{ route('departments.delete', 'id') }}";
                        url2 = url2.replace('id', pk);
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-danger delete-confirm" table="DepartmentTable" row="' +
                            meta.row + '" data-url="' + url2 + '" >' +

                            "{{ __('Delete') }}" +
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

            initDatatable(dataTableUrl, columns, columnDefs, 'DepartmentTable',Buttons, order = [
                [0, "DESC"]
            ], responsive);
        });
    </script>
@endsection
