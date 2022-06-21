<form class="form form-vertical order" action="{!! route('dashboard.predecessor_service.index') !!}" method="get">
    <div class="form-body">
        <div class="row">
          <input type="hidden" value="{{$user_type}}" name='user_type' >
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="created_from_date">{{ trans('dashboard.order.created_from_date') }}</label>
                    {!! Form::text("created_from_date",request('created_from_date') , ['style'=>'border: 1px solid;','class' => 'form-control picker_date' , 'placeholder' =>
                    trans('dashboard.order.created_from_date')])
                    !!}

                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="created_to_date">{{ trans('dashboard.order.created_to_date') }}</label>
                    {!! Form::text("created_to_date", request('created_to_date') , ['style'=>'border: 1px solid;','class' => 'form-control picker_date', 'placeholder' =>
                    trans('dashboard.order.created_to_date')]) !!}
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">{!! trans('dashboard.general.send') !!}</button>
            </div>
        </div>
    </div>
</form>


