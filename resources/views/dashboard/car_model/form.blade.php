
@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($car_model) ? $car_model->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($car_model) ? optional($car_model->translate($locale))->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.brand.brand') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::select("brand_id",$brands, isset($brand_id) ? $brand_id : null, ['class' => 'select2 form-control' , 'placeholder' => trans('dashboard.brand.brand')]) !!}
			</div>
		</div>
	</div>
</fieldset>

@section('page_styles')
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/forms/wizard.css">
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page_scripts')

<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/wizard-steps.js"></script>

@endsection
