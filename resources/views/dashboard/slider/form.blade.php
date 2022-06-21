
@foreach (config('translatable.locales') as $locale)
<h6>{{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($slider) ? $slider->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($slider) ? optional($slider->translate($locale))->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6>{{ trans('dashboard.general.public_data') }}</h6>
<fieldset>

	<div class="form-group row">
		<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }} <span class="text-danger">*</span></label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-7">
					{!! Form::radio('is_active', 1, isset($slider) && $slider->is_active == 'male' ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.user.active') }}</span>

				</div>
				<div class="vs-radio-con vs-radio-success">
					{!! Form::radio('is_active', 0, isset($slider) && $slider->is_active == 'female' ? 'checked' : null) !!}
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
		<label class="col-form-label col-lg-2" >{{ trans('dashboard.slider.ordering') }}</label>
		<div class="col-md-10">
			{!! Form::number('ordering', null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.slider.ordering')]) !!}
		</div>
	</div>
	{{-- <div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.store.store') }} </label>
			<div class="col-md-10">
				{!! Form::select("store_id", $stores , null, ['class' => 'form-control select-search' , 'placeholder' => trans('dashboard.store.store')]) !!}
			</div>
		</div>
	</div> --}}
	

	<div class="form-group">
		<div class="row">
    		<label class="font-medium-1 col-lg-2">{{ trans('dashboard.general.image') }}</label>
    		<div class="col-md-9">
    			<div class="custom-file">
    				<input type="file" name="image" class="custom-file-input" id="inputGroupFile01" onchange="readUrl(this)">
    				<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    			</div>
    		</div>
    		<div class="col-md-1">
    			@if (isset($slider) && $slider->image)
    				<img src="{{ $slider->image }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
    			@else
    				<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
    			@endif
    		</div>

    	</div>
    </div>
</fieldset>
@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/select/select2.min.css">
@endsection
@section('page_styles')
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/forms/wizard.css">
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/select/select2.full.min.js"></script>
@endsection
@section('page_scripts')

<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/wizard-steps.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/select/form-select2.js"></script>

@endsection
