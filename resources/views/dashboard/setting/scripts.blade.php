@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
@endsection
@section('page_styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<style media="screen">
	.bootstrap-tagsinput input {
		width: 70% !important;
	}

	body.dark-layout .card .note-toolbar,
	body.dark-layout .card .note-toolbar {
		color: #fff;
		background-color: #55565c;
	}

	.note-btn-group .note-btn {
		border-color: rgba(209, 110, 110, 0.2);
		padding: 0.50rem .75rem;
		font-size: 17px;
	}

	.note-btn-group .note-btn {
		color: #a412ff;
	}

	.note-btn-group .note-btn .note-current-fontname {
		font-family: 'Cairo';
		color: #a417fe;
	}

	.note-editor.note-airframe,
	.note-editor.note-frame {
		border: 1px solid ;
		border-color: #a417fe;
	}
	.note-resize button span{
		color: #a417fe;
	}
</style>
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/editors/quill/katex.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/editors/quill/highlight.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/editors/quill/quill.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/navs/navs.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/number-input.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/lang/summernote-ar-AR.min.js"></script>
<script>
	$('.editor').summernote({
		// airMode: true,
		tabsize: 10,
		height: 250,
		lang: "{{ app()->getLocale() == 'ar' ? 'ar-AR' : '' }}"
	});
</script>
@endsection
