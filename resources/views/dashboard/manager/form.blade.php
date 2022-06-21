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
	<div class="col-lg-10">
		{!! Form::number('phone', null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.general.phone')]) !!}
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

<div class="form-group row">
	<label class="label-control col-md-2">{{ trans('dashboard.role.role') }} <span class="text-danger">*</span></label>
	<div class="col-md-10">
		{!! Form::select("role_id",$roles, null, ['class' => 'select2 form-control' , 'data-placeholder' => trans('dashboard.role.role')]) !!}
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
			@if (isset($manager) && $manager->image)
			<img src="{{ $manager->avatar }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
			@else
			<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
			@endif
		</div>

	</div>
</div>

<div class="form-group row">
	<label class="col-form-label col-lg-2">{{ trans('dashboard.user.gender') }} <span class="text-danger">*</span></label>
	<div class="col-md-10">
		<div class="row">
			<div class="vs-radio-con vs-radio-success col-md-7">
				{!! Form::radio('gender', "male", isset($manager) && $manager->gender == 'male' ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.male') }}</span>

			</div>
			<div class="vs-radio-con vs-radio-success">
				{!! Form::radio('gender', "female", isset($manager) && $manager->gender == 'female' ? 'checked' : null) !!}
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
				{!! Form::radio('is_active', 1, isset($manager) && $manager->is_active ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.active') }}</span>

			</div>
			<div class="vs-radio-con vs-radio-success">
				{!! Form::radio('is_active', 0, isset($manager) && ! $manager->is_active ? 'checked' : null) !!}
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
				{!! Form::radio('is_ban', 1, isset($manager) && $manager->is_ban ? 'checked' : null) !!}
				<span class="vs-radio">
					<span class="vs-radio--border"></span>
					<span class="vs-radio--circle"></span>
				</span>
				<span class="">{{ trans('dashboard.user.ban') }}</span>
			</div>
			<div class="vs-radio-con vs-radio-success">
				{!! Form::radio('is_ban', 0, isset($manager) && ! $manager->is_ban ? 'checked' : null) !!}
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

<div class="text-right">
	<button type="submit" class="btn btn-primary">{{ $btnSubmit }} <i class="icon-paperplane ml-2"></i></button>
</div>

@push('parent')
<a href="{{ route('dashboard.manager.index') }}" class="breadcrumb-item"> {{ trans('dashboard.manager.managers') }}</a>
@endpush
@section('current',$current)

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
