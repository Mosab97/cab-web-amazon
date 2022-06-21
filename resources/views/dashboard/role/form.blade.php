@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} </label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($role) ? $role->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($role) ? $role->translate($locale)->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset>
	<div class="form-group d-flex justify-content-center">
		<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
			<input type="checkbox" onclick="toggle(this)" class="custom-control-input" id= "customSwitch_all"/>

			<label class="custom-control-label" for="customSwitch_all">
				<span class="switch-icon-left"><i class="feather icon-check"></i></span>
				<span class="switch-icon-right"><i class="feather icon-x"></i></span>
			</label>
			<label class="font-medium-1 ml-1" for="customSwitch_all">{{ trans('dashboard.general.check_all') }}</label>
		</div>
	</div>
	<div class="routes_div">
		@foreach ($routes as $route)
		@continue(in_array($route,$public_routes))
		<div class="form-group">
			<div class="row">
				<label class="font-medium-1 col-md-2">{{ $route == 'home' ? trans('dashboard.general.home') :trans('dashboard.'.$route.".".str_plural($route)) }} </label>
				<div class="col-md-10 d-flex justify-content-start flex-wrap">
					<div class="custom-control custom-switch custom-switch-success mr-2 mb-1 col-md-2 {{ $route == 'dashboard' ? 'offset-md-5' : '' }}">
						{!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".index", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".index")? true :false , ['class' =>
						'custom-control-input permissions','id' => "customSwitch_".$loop->index. "_". $route."_read"]) !!}

						<label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_read">
							<span class="switch-icon-left"><i class="feather icon-check"></i></span>
							<span class="switch-icon-right"><i class="feather icon-x"></i></span>
						</label>
						<label class="font-medium-1 ml-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_read">{{ trans('dashboard.general.read') }}</label>

					</div>
					@if ($route !='home')
					<div class="custom-control custom-switch custom-switch-success mr-2 mb-1 {{ in_array($route , ['driver' , 'client']) ? 'col-md-1' : 'col-md-2' }}">
						{!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".store", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".store")? true :false , ['class' => 'custom-control-input
						permissions','id' => "customSwitch_".$loop->index. "_". $route."_save"]) !!}

						<label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_save">
							<span class="switch-icon-left"><i class="feather icon-check"></i></span>
							<span class="switch-icon-right"><i class="feather icon-x"></i></span>
						</label>
						<label class="font-medium-1 ml-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_save">{{ trans('dashboard.general.save') }}</label>
					</div>
					<div class="custom-control custom-switch custom-switch-success mr-2 mb-1 {{ in_array($route , ['driver' , 'client']) ? 'col-md-1' : 'col-md-2' }}">
						{!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".update", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".update")? true :false , ['class' => 'custom-control-input
						permissions','id' => "customSwitch_".$loop->index. "_". $route."_edit"]) !!}

						<label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_edit">
							<span class="switch-icon-left"><i class="feather icon-check"></i></span>
							<span class="switch-icon-right"><i class="feather icon-x"></i></span>
						</label>
						<label class="font-medium-1 ml-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_edit">{{ trans('dashboard.general.edit') }}</label>
					</div>
					<div class="custom-control custom-switch custom-switch-success mr-2 mb-1 {{ in_array($route , ['driver' , 'client']) ? 'col-md-1' : 'col-md-2' }}">
						{!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".destroy", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".destroy")? true :false , ['class' =>
						'custom-control-input permissions','id' => "customSwitch_".$loop->index. "_". $route."_delete"]) !!}

						<label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_delete">
							<span class="switch-icon-left"><i class="feather icon-check"></i></span>
							<span class="switch-icon-right"><i class="feather icon-x"></i></span>
						</label>
						<label class="font-medium-1 ml-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_delete">{{ trans('dashboard.general.delete') }}</label>
					</div>
					@if (in_array($route , ['driver' , 'client']))
						<div class="custom-control custom-switch custom-switch-success mb-1 col-md-2">
							{!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".wallet", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".wallet")? true :false , ['class' =>
							'custom-control-input permissions','id' => "customSwitch_".$loop->index. "_". $route."_wallet"]) !!}

							<label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_wallet">
								<span class="switch-icon-left"><i class="feather icon-check"></i></span>
								<span class="switch-icon-right"><i class="feather icon-x"></i></span>
							</label>
							<label class="font-medium-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_wallet">{{ trans('dashboard.general.trans_wallet') }}</label>
						</div>

						<div class="custom-control custom-switch custom-switch-success mb-1 col-md-2">
							{!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".search_about_single_user", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".search_about_single_user")? true :false , ['class' =>
							'custom-control-input permissions','id' => "customSwitch_".$loop->index. "_". $route."_search_about_single_user"]) !!}

							<label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_search_about_single_user">
								<span class="switch-icon-left"><i class="feather icon-check"></i></span>
								<span class="switch-icon-right"><i class="feather icon-x"></i></span>
							</label>
							<label class="font-medium-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_search_about_single_user">{{ trans('dashboard.general.search_about_single_user') }}</label>
						</div>
						@if ($route == 'driver')
							<div class="custom-control custom-switch custom-switch-success mb-1 col-md-2">
								{!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".admin_accept_driver", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".admin_accept_driver")? true :false , ['class' =>
								'custom-control-input permissions','id' => "customSwitch_".$loop->index. "_". $route."_admin_accept_driver"]) !!}

								<label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_admin_accept_driver">
									<span class="switch-icon-left"><i class="feather icon-check"></i></span>
									<span class="switch-icon-right"><i class="feather icon-x"></i></span>
								</label>
								<label class="font-medium-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_admin_accept_driver">{{ trans('dashboard.general.admin_accept_driver') }}</label>
							</div>
						@endif
					@endif
					@endif
				</div>
			</div>
		</div>
		@endforeach
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

<script>
	function toggle(source) {
		checkboxes = document.getElementsByClassName('permissions');
		if (source.checked) {
			for (var i = 0, n = checkboxes.length; i < n; i++) {
				checkboxes[i].checked = source.checked;
			}
		} else {
			for (var i = 0, n = checkboxes.length; i < n; i++) {
				checkboxes[i].checked = source.checked;
			}
		}
	}
</script>
@endsection
