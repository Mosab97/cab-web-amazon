@foreach (config('translatable.locales') as $locale)
<h6><i class="step-icon feather icon-flag"></i> {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.name') }} <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{!! Form::text($locale."[name]", isset($app_ad) ? $app_ad->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.name')]) !!}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.'.$locale.'.desc') }} </label>
			<div class="col-md-10">
				{!! Form::textarea($locale."[desc]", isset($app_ad) ? optional($app_ad->translate($locale))->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.'.$locale.'.desc')]) !!}
			</div>
		</div>
	</div>
</fieldset>
@endforeach
<h6><i class="step-icon feather icon-settings"></i> {{ trans('dashboard.general.public_data') }}</h6>
<fieldset>
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.app_ad.start_at') }} </label>
			<div class="col-md-4">
				{!! Form::date("start_at", isset($app_ad) && $app_ad->start_at ? $app_ad->start_at->format("m/d/Y") : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.app_ad.start_at')])
				!!}
			</div>
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.app_ad.end_at') }} </label>
			<div class="col-md-4">
				{!! Form::date("end_at", isset($app_ad) && $app_ad->end_at ? $app_ad->end_at->format("m/d/Y") : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.app_ad.end_at')]) !!}
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-lg-2">{{ trans('dashboard.user.active_state') }}</label>
		<div class="col-md-10">
			<div class="row">
				<div class="vs-radio-con vs-radio-success col-md-7">
					{!! Form::radio('is_active', 1, isset($app_ad) && $app_ad->is_active ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.user.active') }}</span>

				</div>
				<div class="vs-radio-con vs-radio-success">
					{!! Form::radio('is_active', 0, isset($app_ad) && ! $app_ad->is_active ? 'checked' : null) !!}
					<span class="vs-radio">
						<span class="vs-radio--border"></span>
						<span class="vs-radio--circle"></span>
					</span>
					<span class="">{{ trans('dashboard.user.not_active') }}</span>
				</div>

			</div>
		</div>
	</div>

	{{-- <div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.app_ad.video_url') }} </label>
	<div class="col-md-10">
		{!! Form::text('video_url', null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.app_ad.video_url')]) !!}
	</div>
	</div>
	</div> --}}
	<div class="form-group">
		<div class="row">
			<label class="font-medium-1 col-md-2">{{ trans('dashboard.app_ad.video') }} </label>
			<div class="col-md-10">
				<div class="custom-file">
					{!! Form::file('video_url', ['class' => 'custom-file-input' , 'placeholder' => trans('dashboard.app_ad.video') , 'id' => "inputGroupFile02"]) !!}
					<label class="custom-file-label" for="inputGroupFile02">Choose file</label>
				</div>
			</div>
		</div>
	</div>
	@if (isset($app_ad) && $app_ad->video_url)
	<section id="media-player-wrapper">
		<div class="row">
			<div class="col-md-4 offset-md-8">
				<div class="card">
					{{-- <h6 class="card-title">{{ trans('dashboard.app_ad.video') }}</h6> --}}
					<!-- VIDEO -->
					<div class="video-player" id="plyr-video-player">
						<video controls style="width: 100%">
							<source src="{{ $app_ad->video_url }}" type="video/mp4" autostart="false">
						</video>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif

	<div class="form-group row">
		<label class="font-medium-1 col-lg-2">{{ trans('dashboard.ar.image') }}</label>
		<div class="col-md-9">
			<div class="custom-file">
				<input type="file" name="image_ar" class="custom-file-input" id="inputGroupFile01" onchange="readUrl(this,'image-ar-preview')">
				<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
			</div>
		</div>
		<div class="col-md-1">
			@if (isset($app_ad) && $app_ad->image_ar)
			<img src="{{ $app_ad->image_ar }}" class="img-thumbnail image-ar-preview" style="width: 100%; height: 100px;;">
			@else
			<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-ar-preview" style="width: 100%; height: 100px;">
			@endif
		</div>

	</div>
	<div class="form-group row">
		<label class="font-medium-1 col-lg-2">{{ trans('dashboard.en.image') }}</label>
		<div class="col-md-9">
			<div class="custom-file">
				<input type="file" name="image_en" class="custom-file-input" id="inputGroupFile02" onchange="readUrl(this,'image-en-preview')">
				<label class="custom-file-label" for="inputGroupFile02">Choose file</label>
			</div>
		</div>
		<div class="col-md-1">
			@if (isset($app_ad) && $app_ad->image_en)
			<img src="{{ $app_ad->image_en }}" class="img-thumbnail image-en-preview" style="width: 100%; height: 100px;;">
			@else
			<img src="{{ asset('dashboardAssets/images/backgrounds/placeholder_image.png') }}" class="img-thumbnail image-en-preview" style="width: 100%; height: 100px;">
			@endif
		</div>

	</div>
</fieldset>

@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/extensions/plyr.css">
@endsection

@section('page_styles')
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/forms/wizard.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/extensions/media-plyr.css">
@endsection

@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/media/plyr.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/media/plyr.polyfilled.js"></script>
@endsection

@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/wizard-steps.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/extensions/media-plyr.js"></script>
<script>
	$(function() {
		$('.expire_date').pickadate({
			format: 'mm/dd/yyyy'
		});
	});
</script>
@endsection
