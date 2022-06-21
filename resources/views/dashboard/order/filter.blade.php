<form class="form form-vertical order" action="{!! route('dashboard.order.index') !!}" method="get">
    <div class="form-body">
        <div class="row">
            {{-- <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="client">{{ trans('dashboard.client.clients') }}</label>
                    {!! Form::select("client_list[]", $client_list ,request('client_list') , ['class' => 'select2 form-control','multiple','id' => "client", 'data-placeholder' =>
                    trans('dashboard.client.clients')]) !!}
                </div>
            </div> --}}
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="order_status">{{ trans('dashboard.order.order_statuses') }}</label>
                    {!! Form::select("status_list[]", $order_statuses ,request('status_list') , ['class' => 'select2 form-control','multiple','id' => "order_status", 'data-placeholder' =>
                    trans('dashboard.order.order_statuses')]) !!}
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="order_paid_type">{{ trans('dashboard.order.order_paid_types') }}</label>
                    {!! Form::select("paid_by",trans('dashboard.order.pay_types') ,request('paid_by') , ['class' => 'select2 form-control','id' => "order_paid_type", 'placeholder' =>
                    trans('dashboard.order.order_paid_types')]) !!}
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="created_from_date">{{ trans('dashboard.order.created_from_date') }}</label>
                    {!! Form::text("created_from_date",request('created_from_date') , ['class' => 'form-control picker_date' , 'placeholder' =>
                    trans('dashboard.order.created_from_date')])
                    !!}

                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="created_to_date">{{ trans('dashboard.order.created_to_date') }}</label>
                    {!! Form::text("created_to_date", request('created_to_date') , ['class' => 'form-control picker_date', 'placeholder' =>
                    trans('dashboard.order.created_to_date')]) !!}
                </div>
            </div>


            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">{!! trans('dashboard.general.send') !!}</button>
            </div>
        </div>
    </div>
</form>
