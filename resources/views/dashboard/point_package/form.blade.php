@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($point_package) ? $point_package->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($point_package) ? optional($point_package->translate($locale))->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset>
	<div class="form-group row">
		<label class="control-label col-lg-2">
			{{ trans('dashboard.point_package.user_type') }}
		</label>
		<div class="vs-radio-con vs-radio-success col-md-4">
			{!! Form::radio('user_type', "client") !!}
			<span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
			<span class="">{{ trans('dashboard.point_package.user_types.client') }}</span>

		</div>
		<div class="vs-radio-con vs-radio-success col-md-4">
			{!! Form::radio('user_type', "driver") !!}
			<span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
			<span class="">{{ trans('dashboard.point_package.user_types.driver') }}</span>

		</div>
		<div class="vs-radio-con vs-radio-success">
			{!! Form::radio('user_type', "client_and_driver") !!}
			<span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
			<span class="">{{ trans('dashboard.point_package.user_types.client_and_driver') }}</span>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }} <span class="text-danger">*</span></label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-5 col-xs-12">
					{!! Form::radio('is_active', "1", isset($point_package) && $point_package->is_active ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.user.active') }}</span>
				</div>
				<div class="vs-radio-con vs-radio-success col-md-4 col-xs-12">
					{!! Form::radio('is_active', "0", isset($point_package) && !$point_package->is_active ? 'checked' : null) !!}
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
		<label class="col-form-label col-lg-2">{{ trans('dashboard.point_package.transfer_type') }} <span class="text-danger">*</span></label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-4 col-xs-12">
					{!! Form::radio('transfer_type', "order", isset($point_package) && $point_package->transfer_type == 'order' ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.point_package.transfer_types.order') }}</span>
				</div>
				<div class="vs-radio-con vs-radio-success col-md-4 col-xs-12">
					{!! Form::radio('transfer_type', "wallet", isset($point_package) && $point_package->transfer_type == 'wallet' ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.point_package.transfer_types.wallet') }}</span>
				</div>
				<div class="vs-radio-con vs-radio-success col-md-4 col-xs-12">
					{!! Form::radio('transfer_type', "other", isset($point_package) && $point_package->transfer_type == 'other' ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.point_package.transfer_types.other') }}</span>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group amount">
		@if (isset($point_package) && $point_package->transfer_type != 'other')
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.point_package.amount') }} </label>
			<div class="col-md-10">
				<div class="input-group input-group-lg" style="width: 100%;">
					{!! Form::number('amount', null , ['class' => "touchspin", 'init-val' => null ]) !!}
				</div>
			</div>
		</div>
		@endif
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.point_package.points') }} </label>
			<div class="col-md-10">
				<div class="input-group input-group-lg" style="width: 100%;">
					{!! Form::number('points', null , ['class' => "touchspin", 'init-val' => null ]) !!}
				</div>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="font-medium-1 col-lg-2">{{ trans('dashboard.general.image') }}</label>
		<div class="col-md-9">
			<div class="custom-file">
				<input type="file" name="image" class="custom-file-input" id="inputGroupFile01" onchange="readUrl(this)">
				<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
			</div>
		</div>
		<div class="col-md-1">
			@if (isset($point_package) && $point_package->image)
			<img src="{{ $point_package->image }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
			@else
			<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
			@endif
		</div>

	</div>
</fieldset>

@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
@endsection
@section('page_styles')
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/forms/wizard.css">

@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
@endsection
@section('page_scripts')

<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/wizard-steps.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/number-input.min.js"></script>
<script>
$('input[name=transfer_type]').change(function() {
	var transfer_type = $('input[name=transfer_type]:checked').val();
	if (transfer_type != 'other') {
		var row = `<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.point_package.amount') }} </label>
			<div class="col-md-10">
				<div class="input-group input-group-lg" style="width: 100%;">
					{!! Form::number('amount', null , ['class' => "touchspin", 'init-val' => null ]) !!}
				</div>
			</div>
		</div>`;
		$('.amount').html(row);
		$(".touchspin").TouchSpin();
	}else{
		$('.amount').children().remove();
	}
});
</script>
@endsection
