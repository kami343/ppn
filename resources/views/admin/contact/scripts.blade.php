<script type="text/javascript">
$(document).ready(function() {
	@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
	// Get list page data
	var getListDataUrl = "{{route($routePrefix.'.'.$listRequestUrl)}}";
	var dTable = $('#list-table').on('init.dt', function () {$('#dataTableLoading').hide();}).DataTable({
			destroy: true,
			autoWidth: false,
	        responsive: true,
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
				data: function(data) {},
	        },
	        columns: [		
			@if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
			{
				data: 'id',
				orderable: false,
				searchable: false,
				render: function ( data, type, row ) {
					if ( type === 'display' ) {
						return '<div class="custom-control custom-checkbox"><input type="checkbox" class="delete_checkbox" id="customCheck2_'+row.id+'" value="'+row.id+'"><label class="" for="customCheck2_'+row.id+'"></label></div>';
					}
					return data;
				},
			},
			@endif
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'name', name: 'name'},
				{data: 'email', name: 'email'},
				{data: 'subject', name: 'subject'},
				{data: 'created_at', name: 'created_at', orderable: false, searchable: false},
			@if ($isAllow || in_array($viewUrl, $allowedRoutes))
				{data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
	        ],
			columnDefs: [
				{
			@if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
				targets: [ 1 ],
			@else
				targets: [ 0 ],
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
			fnDrawCallback: function(settings) {
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
	
	// Delete section
	$(document).on('click', '.delete', function() {
		var id = $(this).data('id');
		var actionType 	= $(this).data('action-type');
		listActions('{{ $pageRoute }}', 'delete', id, actionType, dTable);
	});

	// Bulk Action
	$('.bulkAction').on('click', function() {
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

	// Show modal with contact details
	$(document).on('click', '.click-to-open', function() {
		var id = $(this).data('id');
		if (id != '') {
			$('.preloader').show();
			var getPopupDataUrl = $('#admin_url').val()+'/contact/view/'+id;
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: getPopupDataUrl,
				method: 'GET',
				data: {},
				success: function (response) {
					$('.preloader').hide();
					if (response.type == 'success') {
						$('#contact-data').html(response.message);
					} else {
						$('#contact-data').html('<tr><td colspan="2">{{trans("custom_admin.message_no_records_found")}}</td></tr>');
					}
				}
			});
		} else {
			$('#contact-data').html('<tr><td colspan="2">{{trans("custom_admin.message_no_records_found")}}</td></tr>');
		}
		$('#dark-header-modal').modal('show');
	});

	@endif

});
</script>

<!-- View Contact Details Modal -->
<div id="dark-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-colored-header bg-dark">
				<h4 class="modal-title" id="dark-header-modalLabel">@lang('custom_admin.label_details')</h4> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<tbody id="contact-data"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>