<div class="form-group">
    <div class="row">
        <label class="font-medium-1 col-md-2">{{ trans('dashboard.car_model.car_model') }} <span class="text-danger">*</span></label>
        <div class="col-md-10">
            {!! Form::select("car_model_id",$car_models, isset($car_model_id) ? $car_model_id : null, ['class' => 'select2 form-control car_model_select' , 'placeholder' => trans('dashboard.car_model.car_model')]) !!}
        </div>
    </div>
</div>

<script>
    $('.car_model_select').select2();
</script>
