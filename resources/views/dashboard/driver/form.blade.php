
	<div class="form-group row">
		<label class="col-form-label col-lg-2">{{ trans('dashboard.user.username') }} <span class="text-danger">*</span></label>
		<div class="col-lg-4">
			{!! Form::text('fullname', null , ['class' => 'form-control' , 'placeholder' => trans('dashboard.user.username')]) !!}
		</div>
		<label class="col-form-label col-lg-2">{{ trans('dashboard.general.phone') }} <span class="text-danger">*</span></label>
		<div class="col-lg-4">
			{!! Form::text('phone', null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.general.phone')]) !!}
		</div>

	</div>
	<div class="form-group row">
		<label class="col-form-label col-lg-2">
			{{ trans('dashboard.general.email') }}
		</label>
		<div class="col-lg-4">
			{!! Form::email('email', null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.general.email')]) !!}
		</div>
		<label class="col-form-label col-lg-2">{{ trans('dashboard.user.identity_number') }} </label>
		<div class="col-lg-4">
			{!! Form::text('identity_number', null, ['class' => 'form-control' , 'autocomplete' => false , 'placeholder' => trans('dashboard.user.identity_number')]) !!}
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
		<label class="col-form-label col-lg-2">{{ trans('dashboard.driver.date_of_birth') }} <span class="text-danger">*</span></label>
		<div class="col-lg-4">
			{!! Form::text('date_of_birth',isset($driver) && $driver->date_of_birth ? $driver->date_of_birth->format("d-m-Y") : now()->subYears(18)->format("d-m-Y") , ['class' => 'form-control date_of_birth' , 'placeholder' => trans('dashboard.driver.date_of_birth')]) !!}
		</div>
		<label class="col-form-label col-lg-2">{{ trans('dashboard.driver.date_of_birth_hijri') }} <span class="text-danger">*</span></label>
		<div class="col-lg-4">
			{!! Form::text('date_of_birth_hijri', null,['class' => 'form-control date_of_birth_hijri' , 'placeholder' => trans('dashboard.driver.date_of_birth_hijri')]) !!}
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
				@if (isset($driver) && $driver->image)
				<img src="{{ $driver->avatar }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
				@else
				<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">
				@endif
			</div>

		</div>
	</div>


	<div class="form-group row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.country.nationality') }} </label>
		<div class="col-md-10">
			{!! Form::select("country_id",$countries, isset($driver) && $driver->profile->country_id ? $driver->profile->country_id :null, ['class' => 'select2 form-control' , 'placeholder' =>
			trans('dashboard.country.nationality')]) !!}
		</div>
	</div>

	<div class="form-group row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.city.city') }} </label>
		<div class="col-md-10">
			{!! Form::select("city_id",$cities, isset($driver) && $driver->profile->city_id ? $driver->profile->city_id :null, ['class' => 'select2 form-control' , 'placeholder' => trans('dashboard.city.city')]) !!}
		</div>
	</div>

	<div class="form-group row">
		<label class="font-medium-1 col-md-2">{{ trans('dashboard.car.car') }} <span class="text-danger">*</span></label>
		<div class="col-md-10">
			<select class="select2 form-control select-remote-car-ajax" name="car_id" style="width:100%;" data-placeholder="{{ trans('dashboard.car.car') }}">
				<option></option>
				{{-- @foreach ($cars as $car) --}}
				<option value="{{ @$driver->car->id }}" selected data-image="{{ @$driver->car->car_front_image }}">{{ optional(@$driver->car->carModel)->name }} - {{ optional(@$driver->car->carType)->name }}</option>
				{{-- @endforeach --}}
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }}</label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-7">
					{!! Form::radio('is_active', 1, isset($driver) && $driver->is_active ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.user.active') }}</span>

				</div>
				<div class="vs-radio-con vs-radio-success">
					{!! Form::radio('is_active', 0, isset($driver) && ! $driver->is_active ? 'checked' : null) !!}
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
		<label class="col-form-label col-lg-2">{{ trans('dashboard.driver.admin_accept_status') }}</label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-7">
					{!! Form::radio('is_admin_accept', 1, isset($driver) && optional($driver->driver)->is_admin_accept ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.driver.accepted') }}</span>

				</div>
				<div class="vs-radio-con vs-radio-success">
					{!! Form::radio('is_admin_accept', 0, isset($driver) && ! optional($driver->driver)->is_admin_accept ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.driver.not_accepted') }}</span>
				</div>

			</div>
		</div>
	</div>
	{{-- @if (auth()->user()->email == 'developer@info.com') --}}
		<div class="form-group row">
			<label class="col-form-label col-lg-2">{{ trans('dashboard.driver.available_status') }}</label>
			<div class="col-md-10">
				<div class="row">
					<div class="vs-radio-con vs-radio-success col-md-7">
						{!! Form::radio('is_available', 1, isset($driver) && optional($driver->driver)->is_available ? 'checked' : null) !!}
						<span class="vs-radio">
							<span class="vs-radio--border"></span>
							<span class="vs-radio--circle"></span>
						</span>
						<span class="">{{ trans('dashboard.driver.available') }}</span>

					</div>
					<div class="vs-radio-con vs-radio-success">
						{!! Form::radio('is_available', 0, isset($driver) && ! optional($driver->driver)->is_available ? 'checked' : null) !!}
						<span class="vs-radio">
							<span class="vs-radio--border"></span>
							<span class="vs-radio--circle"></span>
						</span>
						<span class="">{{ trans('dashboard.driver.not_available') }}</span>
					</div>

				</div>
			</div>
		</div>

	{{-- @endif --}}

	<div class="form-group row">
		<label class="col-form-label col-lg-2">{{ trans('dashboard.user.ban_state') }}</label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-7">
					{!! Form::radio('is_ban', 1, isset($driver) && $driver->is_ban ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.user.ban') }}</span>
				</div>
				<div class="vs-radio-con vs-radio-success">
					{!! Form::radio('is_ban', 0, isset($driver) && ! $driver->is_ban ? 'checked' : null) !!}
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
		<button type="submit" class="btn btn-primary">{{ $btnSubmit }}</button>
	</div>


@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/select/select2.min.css">
@endsection
@section('page_styles')
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/forms/wizard.css">

<link href="{{ asset('dashboardAssets') }}/global/css/custom/bootstrap-datetimepicker.min.css" rel="stylesheet">
<style media="screen">
    .select2-selection__rendered {
        line-height: 30px !important;
    }

    .select2-container .select2-selection--single {
        height: 44px !important;
    }

    .select2-selection__arrow {
        height: 42px !important;
    }
</style>
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/select/select2.full.min.js"></script>
@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/wizard-steps.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{ asset('dashboardAssets') }}/global/js/custom/hijri/momentjs.js"></script>
<script src="{{ asset('dashboardAssets') }}/global/js/custom/hijri/moment-with-locales.js"></script>
<script src="{{ asset('dashboardAssets') }}/global/js/custom/hijri/moment-hijri.js"></script>
<script src="{{ asset('dashboardAssets') }}/global/js/custom/hijri/bootstrap-hijri-datetimepicker.js"></script>
<script>

$(function(){
	$(".date_of_birth_hijri").hijriDatePicker({
		hijri:true,
		showSwitcher:false

	});

	$(".date_of_birth").hijriDatePicker({
		hijri:false,
		maxDate:"{{ now()->subYears(18)->format("Y-m-d") }}",
		format: "DD-MM-YYYY",
		showSwitcher:false

	});

	// Initialize
$('.select-remote-car-ajax').select2({
	ajax: {
		url: '{{ LaravelLocalization::localizeUrl('dashboard/ajax/get_car_search') }}',
		dataType: 'json',
		delay: 250,
		global:false,
		data: function(params) {
			return {
				keyword: params.term, // search term
				page: params.page || 1
			};
		},

		processResults: function(data, params) {
			if (data['value'] == 0 ) {
				toastr.error(data['message'], '', { "progressBar": true });
				return;
			}
			// parse the results into the format expected by Select2
			// since we are using custom formatting functions we do not need to
			// alter the remote JSON data, except to indicate that infinite
			// scrolling can be used
			params.page = params.page || 1;
			var new_data = $.map(data.data, function (obj) {
				  obj.text = obj.name || obj.plate_number;
				  return obj;
				});
			return {
				results: new_data,
				pagination: {
					more: (params.page * data.per_page) < data.total
				}
			};
		},
		cache: true
	},

	escapeMarkup: function(markup) {
		return markup;
	}, // let our custom formatter work
	minimumInputLength: 1,
	width: 'resolve',
	allowClear: true,
	placeholder : '{{ trans('dashboard.car.car') }}',
	templateResult: formatState, // omitted for brevity, see the source of this page
	templateSelection: formatRepoAjaxSelection, // omitted for brevity, see the source of this page

});

// Format displayed data
function formatRepoAjax(repo) {
if (repo.loading) return repo.text;

var markup = '<div class="select2-result-repository clearfix">' +
	'<div class="select2-result-repository__meta">' +
	'<div class="select2-result-repository__title">' + repo.text + '</div></div></div>';

return markup;
}

// Format selection
function formatRepoAjaxSelection(repo) {
return repo.text || repo.phone;
}



	$(".car_select").select2({
		width: 'resolve',
		allowClear: true,
		templateResult: formatState,
		templateSelection: formatState,
		placeholder : '{{ trans('dashboard.car.car') }}'
	});

	function formatState(opt) {
		if (!opt.id) {
			return opt.text.toUpperCase();
		}

		var optimage = opt.car_front_image;
		if (!optimage) {
			return opt.text.toUpperCase();
		} else {
			var $opt = $(
				'<span><img src="' + optimage + '" class="rounded-circle" style="width:30px; height:30px; margin-left: 5px;" /> ' + opt.text.toUpperCase() + '</span>'
			);
			return $opt;
		}
	};

})
</script>
@endsection
