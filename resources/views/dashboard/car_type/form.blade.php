@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span
					class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($car_type) ? $car_type->translate($locale)->name : null, ['class'
				=> 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($car_type) ? optional($car_type->translate($locale))->desc :
				null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset class="form-group">
	<div class="row">
		<div class="form-group">
			<div class="row">
				<label class="font-medium-1 col-md-6">{{ trans('dashboard.car.counter_open') }} </label>
				<div class="col-md-6">
					{!! Form::text("counter_open", null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.car.counter_open')]) !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<div class="row">
				<label class="font-medium-1 col-md-6">{{ trans('dashboard.car.kilo_price') }} </label>
				<div class="col-md-6">
					{!! Form::text("kilo_price", null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.car.kilo_price')]) !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="font-medium-1 col-lg-2">{{ trans('dashboard.general.image') }}</label>
		<div class="col-md-9">
			<div class="custom-file">
				<input type="file" name="image" class="custom-file-input" id="inputGroupFile01"
					onchange="readUrl(this)">
				<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
			</div>
		</div>
		<div class="col-md-1">
			@if (isset($car_type) && $car_type->image)
			<img src="{{ $car_type->image }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
			@else
			<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}"
				class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
			@endif
		</div>

	</div>
</fieldset>
@section('page_styles')
<link rel="stylesheet"
	href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/forms/wizard.css">
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page_scripts')

<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/wizard-steps.js"></script>

@endsection