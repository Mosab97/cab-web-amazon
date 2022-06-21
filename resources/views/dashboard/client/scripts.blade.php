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

    {{-- <script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
	<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script> --}}
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
         });

         var $now = moment();
         var $dateMin = $now;
         $('.expire_date').bootstrapMaterialDatePicker({
             format: 'MM/DD/YYYY HH:mm',
             shortTime: true,
             minDate: $dateMin,
             maxDate: null,
             // currentDate: $now,
             weekStart: 6,
             date: true,
             time: true,
             monthPicker: true,
             year: true,
             clearButton: true,
             nowButton: false,
             switchOnClick: false,
             cancelText: 'Cancel',
             okText: 'OK',
             //clearText: 'EFFACER',
             //nowText: 'MAINTENANT',
             //triggerEvent: 'focus',
             lang: '{{ app()->getLocale() }}',
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
                    url: "{{ route('dashboard.client.index') }}?"+$.param(@json(request()->query())),
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
                        return `<div class="badge badge-success font-medium-1 badge-md mr-1 mb-1">${info.finished_order_count}</div>`;
                    }
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
                        @if (auth()->user()->hasPermissions('client','wallet'))
                        <a class="text-warning" onclick="setWalletZero('${data.id}','client')">
                            <i class="feather icon-credit-card" title="{!! trans('dashboard.user.set_wallet_zero') !!}"></i>
                        </a>
                        @endif
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



        function addBalanceToAll(user_type) {
            $("#modal_wallet").modal('show');
            $('#modal_wallet #item').attr('user-type',user_type);
        }

        function addTempBalanceToAll(user_type) {
            $("#modal_temp_balance").modal('show');
            $('#modal_temp_balance #item').attr('user-type',user_type);
        }

        function saveWalletAmount() {
            var user_type = $('#modal_wallet #item').attr('user-type');
            var amount = $('#modal_wallet input[name=amount]').val();
            var clients = []
            var checkboxes = document.querySelectorAll('input[class=check_list]:checked')

            for (var i = 0; i < checkboxes.length; i++) {
              clients.push(checkboxes[i].value)
            }

            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/add_balance_to_all') }}",
                method: "POST",
                dataType: "json",
                global: false,
                data: {
                    amount: amount,
                    user_type: user_type,
                    user_list: clients,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#modal_wallet").modal('hide');
                    $('#modal_wallet input[name=amount]').val('')
                    if (data['value'] == 1) {
                        $(".datatable-new-ajax").dataTable().fnDestroy();
                        getData();
                        clients = [];
                        $('.select_all_rows').prop('checked',false);
                        toastr.success(data['message'], '', {
                            "progressBar": true
                        });
                    } else {
                        toastr.danger(data['message'], '', {
                            "progressBar": true
                        });
                    }
                }
            }).fail(function(data) {
                $.each(data.responseJSON.errors, function(index, val) {
                    toastr.error(val, '', {
                        "progressBar": true
                    });
                });
            });

        }

        function saveTempWalletAmount() {
            var user_type = $('#modal_temp_balance #item').attr('user-type');
            var amount = $('#modal_temp_balance input[name=amount]').val();
            var start_at = $('#modal_temp_balance input[name=start_at]').val();
            var end_at = $('#modal_temp_balance input[name=end_at]').val();
            var clients = []
            var checkboxes = document.querySelectorAll('input[class=check_list]:checked')
            for (var i = 0; i < checkboxes.length; i++) {
              clients.push(checkboxes[i].value)
            }

            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/add_temp_balance_to_all') }}",
                method: "POST",
                dataType: "json",
                // global: false,
                data: {
                    amount: amount,
                    user_type: user_type,
                    start_at: start_at,
                    end_at: end_at,
                    user_list: clients,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#modal_temp_balance").modal('hide');
                    $('#modal_temp_balance input[name=amount]').val('')
                    $('#modal_temp_balance input[name=start_at]').val('')
                    $('#modal_temp_balance input[name=end_at]').val('')
                    if (data['value'] == 1) {
                        $(".datatable-new-ajax").dataTable().fnDestroy();
                        getData();
                        clients = [];
                        $('.select_all_rows').prop('checked',false);
                        toastr.success(data['message'], '', {
                            "progressBar": true
                        });
                    } else {
                        toastr.danger(data['message'], '', {
                            "progressBar": true
                        });
                    }
                }
            }).fail(function(data) {
                $.each(data.responseJSON.errors, function(index, val) {
                    toastr.error(val, '', {
                        "progressBar": true
                    });
                });
            });

        }

        function setWalletZero(clientId,userType) {
            var checkboxes = document.querySelectorAll('input[class=check_list]:checked')
            $("#modal_zero_wallet").modal('show');
            console.log(clientId != 'all' || (clientId == 'all' && checkboxes.length > 0));

            $('#modal_zero_wallet #item').attr('user-id',clientId);
            $('#modal_zero_wallet #item').attr('user-type',userType);
            if (clientId == 'all' && checkboxes.length == 0) {
                let html_code = `<label class="font-medium-1 col-md-3">
                    {!! trans('dashboard.client.which_clients_reset_wallet') !!}
                </label>
                <div class="col-md-9">
                    {!! Form::select('order_status', trans('dashboard.client.client_order_statuses') , null, ['class' => 'select2 form-control','id' => 'client_order_status']) !!}
                </div>`;
                $('.client_category').html(html_code);
            }else if (clientId != 'all' || (clientId == 'all' && checkboxes.length > 0)) {
                $('.client_category').html('');
            }
        }

        function updateWalletByZero() {
            var clientId=$('#modal_zero_wallet #item').attr('user-id');
            var userType =$('#modal_zero_wallet #item').attr('user-type');
            var order_status =$('#client_order_status').val();
            var clients = []
            var checkboxes = document.querySelectorAll('input[class=check_list]:checked')

            for (var i = 0; i < checkboxes.length; i++) {
              clients.push(checkboxes[i].value)
            }

            var clientWallet = $('.client_wallet_'+clientId);
            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/set_wallet_of_user_zero') }}/"+clientId,
                method: "POST",
                dataType: "json",
                data: {
                    user_type: userType,
                    user_list: clients,
                    order_status: order_status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#modal_zero_wallet").modal('hide');
                    if (data['value'] == 1) {
                        if (clientId == 'all') {
                            $(".datatable-new-ajax").dataTable().fnDestroy();
                            getData();
                            clients = [];
                            $('.select_all_rows').prop('checked',false);
                        }else{
                            clientWallet.text(data.wallet);
                        }
                        toastr.success(data['message'], '', {
                            "progressBar": true
                        });
                    } else {
                        toastr.danger(data['message'], '', {
                            "progressBar": true
                        });
                    }
                }
            }).fail(function(data) {
                $.each(data.responseJSON.errors, function(index, val) {
                    toastr.error(val, '', {
                        "progressBar": true
                    });
                });
            });

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
    </script>
@endsection
