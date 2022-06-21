<div class="form-group">
	<div class="row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.point_offer.points') }} </label>
		<div class="col-md-4">
			<div class="input-group input-group-lg" style="width: 100%;">
				{!! Form::number('points', null , ['class' => "touchspin", 'init-val' => null ]) !!}
			</div>
		</div>
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.point_offer.number_of_orders') }} </label>
		<div class="col-md-4">
			<div class="input-group input-group-lg" style="width: 100%;">
				{!! Form::number('number_of_orders', null , ['class' => "touchspin", 'init-val' => null ]) !!}
			</div>
		</div>
	</div>
</div>
<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.point_offer.start_at') }} <span class="text-danger">*</span></label>
	<div class="col-lg-4">
		{!! Form::text('start_at',isset($point_offer) && $point_offer->start_at ? $point_offer->start_at->format("m/d/Y") : date("m/d/Y") , ['class' => 'form-control class_date' , 'placeholder' =>
		trans('dashboard.point_offer.start_at')]) !!}
	</div>
	<label class="col-form-label col-lg-2">{{ trans('dashboard.point_offer.end_at') }} <span class="text-danger">*</span></label>
	<div class="col-lg-4">
		{!! Form::text('end_at',isset($point_offer) && $point_offer->end_at ? $point_offer->end_at->format("m/d/Y") : date("m/d/Y") , ['class' => 'form-control class_date' , 'placeholder' =>
		trans('dashboard.point_offer.end_at')]) !!}
	</div>
</div>

<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }}</label>
	<div class="col-md-10">
		<div class="row">
			<div class="vs-radio-con vs-radio-success col-md-7">
				{!! Form::radio('is_active', 1, (isset($point_offer) && $point_offer->is_active) || !isset($point_offer) ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.active') }}</span>

			</div>
			<div class="vs-radio-con vs-radio-success">
				{!! Form::radio('is_active', 0, isset($point_offer) && ! $point_offer->is_active ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.not_active') }}</span>
			</div>

		</div>
	</div>
</div>
<div class="form-group row">
	<label class="control-label col-lg-2">
		@lang('dashboard.point_offer.user_type')
	</label>
	<div class="vs-radio-con vs-radio-success col-md-4">
		{!! Form::radio('user_type', "client" ,'checked') !!}
		<span class="vs-radio">
			<span class="vs-radio--border"></span>
			<span class="vs-radio--circle"></span>
		</span>
		<span class="">{{ trans('dashboard.point_offer.user_types.client') }}</span>

	</div>
	<div class="vs-radio-con vs-radio-success col-md-4">
		{!! Form::radio('user_type', "driver" ,'checked') !!}
		<span class="vs-radio">
			<span class="vs-radio--border"></span>
			<span class="vs-radio--circle"></span>
		</span>
		<span class="">{{ trans('dashboard.point_offer.user_types.driver') }}</span>

	</div>
	<div class="vs-radio-con vs-radio-success">
		{!! Form::radio('user_type', "client_and_driver") !!}
		<span class="vs-radio">
			<span class="vs-radio--border"></span>
			<span class="vs-radio--circle"></span>
		</span>
		<span class="">{{ trans('dashboard.point_offer.user_types.client_and_driver') }}</span>
	</div>
</div>
<div class="form-group">
	<div class="row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.point_offer.fcm_notification') }} </label>
		<div class="col-md-10">
			{!! Form::textarea("fcm_notification", null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.point_offer.fcm_notification')]) !!}
		</div>
	</div>
</div>
<div class="text-right">
	<button type="submit" class="btn btn-primary">{{ $btnSubmit }}</button>
</div>
@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
@endsection

@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/number-input.min.js"></script>
<script>
	$(function() {
		$('.class_date').pickadate({
			format: 'mm/dd/yyyy'
		});
	})
</script>

@endsection
