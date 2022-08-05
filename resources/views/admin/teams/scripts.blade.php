
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        @if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
        // Get list page data
        var getListDataUrl = "{{route($routePrefix.'.'.$listRequestUrl)}}";
        var dTable = $('#list-table').on('init.dt', function () {
            $('#dataTableLoading').hide();
        }).DataTable({

            destroy: true,
            autoWidth: false,
            responsive: true,
            dom: 'Blfrtip',
            buttons: [
             'excel'
        ],
         select: true,
           
            processing: true,
            language: {
                processing: '<img src="{{asset("images/admin/".config("global.TABLE_LIST_LOADER"))}}">',
                search: "_INPUT_",
                searchPlaceholder: '{{ trans("custom_admin.btn_search") }}',
                emptyTable: '{{ trans("custom_admin.message_no_records_found") }}',
                zeroRecords: '{{ trans("custom_admin.message_no_records_found") }}',
                paginate: {
                    first: '{{trans("custom_admin.label_first")}}',
                    previous: '{{trans("custom_admin.label_previous")}}',
                    next: '{{trans("custom_admin.label_next")}}',
                    last: '{{trans("custom_admin.label_last")}}',
                }
            },
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: getListDataUrl,
                type: 'POST',
                data: function (data) {
                },
            },
            columns: [
                    @if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
                {
                    data: "{{$id}}",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return '<div class="custom-control custom-checkbox"><input type="checkbox" class="delete_checkbox" id="customCheck2_' + row.id + '" value="' + row.id + '"><label class="" for="customCheck2_' + row.id + '"></label></div>';
                        }
                        return data;
                    },
                },
                    @endif
                {
                    data: 'id', name: 'id'
                },
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},

                {
                    data: 'title', name: 'title'
                },
                 {
                    data: 'player1_name', name: 'player1_name'
                },
                 {
                    data: 'player1_email', name: 'player1_email'
                },
                 {
                    data: 'player2_name', name: 'player2_name'
                },
                 {
                    data: 'player2_email', name: 'player2_email'
                },
                {data: 'status', name: 'status'},
                   @if ($isAllow || in_array($editUrl, $allowedRoutes))
                {
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
                @endif

            ],
            columnDefs: [
                {
                    @if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
                    targets: [1],
                    @else
                    targets: [0],
                    @endif
                    visible: false,
                    searchable: false,
                },
            ],
            order: [
                    @if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
                [1, 'desc']
                    @else
                    [0, 'desc']
                @endif
            ],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '{{trans("custom_admin.label_all")}}']],
            fnDrawCallback: function (settings) {
                if (settings._iDisplayLength == -1 || settings._iDisplayLength > settings.fnRecordsDisplay()) {
                    $('#list-table_paginate').hide();
                } else {
                    $('#list-table_paginate').show();
                }
            },
        });


        // Prevent alert box from datatable & console error message
        $.fn.dataTable.ext.errMode = 'none';
        $('#list-table').on('error.dt', function (e, settings, techNote, message) {
            $('#dataTableLoading').hide();
            toastr.error(message, "@lang('custom_admin.message_error')");
        });

        // Status section
        $(document).on('click', '.team_status', function () {
            var id = $(this).data('id');
            var actionType = $(this).data('action-type');
            listActions('{{ $pageRoute }}', 'team-status', id, actionType, dTable);
        });

        // Delete section
        $(document).on('click', '.delete', function () {
            var id = $(this).data('id');
            var actionType = $(this).data('action-type');
            listActions('{{ $pageRoute }}', 'delete', id, actionType, dTable);
        });

        // Bulk Action
        $('.bulkAction').on('click', function () {
            var selectedIds = [];
            $("input:checkbox[class=delete_checkbox]:checked").each(function () {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                var actionType = $(this).data('action-type');
                bulkActions('{{ $pageRoute }}', 'bulk-actions', selectedIds, actionType, dTable);
            } else {
                toastr.error("@lang('custom_admin.error_no_checkbox_checked')", "@lang('custom_admin.message_error')!");
            }
        });
        @endif

    });
</script>
