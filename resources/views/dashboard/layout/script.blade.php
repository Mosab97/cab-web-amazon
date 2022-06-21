


<script src="{{ asset('dashboardAssets') }}/vendors/js/vendors.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
@yield('vendor_scripts')

<!-- BEGIN: Theme JS-->
<script src="{{ asset('dashboardAssets') }}/js/core/app-menu.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/core/app.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/components.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/customizer.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/footer.min.js"></script>
<!-- END: Theme JS-->

<script src="{{ asset('dashboardAssets') }}/js/scripts/extensions/toastr.js"></script>
@yield('page_scripts')
<script src="{{ asset('dashboardAssets') }}/custom_assets/js/custom_scripts.js"></script>

<script src="{{ asset('dashboardAssets') }}/global/js/custom/easing.js"></script>

<script src="{{ asset('dashboardAssets') }}/global/js/custom/scripts.js"></script>
<script>
    $(function(){
        clock({!! json_encode(trans('dashboard.months')) !!}, {!! json_encode(trans('dashboard.days')) !!});
    });
</script>
<script src="{{ asset('dashboardAssets') }}/global/js/custom/higri_date.js"></script>
<script>
$(document).on({
    ajaxStart: function() { $("body").addClass("loading");},
    ajaxComplete: function() { $("body").removeClass("loading"); }
});

function getSearch(keyword,content_class) {
    $.ajax({
        url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/main_search') }}",
        method: "GET",
        dataType: "json",
        global:false,
        data:{query:keyword},
        success: function(data) {
            if (data['value'] == 1) {
                // $(content_class).show();
                $(content_class).html(data['view']);

            }
        }
    });
}

function CheckIfTempBalance() {
    $.ajax({
        url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/check_if_temp_balance') }}",
        method: "POST",
        dataType: "json",
        data: {_token: "{{ csrf_token() }}"},
        success: function(data) {
            if (data['value'] == 1) {
                toastr.success(data['message'], '', {
                    "progressBar": true
                });
            }
        }
    });
}

$(function(){
    var currentLayout = localStorage.getItem("caberz_currentLayout");
    if (currentLayout != null && currentLayout != 'dark-layout') {
        $("#layout-mode").html(`<i class="ficon feather icon-moon" onclick="changeMode()"></i>`);
    }else{
        $("#layout-mode").html(`<i class="ficon feather icon-sun" onclick="changeMode()"></i>`);
    }
});
function changeMode() {
    var layoutOptions = $("input[name=layoutOptions]:checked").data('layout');
    if (layoutOptions == 'dark-layout') {
        $("#light-layout-mode").click();
        localStorage.setItem("caberz_currentLayout", '');
        $("#layout-mode").html(`<i class="ficon feather icon-moon" onclick="changeMode()"></i>`);
    }else{
        $("#layout-mode").html(`<i class="ficon feather icon-sun" onclick="changeMode()"></i>`);
        localStorage.setItem("caberz_currentLayout", 'dark-layout');
        $("#dark-layout-mode").click();
    }
}


</script>
