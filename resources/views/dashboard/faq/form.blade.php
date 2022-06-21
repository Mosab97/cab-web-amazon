
@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($faq) ? $faq->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($faq) ? optional($faq->translate($locale))->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset class="form-group">

    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dashboard.faq.faq_state') }}</label>
        <div class="col-md-10">
            <div class="row">
                <div class="vs-radio-con vs-radio-success col-md-7">
                    {!! Form::radio('is_active', 1, isset($faq) && $faq->is_active ? 'checked' : null) !!}
                    <span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
                    <span class="">{{ trans('dashboard.faq.state.active') }}</span>

                </div>
                <div class="vs-radio-con vs-radio-success">
                    {!! Form::radio('is_active', 0, isset($faq) && ! $faq->is_active ? 'checked' : null) !!}
                    <span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
                    <span class="">{{ trans('dashboard.faq.state.in_active') }}</span>
                </div>

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
