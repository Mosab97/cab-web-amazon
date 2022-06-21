<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.brand.brand') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::select("brand_id",$brands, isset($brand_id) ? $brand_id : null, ['class' => 'select2 form-control','onchange' => 'getCarModels(this.value)' , 'placeholder' => trans('dashboard.brand.brand')]) !!}
			</div>
		</div>
	</div>
	<div class="car_models">
		@isset($car)
			<div class="form-group">
			    <div class="row">
			        <label class="font-medium-1 col-md-2">{{ trans('dashboard.car_model.car_model') }} <span class="text-danger">*</span></label>
			        <div class="col-md-10">
			            {!! Form::select("car_model_id",$car_models, null, ['class' => 'select2 form-control car_model_select' , 'placeholder' => trans('dashboard.car_model.car_model')]) !!}
			        </div>
			    </div>
			</div>
		@endisset
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.car_type.car_type') }} <span class="text-danger">*</span></label>
			<div class="col-md-4">
				{!! Form::select("car_type_id",$car_types, isset($car_type_id) ? $car_type_id : null, ['class' => 'select2 form-control' , 'placeholder' => trans('dashboard.car_type.car_type')]) !!}
			</div>
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.car.plate_type') }} <span class="text-danger">*</span></label>
			<div class="col-md-4">
				{!! Form::select("plate_type",$plate_types, null, ['class' => 'select2 form-control' , 'placeholder' => trans('dashboard.car.plate_type')]) !!}
			</div>

		</div>
	</div>

	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.car.plate_letters') }} <span class="text-danger">*</span></label>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-4">
						{!! Form::text("plate_letter_right", null, ['class' => 'form-control text-center'  ,"maxLength" => "1",'autocomplete' => "off", 'placeholder' => trans('dashboard.car.plate_letter_right')]) !!}
					</div>
					<div class="col-md-4">
						{!! Form::text("plate_letter_middle", null, ['class' => 'form-control text-center'  ,"maxLength" => "1",'autocomplete' => "off", 'placeholder' => trans('dashboard.car.plate_letter_middle')]) !!}
					</div>
					<div class="col-md-4">
						{!! Form::text("plate_letter_left", null, ['class' => 'form-control text-center'  ,"maxLength" => "1",'autocomplete' => "off", 'placeholder' => trans('dashboard.car.plate_letter_left')]) !!}
					</div>

				</div>
			</div>
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.car.plate_numbers_only') }} <span class="text-danger">*</span></label>
			<div class="col-md-3">
				{!! Form::text("plate_numbers_only", null, ['class' => 'form-control text-center' , 'autocomplete' => "off" ,"maxLength" => "4" , 'placeholder' => trans('dashboard.car.plate_numbers_only')]) !!}
			</div>

		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.car.license_serial_number') }} <span class="text-danger">*</span></label>
			<div class="col-md-4">
				{!! Form::text("license_serial_number", null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.car.license_serial_number')]) !!}
			</div>
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.car.manufacture_year') }} <span class="text-success">({!! trans('dashboard.general.optional') !!})</span></label>
			<div class="col-md-4">
				{!! Form::selectYear("manufacture_year", 2000, date("Y") , null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.car.manufacture_year')]) !!}
			</div>
		</div>
	</div>
</fieldset>

<h6><i class="step-icon feather icon-image"></i> {{ trans('dashboard.general.images') }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-lg-2">{{ trans('dashboard.car.licence_image') }} <span class="text-danger">*</span></label>
			<div class="col-md-9">
				<div class="custom-file">
					<input type="file" name="car_licence_image" class="custom-file-input" id="licence_image" onchange="readUrl(this,'licence_image-preview')">
					<label class="custom-file-label" for="licence_image">Choose file</label>
				</div>
			</div>
			<div class="col-md-1">
				@if (isset($car) && $car->car_licence_image)
				<img src="{{ $car->car_licence_image }}" class="img-thumbnail licence_image-preview" style="width: 100%; height: 100px;;">
				@else
				<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail licence_image-preview" style="width: 100%; height: 100px;">
				@endif
			</div>

		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-lg-2">{{ trans('dashboard.car.car_insurance_image') }} <span class="text-danger">*</span></label>
			<div class="col-md-9">
				<div class="custom-file">
					<input type="file" name="car_insurance_image" class="custom-file-input" id="car_insurance_image" onchange="readUrl(this,'car_insurance_image-preview')">
					<label class="custom-file-label" for="car_insurance_image">Choose file</label>
				</div>
			</div>
			<div class="col-md-1">
				@if (isset($car) && $car->car_insurance_image)
				<img src="{{ $car->car_insurance_image }}" class="img-thumbnail car_insurance_image-preview" style="width: 100%; height: 100px;;">
				@else
				<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail car_insurance_image-preview" style="width: 100%; height: 100px;">
				@endif
			</div>

		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-lg-2">{{ trans('dashboard.car.car_form_image') }} <span class="text-danger">*</span></label>
			<div class="col-md-9">
				<div class="custom-file">
					<input type="file" name="car_form_image" class="custom-file-input" id="car_form_image" onchange="readUrl(this,'car_form_image-preview')">
					<label class="custom-file-label" for="car_form_image">Choose file</label>
				</div>
			</div>
			<div class="col-md-1">
				@if (isset($car) && $car->car_form_image)
				<img src="{{ $car->car_form_image }}" class="img-thumbnail car_form_image-preview" style="width: 100%; height: 100px;;">
				@else
				<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail car_form_image-preview" style="width: 100%; height: 100px;">
				@endif
			</div>

		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-lg-2">{{ trans('dashboard.car.car_front_image') }} <span class="text-danger">*</span></label>
			<div class="col-md-9">
				<div class="custom-file">
					<input type="file" name="car_front_image" class="custom-file-input" id="car_front_image" onchange="readUrl(this,'car_front_image-preview')">
					<label class="custom-file-label" for="car_front_image">Choose file</label>
				</div>
			</div>
			<div class="col-md-1">
				@if (isset($car) && $car->car_front_image)
				<img src="{{ $car->car_front_image }}" class="img-thumbnail car_front_image-preview" style="width: 100%; height: 100px;">
				@else
				<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail car_front_image-preview" style="width: 100%; height: 100px;">
				@endif
			</div>

		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-lg-2">{{ trans('dashboard.car.car_back_image') }} <span class="text-danger">*</span></label>
			<div class="col-md-9">
				<div class="custom-file">
					<input type="file" name="car_back_image" class="custom-file-input" id="car_back_image" onchange="readUrl(this,'car_back_image-preview')">
					<label class="custom-file-label" for="car_back_image">Choose file</label>
				</div>
			</div>
			<div class="col-md-1">
				@if (isset($car) && $car->car_back_image)
				<img src="{{ $car->car_back_image }}" class="img-thumbnail car_back_image-preview" style="width: 100%; height: 100px;">
				@else
				<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail car_back_image-preview" style="width: 100%; height: 100px;">
				@endif
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
<script>
	function getCarModels(brandId) {
		$.ajax({
			url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/get_car_models_by_brand') }}/" + brandId,
			method: "GET",
			dataType: "json",
			success: function(data) {
				if (data['value'] == 1) {
					$('.car_models').html(data['view']);
				}
			}
		});
	}
</script>
@endsection
