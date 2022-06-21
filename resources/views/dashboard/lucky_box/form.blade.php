
@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($lucky_box) ? $lucky_box->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($lucky_box) ? optional($lucky_box->translate($locale))->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset>

	<div class="form-group row mt-2">
		<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }}</label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-7">
					{!! Form::radio('is_active', 1, isset($lucky_box) && $lucky_box->is_active ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.user.active') }}</span>

				</div>
				<div class="vs-radio-con vs-radio-success">
					{!! Form::radio('is_active', 0, isset($lucky_box) && ! $lucky_box->is_active ? 'checked' : null) !!}
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
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.lucky_box.start_at') }} </label>
			<div class="col-md-4">
				{!! Form::date("start_at", isset($lucky_box) && $lucky_box->start_at ?$lucky_box->start_at : date("m/d/Y") , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.lucky_box.start_at')])
				!!}
			</div>
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.lucky_box.end_at') }} </label>
			<div class="col-md-4">
				{!! Form::date("end_at", isset($lucky_box) && $lucky_box->end_at ? $lucky_box->end_at : date("m/d/Y") , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.lucky_box.end_at')]) !!}
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="control-label col-lg-2">
			@lang('dashboard.lucky_box.user_type')
		</label>
		<div class="vs-radio-con vs-radio-success col-md-4">
			{!! Form::radio('user_type', "client" ,'checked') !!}
			<span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
			<span class="">{{ trans('dashboard.lucky_box.user_types.client') }}</span>

		</div>
		<div class="vs-radio-con vs-radio-success col-md-4">
			{!! Form::radio('user_type', "driver") !!}
			<span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
			<span class="">{{ trans('dashboard.lucky_box.user_types.driver') }}</span>

		</div>
		<div class="vs-radio-con vs-radio-success">
			{!! Form::radio('user_type', "client_and_driver") !!}
			<span class="vs-radio">
				<span class="vs-radio--border"></span>
				<span class="vs-radio--circle"></span>
			</span>
			<span class="">{{ trans('dashboard.lucky_box.user_types.client_and_driver') }}</span>
		</div>
	</div>

	<div class="form-group row mt-2">
		<label class="col-form-label col-lg-2">{{ trans('dashboard.lucky_box.gift_type') }}</label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-4">
					{!! Form::radio('gift_type', 'balance', isset($lucky_box) && $lucky_box->gift_type == 'balance' ? 'checked' : null,['onchange' => 'setGiftType(this.value)']) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.lucky_box.gift_types.balance') }}</span>

				</div>
				<div class="vs-radio-con vs-radio-success col-md-4">
					{!! Form::radio('gift_type', 'points', isset($lucky_box) && ! $lucky_box->gift_type == 'points' ? 'checked' : null,['onchange' => 'setGiftType(this.value)']) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.lucky_box.gift_types.points') }}</span>
				</div>
				<div class="vs-radio-con vs-radio-success">
					{!! Form::radio('gift_type', 'other', isset($lucky_box) && ! $lucky_box->gift_type == 'other' ? 'checked' : null,['onchange' => 'setGiftType(this.value)']) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.lucky_box.gift_types.other') }}</span>
				</div>

			</div>
		</div>
	</div>

	<div class="gift_type">
		@if (isset($lucky_box) && $lucky_box->gift_type == 'points')
		<div class="form-group">
		    <div class="row">
		        <label class="font-medium-1 col-md-2">{{ trans('dashboard.lucky_box.points') }}</label>
		        <div class="col-md-10">
		            <div class="input-group input-group-lg" style="width: 100%;">
		                {!! Form::text('points', null , ['class' => "touchspin"]) !!}
		            </div>
		        </div>
		    </div>
		</div>
	@elseif (isset($lucky_box) && $lucky_box->gift_type == 'balance')
		<div class="form-group">
		    <div class="row">
				<label class="font-medium-1 col-md-2">{{ trans('dashboard.lucky_box.balance') }}</label>
		        <div class="col-md-10">
		            <div class="input-group input-group-lg" style="width: 100%;">
		                {!! Form::text('balance', null , ['class' => "touchspin" ,'data-bts-step' => "0.1" ,'data-bts-decimals' => "2"]) !!}
		            </div>
		        </div>
		    </div>
		</div>
		@endif
	</div>

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
				@if (isset($lucky_box) && $lucky_box->image)
					<img src="{{ $lucky_box->image }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
				@else
					<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
				@endif
			</div>
		</div>
	</div>
</fieldset>

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

	function setGiftType(gift_type) {
		var gift_html = '';
		if (gift_type == 'points') {
			gift_html = `<div class="form-group">
			    <div class="row">
			        <label class="font-medium-1 col-md-2">{{ trans('dashboard.lucky_box.points') }}</label>
			        <div class="col-md-10">
			            <div class="input-group input-group-lg" style="width: 100%;">
			                {!! Form::text('points', null , ['class' => "touchspin"]) !!}
			            </div>
			        </div>
			    </div>
			</div>`;
		} else if(gift_type == 'balance'){
			gift_html = `<div class="form-group">
			    <div class="row">
					<label class="font-medium-1 col-md-2">{{ trans('dashboard.lucky_box.balance') }}</label>
			        <div class="col-md-10">
			            <div class="input-group input-group-lg" style="width: 100%;">
			                {!! Form::text('balance', null , ['class' => "touchspin" ,'data-bts-step' => "0.1" ,'data-bts-decimals' => "2"]) !!}
			            </div>
			        </div>
			    </div>
			</div>`;
		}

		$('.gift_type').html(gift_html);
		$('.touchspin').TouchSpin()
	}
</script>
@endsection
