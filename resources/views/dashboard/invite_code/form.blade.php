<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }} <span class="text-danger">*</span></label>
	<div class="col-md-10">
		<div class="row">
			<div class="vs-radio-con vs-radio-success col-md-6 col-xs-12">
				{!! Form::radio('is_active', "1", isset($invite_code) && $invite_code->is_active ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.active') }}</span>
			</div>
			<div class="vs-radio-con vs-radio-success col-md-4 col-xs-12">
				{!! Form::radio('is_active', "0", isset($invite_code) && !$invite_code->is_active ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.not_active') }}</span>
			</div>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.point_package.points') }} </label>
		<div class="col-md-10">
			<div class="input-group input-group-lg" style="width: 100%;">
				{!! Form::text('points', null , ['class' => "touchspin", 'init-val' => null ]) !!}
			</div>
		</div>
	</div>
</div>

<div class="form-group row mt-4">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.invite_code.invite_code') }} <span class="text-danger">*</span></label>
	<div class="col-lg-10">
		<div class="position-relative has-icon-left input-divider-left {{ isset($invite_code) && $invite_code->code ? 'form-group' : 'input-group form-group' }}">
			{!! Form::text('code', null ,['class' => 'form-control', isset($invite_code) && $invite_code->code ? 'readonly' : '' ,'aria-describedby' => "button-addon2" , 'placeholder' => trans('dashboard.invite_code.invite_code')]) !!}
			<div class="form-control-position">
				<i class="feather icon-hash"></i>
			</div>
			@if(!isset($invite_code))
			<div class="input-group-append" id="button-addon2">
				<a class="btn btn-primary text-white" onclick="generateCode()">Auto</a>
			</div>
			@endif
		</div>
	</div>
</div>

<div class="text-right">
	<button type="submit" class="btn btn-primary">{{ $btnSubmit }} </button>
</div>

@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
@endsection

@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/number-input.min.js"></script>

@if (!isset($invite_code))
<script>
	function generateCode() {
		$("input[name=code]").load("{{ LaravelLocalization::localizeUrl('dashboard/ajax/generate_code') }}/7/letter/GeneralInviteCode", function(text) {
			$(this).val(text);
		});
	}
</script>
@endif
@endsection
