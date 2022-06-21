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
    <script src="{{ asset('dashboardAssets') }}/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>

    <script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
@endsection
@section('page_scripts')
    {{-- <script src="{{ asset('dashboardAssets') }}/js/scripts/datatables/datatable.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/moment/moment@develop/min/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>

    <script src="{{ asset('dashboardAssets') }}/js/scripts/forms/number-input.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script>
    $(function() {
        getData();
        $('.extend_to').pickadate({
            format: 'mm/dd/yyyy'
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
    });

    $('.select-remote-driver-ajax').select2({
       ajax: {
           url: '{{ LaravelLocalization::localizeUrl('dashboard/ajax/get_user_by_type_search/driver') }}',
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
        window.location.href = "{{ LaravelLocalization::localizeUrl('dashboard/driver') }}/"+ e.params.data.id
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

    function changePackageId() {

        var isPaid = $('.driver_change_package_form input[name=is_paid]:checked').val() == 'on' ? 1 : 0;
        var packageId = $('.driver_change_package_form select[name=package_id]').val();
        var drivers = []
        var checkboxes = document.querySelectorAll('input[class=check_list]:checked')

        var form_data = new FormData();
        form_data.append('_token', '{{ csrf_token() }}');
        form_data.append('is_paid', isPaid);
        form_data.append('package_id', packageId);
        form_data.append('status', '{{ request('status') }}');
        for (var i = 0; i < checkboxes.length; i++) {
            form_data.append('driver_list[]', checkboxes[i].value);
            drivers.push(checkboxes[i].value)
        }

        $.ajax({
            url: '{{ LaravelLocalization::localizeUrl('dashboard/ajax/set_new_package_to_drivers') }}',
            method: $('.driver_change_package_form').attr('method'),
            data: form_data,
            // global: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data['value'] == 1) {
                    $(".datatable-new-ajax").dataTable().fnDestroy();
                    drivers = [];
                    $('.select_all_rows').prop('checked',false);
                    getData();

                    toastr.success(data['message'], '', {
                        "progressBar": true
                    });
                    $('#change_package_modal').modal('hide');
                    $('.driver_packages').prepend(data.view);
                    $('.no_package_alert').remove();
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

        function toggleAdminAccept(driver_id) {
            var span_text = $('.span_driver_'+driver_id);
            var accept_btn = $('.accept_btn_'+driver_id);
            var refuse_btn = $('.refuse_btn_'+driver_id);
            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/enable_driver_data') }}/"+driver_id,
                method: "POST",
                dataType: "json",
                data:{_token:'{{ csrf_token() }}', is_admin_accept : "1"},
                success: function(data) {
                    if (data['value'] == 1) {
                        toastr.success('{{ trans('dashboard.messages.success_update') }}', '', { "progressBar": true });
                    }else{
                        toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', { "progressBar": true });
                    }
                    span_text.text(data.text);
                    span_text.removeClass(data.removed_class);
                    span_text.addClass(data.text_class);
                    // accept_btn.attr('disabled',data.accept_btn);
                    // refuse_btn.attr('disabled',data.refuse_btn);
                }
            });
        }

        function changeDriverType(driver_id,driver_type) {
            var span_text = $('.span_driver_type_'+driver_id);
            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/change_driver_type') }}/"+driver_id,
                method: "POST",
                dataType: "json",
                data:{_token:'{{ csrf_token() }}', driver_type : driver_type},
                success: function(data) {
                    if (data['value'] == 1) {
                        toastr.success('{{ trans('dashboard.messages.success_update') }}', '', { "progressBar": true });
                    }else{
                        toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', { "progressBar": true });
                    }
                    span_text.text(data.text);
                }
            });
        }

        function addTempBalanceToAll(user_type) {
            $("#modal_temp_balance").modal('show');
            $('#modal_temp_balance #item').attr('user-type',user_type);
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
                global: false,
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


        function openRefuseReasonModal(driver_id) {
            var driver_id = $('#refuse_reason_modal input[name=driver_id]').val(driver_id);
            $('#refuse_driver_data_modal').modal('show');
        }

        function refuseDriverData() {
            var driver_id = $('#refuse_reason_modal input[name=driver_id]').val();
            var refuse_reason = $('#refuse_reason_modal textarea[name=refuse_reason]');
            var refuse_reason_val = refuse_reason.val();
            var accept_btn = $('.accept_btn_'+driver_id);
            var refuse_btn = $('.refuse_btn_'+driver_id);
            var span_text = $('.span_driver_'+driver_id);
            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/enable_driver_data') }}/"+driver_id,
                method: "POST",
                dataType: "json",
                data:{_token:'{{ csrf_token() }}' , refuse_reason : refuse_reason_val , is_admin_accept : "0"},
                success: function(data) {
                    if (data['value'] == 1) {
                        toastr.success('{{ trans('dashboard.messages.success_update') }}', '', { "progressBar": true });
                    }else{
                        toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', { "progressBar": true });
                    }
                    $('#refuse_driver_data_modal').modal('hide');
                    span_text.text(data.text);
                    span_text.removeClass(data.removed_class);
                    span_text.addClass(data.text_class);
                    // accept_btn.attr('disabled',data.accept_btn);
                    // refuse_btn.attr('disabled',data.refuse_btn);
                    refuse_reason.val('')
                }
            });
        }

        function changePackageSubscribtion(subscribe_status) {
            // var end_date = $('.expire_date').val();
            // var package_end_date = $('.package_'+packageId);
            // var package_status = $('.status_'+packageId);
            // var paid_status_css = $('.paid_status_css_'+packageId);
            var isPaid=$('.driver_package_form input[name=is_paid]:checked').val();
            var extend_to=$('.driver_package_form input[name=extend_to]').val();
            var form_data = new FormData();
            var drivers = []
            var checkboxes = document.querySelectorAll('input[class=check_list]:checked')
            for (var i = 0; i < checkboxes.length; i++) {
                form_data.append('user_list[]', checkboxes[i].value);
                drivers.push(checkboxes[i].value)
            }

            subscribe_status = '{{ request('status') }}';

            form_data.append('_token', '{{ csrf_token() }}');
            form_data.append('is_paid', isPaid);
            form_data.append('extend_to', extend_to);
            form_data.append('status', subscribe_status);
            $.ajax({
                url: $('.driver_package_form').attr('action'),
                method: $('.driver_package_form').attr('method'),
                data:form_data,
                global:false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data['value'] == 1) {
                        $('#package_subscribe_modal').modal('hide');
                        $(".datatable-new-ajax").dataTable().fnDestroy();
                        getData();
                        drivers = [];
                        $('.select_all_rows').prop('checked',false);

                        toastr.success(data['message'], '', { "progressBar": true });



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

        function convertDriversToAvailable() {

            var form_data = new FormData();
            var drivers = []
            var checkboxes = document.querySelectorAll('input[class=check_list]:checked')
            for (var i = 0; i < checkboxes.length; i++) {
                form_data.append('driver_list[]', checkboxes[i].value);
                drivers.push(checkboxes[i].value)
            }
            subscribe_status = '{{ request('status') }}';
            form_data.append('_token', '{{ csrf_token() }}');
            form_data.append('status', subscribe_status);
            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/convert_unavailable_drivers_to_available') }}",
                method: "POST",
                data:form_data,
                global:false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data['value'] == 1) {
                        $(".datatable-new-ajax").dataTable().fnDestroy();
                        getData();
                        drivers = [];
                        $('.select_all_rows').prop('checked',false);
                        toastr.success(data['message'], '', { "progressBar": true });
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


    </script>

    <script>
        function getData() {
            $(".datatable-new-ajax").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.driver.index') }}?"+$.param(@json(request()->query())),
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
                columns: [
                    {
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
                        data: "phone"
                    },
                    {
                        data: "identity_number"
                    },
                    {
                        data: function(info) {
                            return `<div class="badge badge-info font-medium-1 badge-md mr-1 mb-1 client_wallet_${info.id}">${info.wallet}</div>`;
                        }
                    },
                    {
                        data: function(info) {
                            return `<div class="badge badge-success font-medium-1 badge-md mr-1 mb-1">${info.finished_order_count}</div>`;
                        }
                    },
                    @if (request('status') == 'drivers_cancelled_orders')
                    {
                        data: function(info) {
                            return `<div class="badge badge-danger font-medium-1 badge-md mr-1 mb-1">${info.driver_cancel_order_count}</div>`;
                        }
                    },
                    @endif
                    {
                        data: function(info) {
                            return info.car_info;
                        }
                    },
                    @if (auth()->user()->hasPermissions('driver','admin_accept_driver'))
                    {
                        data: function(info) {
                            return info.toggle_data;
                        }
                    },
                    @endif
                    {
                        data: function(info) {
                            return info.driver_type;
                        }
                    },
                    {
                        data: function(info) {
                            if (info.package_type) {
                                return `<div class="badge badge-success badge-md mr-1 mb-1">${info.package_type}</div>`;
                            }else{
                                return '';
                            }
                        }
                    },
                    {
                        data: function(info) {
                            return `<div class="text-center">
                                <a href="javascript:void(0)" class="elm_reply_btn btn btn-success btn-sm font-small-2 text-bold-600 text-center elm_reply_${info.id}" data-toggle="popover" data-placement="top" onclick="getElmReply('${ info.id }')" data-content="" data-original-title="">
                                    {{ trans('dashboard.driver.elm.reply') }}
                                </a>
                            </div>`;
                        }
                    },
                    {
                        data: function(info) {
                            if (info.end_subscribe_at) {
                                return `<div class="badge badge-violet badge-md mr-1 mb-1">${info.end_subscribe_at}</div>`;
                            }else{
                                return `<div class="end_sub_at_${info.id}">
                                    <a class="btn btn-primary btn-block btn-sm text-bold-700 font-small-2 text-white" onclick="changePackageModal('${info.id}')">
                                     {{ trans('dashboard.package.change_package') }}
                                     </a>
                                </div>`;
                            }
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
                            return `<a onclick="deleteItem(${data.id} , '${data.destroy_link}')" class="text-danger">
                                            <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                                        </a>
                                        <a class="text-success" onclick="notify(${data.id},'${data.notify_link}','driver')">
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

        function addBalanceToAll(user_type) {

            $("#modal_wallet").modal('show');
            $('#modal_wallet #item').attr('user-type',user_type);

        }
        function saveWalletAmount() {
            var user_type=$('#modal_wallet #item').attr('user-type');
            var amount =$('#modal_wallet input[name=amount]').val();
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
                    $('#modal_wallet input[name=amount]').val('');
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
                btn.html('<i class="feather icon-refresh-cw"></i>');
                $.each(data.responseJSON.errors, function(index, val) {
                    toastr.error(val, '', {
                        "progressBar": true
                    });
                });
            });

        }


        function getElmReply(driver_id) {
            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/get_elm_reply') }}/" + driver_id,
                method: "POST",
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data['value'] == 1) {
                        $('.elm_reply_'+driver_id).data('title',data.resultCode);
                        $('.elm_reply_'+driver_id).data('content',data.resultMsg ? data.resultMsg : "");
                        $('.elm_reply_btn').popover('hide');
                        $('.elm_reply_'+driver_id).popover('show');
                    }
                }
            });
        }
        function changePackageModal(driverId) {
            $('#change_package_modal').modal('show');
            $('.driver_change_package_form input[name=driver_id]').val(driverId);
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
