
@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($app_offer) ? $app_offer->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($app_offer) ? optional($app_offer->translate($locale))->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset class="form-group">

    <div class="form-group row">
        <label class="control-label col-lg-2">
            @lang('dashboard.app_offer.user_type')
        </label>
        <div class="vs-radio-con vs-radio-success col-md-4">
            {!! Form::radio('user_type', "client" ,'checked') !!}
            <span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
            <span class="">{{ trans('dashboard.app_offer.user_types.client') }}</span>

        </div>
        <div class="vs-radio-con vs-radio-success col-md-4">
            {!! Form::radio('user_type', "driver") !!}
            <span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
            <span class="">{{ trans('dashboard.app_offer.user_types.driver') }}</span>

        </div>
        <div class="vs-radio-con vs-radio-success">
            {!! Form::radio('user_type', "client_and_driver") !!}
            <span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
            <span class="">{{ trans('dashboard.app_offer.user_types.client_and_driver') }}</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }}</label>
        <div class="col-md-10">
            <div class="row">
                <div class="vs-radio-con vs-radio-success col-md-7">
                    {!! Form::radio('is_active', 1, isset($app_offer) && $app_offer->is_active ? 'checked' : null) !!}
                    <span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
                    <span class="">{{ trans('dashboard.user.active') }}</span>

                </div>
                <div class="vs-radio-con vs-radio-success">
                    {!! Form::radio('is_active', 0, isset($app_offer) && ! $app_offer->is_active ? 'checked' : null) !!}
                    <span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
                    <span class="">{{ trans('dashboard.user.not_active') }}</span>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
		<label class="font-medium-1 col-lg-2">{{ trans('dashboard.ar.image') }}</label>
		<div class="col-md-9">
			<div class="custom-file">
				<input type="file" name="image_ar" class="custom-file-input" id="inputGroupFile01">
				<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
			</div>
		</div>
		<div class="col-md-1">
			@if (isset($app_offer) && $app_offer->image_ar)
				<img src="{{ $app_offer->image_ar }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
			@else
				<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
			@endif
		</div>
	</div>
    <div class="row">
        <label class="font-medium-1 col-lg-2">{{ trans('dashboard.en.image') }}</label>
        <div class="col-md-9">
            <div class="custom-file">
                <input type="file" name="image_en" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
        <div class="col-md-1">
            @if (isset($app_offer) && $app_offer->image_en)
                <img src="{{ $app_offer->image_en }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
            @else
                <img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
            @endif
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
