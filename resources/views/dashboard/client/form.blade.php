<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.fullname') }} <span class="text-danger">*</span></label>
	<div class="col-lg-4">
		{!! Form::text('fullname', null , ['class' => 'form-control' , 'placeholder' => trans('dashboard.user.fullname')]) !!}
	</div>
	<label class="col-form-label col-lg-2">{{ trans('dashboard.general.email') }} <span class="text-danger">*</span></label>
	<div class="col-lg-4">
		{!! Form::email('email', null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.general.email')]) !!}
	</div>
</div>

<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.general.phone') }} <span class="text-danger">*</span></label>
	<div class="col-lg-4">
		{!! Form::text('phone', null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.general.phone')]) !!}
	</div>
	<label class="col-form-label col-lg-2">{{ trans('dashboard.general.whatsapp') }}</label>
	<div class="col-lg-4">
		{!! Form::text('whatsapp', null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.general.whatsapp')]) !!}
	</div>
</div>

<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.general.password') }} <span class="text-danger">*</span></label>
	<div class="col-lg-4">
		{!! Form::password('password', ['class' => 'form-control' , 'placeholder' => trans('dashboard.general.password')]) !!}
	</div>
	<label class="col-form-label col-lg-2">{{ trans('dashboard.general.password_confirmation') }} <span class="text-danger">*</span></label>
	<div class="col-lg-4">
		{!! Form::password('password_confirmation', ['class' => 'form-control' , 'placeholder' => trans('dashboard.general.password_confirmation')]) !!}
	</div>
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
			@if (isset($client) && $client->image)
			<img src="{{ $client->avatar }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
			@else
			<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
			@endif
		</div>

	</div>
</div>
{{-- <div class="form-group">
	<div class="row">
		<label class="font-medium-1 col-lg-2">{{ trans('dashboard.general.cover') }}</label>
		<div class="col-md-9">
			<div class="custom-file">
				<input type="file" name="cover" class="custom-file-input" id="inputGroupFile01" onchange="readUrl(this,'cover-preview')">
				<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
			</div>
		</div>
		<div class="col-md-1">
			@if (isset($client) && $client->cover)
			<img src="{{ $client->cover_image }}" class="img-thumbnail cover-preview" style="width: 100%; height: 100px;;">
			@else
			<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail cover-preview" style="width: 100%; height: 100px;">
			@endif
		</div>

	</div>
</div> --}}

<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.gender') }} <span class="text-danger">*</span></label>
	<div class="col-md-10">
		<div class="row">
			<div class="vs-radio-con vs-radio-success col-md-7">
				{!! Form::radio('gender', "male", isset($client) && $client->gender == 'male' ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.male') }}</span>

			</div>
			<div class="vs-radio-con vs-radio-success">
				{!! Form::radio('gender', "female", isset($client) && $client->gender == 'female' ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.female') }}</span>
			</div>
		</div>
	</div>
</div>

<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }}</label>
	<div class="col-md-10">
		<div class="row">
			<div class="vs-radio-con vs-radio-success col-md-7">
				{!! Form::radio('is_active', 1, isset($client) && $client->is_active ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.active') }}</span>

			</div>
			<div class="vs-radio-con vs-radio-success">
				{!! Form::radio('is_active', 0, isset($client) && ! $client->is_active ? 'checked' : null) !!}
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
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.ban_state') }}</label>
	<div class="col-md-10">
		<div class="row">
			<div class="vs-radio-con vs-radio-success col-md-7">
				{!! Form::radio('is_ban', 1, isset($client) && $client->is_ban ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.ban') }}</span>
			</div>
			<div class="vs-radio-con vs-radio-success">
				{!! Form::radio('is_ban', 0, isset($client) && ! $client->is_ban ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.not_ban') }}</span>
			</div>

		</div>
	</div>
</div>

<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.ban_reason') }}</label>
	<div class="col-lg-10">
		{!! Form::textarea('ban_reason', null , ['class' => 'form-control' , 'placeholder' => trans('dashboard.user.ban_reason')]) !!}
	</div>
</div>

<div class="form-group row">
	<label class="font-medium-1 col-md-2">{{ trans('dashboard.country.nationality') }} </label>
	<div class="col-md-10">
		{!! Form::select("country_id",$countries, isset($client) && optional($client->profile)->country_id ? $client->profile->country_id :null, ['class' => 'select2 form-control' , 'placeholder' => trans('dashboard.country.nationality')]) !!}
	</div>
</div>

<div class="form-group row">
	<label class="font-medium-1 col-md-2">{{ trans('dashboard.city.city') }} </label>
	<div class="col-md-10">
		{!! Form::select("city_id",$cities, isset($client) && optional($client->profile)->city_id ? $client->profile->city_id :null, ['class' => 'select2 form-control' , 'placeholder' => trans('dashboard.city.city')]) !!}
	</div>
</div>

<div class="text-right">
	<button type="submit" class="btn btn-primary">{{ $btnSubmit }} <i class="icon-paperplane ml-2"></i></button>
</div>


@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/select/select2.min.css">
@endsection
@section('page_styles')
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/forms/wizard.css">
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/select/select2.full.min.js"></script>
@endsection
@section('page_scripts')

<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/select/form-select2.js"></script>
@endsection
