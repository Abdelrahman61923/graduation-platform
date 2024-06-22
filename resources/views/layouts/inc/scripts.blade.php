<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- feather icon js-->
<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- scrollbar js-->
<script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets/js/config.js') }}"></script>
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script> --}}
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

<script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
<script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('assets/js/script.js') }}"></script>
{{-- <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script> --}}
<!-- login js-->
<!-- Plugin used-->


@include('sweetalert::alert')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('scripts')

<script>
    function password_show_hide(field_id, show_eye_id, hide_eye_id) {
        var x = document.getElementById(field_id);
        var show_eye = document.getElementById(show_eye_id);
        var hide_eye = document.getElementById(hide_eye_id);
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).on('click', '.delete-confirm', function (e) {
        var url = $(this).attr('data-url');
        var title = $(this).attr('data-title') || 'Are you sure do you want to delete this resource?';
        var message = $(this).attr('data-message') || 'You cannot undo this action!';
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

        // prevent defult action from being executed.
        e.preventDefault();
    });
    function initDatatable(ajaxUri, columns,columnDefs = [], tableId = 'Table',buttons = [], order = [[ 0, "DESC" ]], responsive= [], export_columns=[ 2, 3, 4, 5]) {
        defualtButtons = [ {
                extend: 'collection',
                className: 'btn btn-outline-secondary dropdown-toggle me-2',
                text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                buttons: [
                    {
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                    className: 'dropdown-item',
                    exportOptions: { columns: export_columns }
                    },
                    {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: export_columns }
                    },
                    {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: export_columns }
                    },
                    {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: export_columns }
                    },
                    {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns:  export_columns }
                    }
                ],
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function () {
                    $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
                    }, 50);
                }
            }
        ];
        if(buttons.length){
            defualtButtons = defualtButtons.concat(buttons);
        }
        let table = $('#' + tableId).DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            searching: true,
            stateSave: true,
            "rowCallback": function () {
                $('#datatableTotalPages').html(table.page.info().pages)
            },
            'ajax': ajaxUri,
            'columns': columns,
            'columnDefs': columnDefs,
            rowReorder: true,
            'order': order,
            dom: `<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"
                        <"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start"f>
                        <"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"l>B>>
                    >t
                    <"d-flex justify-content-between mx-2 row mb-1"
                        <"col-sm-12 col-md-6"i>
                        <"col-sm-12 col-md-6"p>
                    >`,
            lengthMenu: [
                [10, 25, 50, 100, 200, 500, 5000, 10000, 100000],
                [10, 25, 50, 100, 200, 500, 5000, 10000, 100000],
            ],
            buttons:defualtButtons,
            responsive:responsive

        });
    }
    function Changestatue(route,table)
    {
        var token = $("meta[name='csrf-token']").attr("content");
        var Table = $("#"+table).DataTable();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': token
            },
            type: "POST",
            url: route,
            dataType: "JSON",
            success: function (data){
                Swal.fire({
                    title: 'Updated Successfully' ,
                    html: '<p>'+ data.success +'</p>',
                    icon: 'success',
                    type: "success",
                });
                Table.ajax.reload();
            },
        });
    }

    jQuery(document).ready(function ($)
    {
        $(document).on('change','.changestatus',function(){
            let value = $(this).val();
            console.log(value);
            let route = $(this).attr('route');
            var TableName = $(this).attr('table');

            Changestatue(route,TableName);
        });
    });

    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
    @endif
</script>
