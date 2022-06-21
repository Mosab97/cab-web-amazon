@section('vendor_styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/select/select2.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">
@endsection

@section('page_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/custom/datetimepicker.css" />
@endsection
@section('vendor_scripts')

    <script src="{{ asset('dashboardAssets') }}/vendors/js/forms/select/select2.full.min.js"></script>

    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>

    <script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
	<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
@endsection
@section('page_scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/moment/moment@develop/min/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>

    <script src="{{ asset('dashboardAssets') }}/js/custom/ar.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script>
        $(function() {
            getData();
            getDuration('{{ request('get_date') }}')
         });

         $('.select-remote-client-ajax').select2({
 			ajax: {
 				url: '{{ LaravelLocalization::localizeUrl('dashboard/ajax/get_user_by_type_search/client') }}',
 				dataType: 'json',
 				delay: 250,
 				global:false,
 				data: function(params) {
 					return {
 						keyword: params.term, // search term
 						page: params.page || 1
 					};
 				},

 				processResults: function(data, params) {
 					if (data['value'] == 0 ) {
 						toastr.error(data['message'], '', { "progressBar": true });
 						return;
 					}
 					// parse the results into the format expected by Select2
 					// since we are using custom formatting functions we do not need to
 					// alter the remote JSON data, except to indicate that infinite
 					// scrolling can be used
 					params.page = params.page || 1;
 					var new_data = $.map(data.data, function (obj) {
 						  obj.text = obj.fullname || obj.phone;
 						  return obj;
 						});
 					return {
 						results: new_data,
 						pagination: {
 							more: (params.page * data.per_page) < data.total
 						}
 					};
 				},
 				cache: true
 			},

 			escapeMarkup: function(markup) {
 				return markup;
 			}, // let our custom formatter work
 			minimumInputLength: 1,
 			width: 'resolve',
			allowClear: true,
 			templateResult: formatState, // omitted for brevity, see the source of this page
 			templateSelection: formatRepoAjaxSelection, // omitted for brevity, see the source of this page
 		}).on('select2:select', function (e) {
             window.location.href = "{{ LaravelLocalization::localizeUrl('dashboard/client') }}/"+ e.params.data.id
        });

        function formatRepoAjaxSelection(repo) {
    		return repo.text || repo.phone;
    	}

    	function formatState(opt) {
    		if (!opt.id) {
    			return opt.text.toUpperCase();
    		}

    		var optimage = opt.image;
    		if (!optimage) {
    			return opt.text.toUpperCase();
    		} else {
    			var $opt = $(
    				'<span><img src="' + optimage + '" class="rounded-circle" style="width:30px; height:30px; margin-left: 5px;" /> ' + opt.text.toUpperCase() + '</span>'
    			);
    			return $opt;
    		}
    	}

        function getData() {
            $(".datatable-new-ajax").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.lucky_box.show',$lucky_box->id) }}?"+$.param(@json(request()->query())),
                    type: 'GET',
                    dataSrc: 'data'
                },
                columnDefs: [
                      {
                         orderable: false,
                         targets: 0,
                         checkboxes: {
                            selectRow: true
                         }
                      }
                  ],
                columns: [{
                    data: function (data) {
                        return  `<div class="vs-checkbox-con vs-checkbox-primary justify-content-center"><input type="checkbox" class="check_list" value="${data.id}" name="client_list[]"/><span class="vs-checkbox">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span></div>`;
                    }
                },
                {
                    class : "product-img sorting_1",
                    data: function(info) {
                        return `<a href="${ info.avatar }" data-fancybox="gallery">
                        <div class="avatar">
                        <img src="${ info.avatar }" alt="" style="width:60px; height:60px;" class="img-thumbnail rounded">
                        <span class="avatar-status-busy avatar-status-md" id="online_${ info.id }"></span>
                        </div>
                        </a>`;
                    }
                },
                {
                    data: "fullname"
                },
                {
                    data: "email"
                },
                {
                    data: "phone"
                },
                {
                    data: function(info) {
                        return `<div class="badge badge-info font-medium-1 badge-md mr-1 mb-1 client_wallet_${info.id}">${info.wallet}</div>`;
                    }
                },
                {
                    data: function(info) {
                        return `<div class="badge badge-violet badge-md mr-1 mb-1">${info.created_at}</div>`;
                    }
                },
                {
                    class : "text-center font-medium-3",
                    data: function(data) {
                        return `<a onclick="deleteItem('${data.id}' , '${data.destroy_link}')" class="text-danger">
                            <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                        </a>
                        <a class="text-success" onclick="notify('${data.id}','${data.notify_link}','client')">
                            <i class="feather icon-bell" title="{!! trans('dashboard.general.notify') !!}"></i>
                        </a>
                        <a href="${data.show_link}" class="text-info">
                            <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                        </a>
                        <a href="${data.edit_link}" class="text-primary">
                            <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                        </a>`;
                    }
                }
                ],
                dom: 'Blfrtip',
                buttons:{
                    buttons:[{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    // {
                    //     extend: 'pdfHtml5',
                    //     exportOptions: {
                    //         columns: ':visible'
                    //     }
                    // },

                    {
                        extend: 'excelHtml5',
                        text: 'EXCEL',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        text: 'JSON',
                        action: function ( e, dt, button, config ) {
                            var data = dt.buttons.exportData();

                            $.fn.dataTable.fileSave(
                            new Blob( [ JSON.stringify( data ) ] ),
                            'Export.json'
                            );
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }
                    ]
                },
                lengthMenu: [[10,25, 100, -1], [10,25, 100,"All"]],
                pageLength: 10,
                createdRow: function(row, data) {
                    $(row).addClass(`${data.id}`);
                    $('a.fancybox', row).fancybox();
                }
            })

        }

        function toggle(source) {
    		checkboxes = document.getElementsByClassName('check_list');
    		if (source.checked) {
    			for (var i = 0, n = checkboxes.length; i < n; i++) {
    				checkboxes[i].checked = source.checked;
    			}
    		} else {
    			for (var i = 0, n = checkboxes.length; i < n; i++) {
    				checkboxes[i].checked = source.checked;
    			}
    		}
    	}

        function getDuration(getDate) {
            var html_code = '';
            if (getDate == 'duration') {
                html_code = `<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                                <label class="font-medium-1 col-md-2">{{ trans('dashboard.general.from_date') }} </label>
                                <div class="col-md-10">
                                    {!! Form::date("from_date", request('from_date') ? date("Y-m-d",strtotime(request('from_date'))) : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.general.from_date')])
                                    !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <label class="font-medium-1 col-md-2">{{ trans('dashboard.general.to_date') }} </label>
                            <div class="col-md-10">
                                {!! Form::date("to_date", request('to_date') ? date("Y-m-d",strtotime(request('to_date'))) : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.general.to_date')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                </div>`;
            }
            $('.dates').html(html_code);
            $('.expire_date').pickadate({
                format: 'mm/dd/yyyy'
            });
        }
    </script>
@endsection
