{!! Form::select('store[region_id]', $regions, null , ['class' => 'select2 w-100 rounded select_region','onchange' => 'getCity(this.value)' ,'placeholder' => trans('dashboard.region.region')]) !!}
