@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($app_ad) ? @$app_ad->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>

</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset>
<div class="form-group">
	<div class="row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.package.package_price') }} <span class="text-danger">*</span></label>
		<div class="col-md-4">
			<div class="input-group input-group-lg" style="width: 100%;">
				{!! Form::text('package_price', null , ['class' => "touchspin" ,'data-bts-step' => "0.1" ,'data-bts-decimals' => "2"]) !!}
			</div>
		</div>
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.package.commission') }} <span class="text-danger">*</span></label>
		<div class="col-md-4">
			<div class="input-group input-group-lg" style="width: 100%;">
				{!! Form::text('commission', null , ['class' => "touchspin" ,'data-bts-step' => "0.25" ,'data-bts-decimals' => "2"]) !!}
			</div>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.package.duration') }} <span class="text-danger">*</span></label>
		<div class="col-md-4">
			<div class="input-group input-group-lg" style="width: 100%;">
				{!! Form::text('duration', null , ['class' => "touchspin"]) !!}
			</div>
		</div>
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.package.add_free_duration') }}</label>
		<div class="col-md-4">
			<div class="input-group input-group-lg" style="width: 100%;">
				{!! Form::text('free_duration', null , ['class' => "touchspin"]) !!}
			</div>
		</div>
	</div>
</div>
<div class="form-group">
    <div class="row">
        <label class="font-medium-1 col-md-2">{{ trans('dashboard.package.extend_duration') }}</label>
        <div class="col-md-4">
            <div class="input-group input-group-lg" style="width: 100%;">
                {!! Form::text('extend_duration', null , ['class' => "touchspin"]) !!}
            </div>
        </div>


        <label class="font-medium-1 col-md-2">{{ trans('dashboard.package.discount_percent') }}</label>
        <div class="col-md-4">
            <div class="input-group input-group-lg" style="width: 100%;">
                {!! Form::text('discount_percent', null , ['class' => "touchspin" ,'data-bts-step' => "0.1" ,'data-bts-decimals' => "2"]) !!}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
	<div class="row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.package.date.discount_start') }} </label>
		<div class="col-md-4">
			{!! Form::date("start_discount_at", isset($package) && $package->start_discount_at ? $package->start_discount_at->format("m/d/Y") : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.app_ad.start_at')])
			!!}
		</div>
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.package.date.discount_end') }} </label>
		<div class="col-md-4">
			{!! Form::date("end_discount_at", isset($package) && $package->end_discount_at ? $package->end_discount_at->format("m/d/Y") : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.app_ad.end_at')]) !!}
		</div>
	</div>
</div>
<div class="form-group">
    <div class="row">
        <label class="font-medium-1 col-md-2">{{ trans('dashboard.package.date.extend_start') }} </label>
        <div class="col-md-4">
            {!! Form::date("start_extend_at", isset($package) && $package->start_extend_at ?$package->start_extend_at->format("m/d/Y") : null, ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.app_ad.start_at')])
            !!}
        </div>
        <label class="font-medium-1 col-md-2">{{ trans('dashboard.package.date.extend_end') }} </label>
        <div class="col-md-4">
            {!! Form::date("end_extend_at", isset($package) && $package->end_extend_at ?$package->end_extend_at->format("m/d/Y") : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.app_ad.end_at')]) !!}
        </div>
    </div>
</div>
<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }}</label>
	<div class="col-md-10">
		<div class="row">
			<div class="vs-radio-con vs-radio-success col-md-7">
				{!! Form::radio('is_active', 1, isset($package) && $package->is_active ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.active') }}</span>

			</div>
			<div class="vs-radio-con vs-radio-success">
				{!! Form::radio('is_active', 0, isset($package) && ! $package->is_active ? 'checked' : null) !!}
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
    <label class="col-form-label col-lg-2">{{ trans('dashboard.package.is_active_discount_stata') }}</label>
    <div class="col-md-10">
        <div class="row">
            <div class="vs-radio-con vs-radio-success col-md-7">
                {!! Form::radio('is_discount_active', 1, isset($package) && $package->is_discount_active ? 'checked' : null) !!}
                <span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
                <span class="">{{ trans('dashboard.user.active') }}</span>

            </div>
            <div class="vs-radio-con vs-radio-success">
                {!! Form::radio('is_discount_active', 0, isset($package) && ! $package->is_discount_active ? 'checked' : null) !!}
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
    <label class="col-form-label col-lg-2">{{ trans('dashboard.package.is_active_extend_stata') }}</label>
    <div class="col-md-10">
        <div class="row">
            <div class="vs-radio-con vs-radio-success col-md-7">
                {!! Form::radio('is_extend_active', 1, isset($package) && $package->is_extend_active ? 'checked' : null) !!}
                <span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
                <span class="">{{ trans('dashboard.user.active') }}</span>

            </div>
            <div class="vs-radio-con vs-radio-success">
                {!! Form::radio('is_extend_active', 0, isset($package) && ! $package->is_extend_active ? 'checked' : null) !!}
                <span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
                <span class="">{{ trans('dashboard.user.not_active') }}</span>
            </div>

        </div>
    </div>
</div>
<fieldset>

{{-- <div class="text-right">
	<button type="submit" class="btn btn-primary">{{ $btnSubmit }}</button>
</div> --}}


@section('vendor_styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">
@endsection
@section('page_styles')
	<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/forms/wizard.css">
@endsection
@section('vendor_scripts')
	<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
	<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
	<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
	<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
	<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
@endsection
@section('page_scripts')
	<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/wizard-steps.js"></script>
	<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/number-input.min.js"></script>
	<script>
		$(function() {
			$('.expire_date').pickadate({
				format: 'mm/dd/yyyy'
			});
		});
	</script>
@endsection
