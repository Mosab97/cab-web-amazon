<div class="accordion" id="accordionExample">
    <div class="collapse-margin border-info rounded">
        <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <span class="lead collapse-title">
                {!! trans('dashboard.general.search') !!}
            </span>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <form class="form form-vertical" action="{!! route('dashboard.report.index') !!}" method="get">
                    <div class="form-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::select("transaction_type", trans('dashboard.report.transaction_types') ,request('transaction_type') , ['class' => 'select2 form-control', 'placeholder' =>
                                    trans('dashboard.report.transaction_type')]) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::select("get_date", trans('dashboard.report.get_dates') ,request('get_date') , ['class' => 'select2 form-control','id' => "get_date", 'placeholder' =>
                                    trans('dashboard.report.get_date'),'onchange' => 'getDuration(this.value)']) !!}
                                </div>
                            </div>

                            <div class="custom col-12">

                            </div>
                            <div class="dates col-12">

                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">{!! trans('dashboard.general.send') !!}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
