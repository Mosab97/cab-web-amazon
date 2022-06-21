@section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">


@endsection
@section('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/card-analytics.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/data-list-view.css">

    <link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/custom/datetimepicker.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/card-analytics.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"/>
@endsection
@section('vendor_scripts')
    <script src="{{ asset('dashboardAssets') }}/vendors/js/charts/apexcharts.min.js"></script>

    <script src="{{ asset('dashboardAssets') }}/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>

@endsection
@section('page_scripts')
    <script src="{{ asset('dashboardAssets') }}/js/scripts/cards/card-analytics.js"></script>
    <script src="{{ asset('dashboardAssets') }}/js/scripts/forms/select/form-select2.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        $(function() {
            getDuration('{{ request('get_date') }}')
            getCustomDate('{{ request('custom_date_type') }}')
         });

        function getDuration(getDate) {
            let html_code = '';
            if (getDate == 'custom') {
                html_code = `<div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="row">
                                <label class="font-medium-1 col-md-2">{{ trans('dashboard.report.custom_date_type') }} </label>
                                <div class="col-md-10">
                                    {!! Form::select("custom_date_type", trans('dashboard.report.custom_date_types') ,request('custom_date_type') , ['class' => 'select2 form-control','id' => "custom_date_type", 'placeholder' =>
                                    trans('dashboard.report.custom_date_type'),'onchange' => 'getCustomDate(this.value)']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            }
            $('.custom').html(html_code);
            $('.dates').html(``);
        }

        function getCustomDate(dateCustomType) {
            let html_code = '';
            switch (dateCustomType) {
                case 'duration':
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
                    break;
                case 'day_month_year':
                html_code = `<div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <label class="font-medium-1 col-md-2">{{ trans('dashboard.report.specicified_date') }} </label>
                                    <div class="col-md-10">
                                        {!! Form::date("specicified_date", request('specicified_date') ? date("Y-m-d",strtotime(request('specicified_date'))) : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.report.specicified_date')])
                                        !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
                case 'month_year':
                html_code = `<div class="row">
                                <label class="font-medium-1 col-md-2">{{ trans('dashboard.report.specicified_month') }} </label>
                                <div class="col-md-10 form-group">
                                    {!! Form::text("specicified_month", request('specicified_month') ? date("Y-m",strtotime(request('specicified_month'))) : null , ['class' => 'form-control','id' => 'month_year' , 'placeholder' => trans('dashboard.report.specicified_month')])
                                    !!}
                                </div>
                            </div>`;
                    break;
                case 'year':
                html_code = `<div class="row">
                                <label class="font-medium-1 col-md-2">{{ trans('dashboard.report.specicified_year') }} </label>
                                <div class="col-md-10 form-group">
                                    {!! Form::selectYear("specicified_year",2019,date("Y"), request('specicified_year') ? date("Y",strtotime(request('specicified_year'))) : null , ['class' => 'form-control' , 'placeholder' => trans('dashboard.report.specicified_year')])
                                    !!}
                                </div>
                            </div>`;
                    break;

            }
            $('.dates').html(html_code);
            $('.expire_date').pickadate({
                format: 'yyyy-mm-dd'
            });

            $('#month_year').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM'
            });

        }
    </script>
@endsection
