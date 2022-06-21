<div class="accordion" id="accordionExample">
    <div class="collapse-margin border-info rounded">
        <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <span class="lead collapse-title">
                {!! trans('dashboard.general.advanced_search') !!}
            </span>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <form class="form form-vertical" action="{!! route('dashboard.lucky_box.show',$lucky_box->id) !!}" method="get">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    {!! Form::select("user_type", trans('dashboard.lucky_box.user_types') ,request('user_type') , ['class' => 'select2 form-control','id' => "user_type", 'placeholder' =>
                                    trans('dashboard.lucky_box.user_type')]) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    {!! Form::select("get_date", trans('dashboard.lucky_box.get_dates') ,request('get_date') , ['class' => 'select2 form-control','id' => "get_date", 'placeholder' =>
                                    trans('dashboard.lucky_box.get_date'),'onclick' => 'getDuration(this.value)']) !!}
                                </div>
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
