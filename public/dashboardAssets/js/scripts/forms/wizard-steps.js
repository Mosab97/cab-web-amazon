/*=========================================================================================
    File Name: wizard-steps.js
    Description: wizard steps page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// Wizard tabs with numbers setup
$(".number-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Wizard tabs with icons setup
$(".icons-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Validate steps wizard

// Show form
var form = $(".steps-validation").show();
var locale = $(".steps-validation").data('locale');

var finishLable = (locale == 'en' ? 'Submit' : 'حفظ');
var previousLable = (locale == 'en' ? 'Previous' : 'السابق');
var nextLable = (locale == 'en' ? 'Next' : 'التالي');

$(".steps-validation").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: finishLable,
        previous: previousLable,
        next: nextLable,
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }

        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        // alert("Submitted!");
        $('a[href="#finish"]').html(`<div class="spinner-border text-danger spinner-border-sm spinner-grow-sm" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
                $('a[href="#finish"]').attr('disabled','disabled');
                $.ajax({
                    url : $(this).attr('action'),
                    type : $(this).attr('method'),
                    dateType  : 'JSON',
                    global : false,
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                })
                .done(function(){
                    $('a[href="#finish"]').text(finishLable);
                    $('a[href="#finish"]').removeAttr('disabled');
                    $('.steps-validation').submit();
                })
                .fail(function(data){
                    $('a[href="#finish"]').text(finishLable);
                    $('a[href="#finish"]').removeAttr('disabled');
                    $('.steps-validation').find('span.text-danger').remove();
                    $('.steps-validation').find('.border-danger').removeClass('border-danger');
                    $.each(data.responseJSON.errors,function(index,val){


                        toastr.error(val[0], '', { "progressBar": true });

                        var name_arr = index.split('.');
                        if (name_arr.length > 1) {
                            name = name_arr[0]+"["+name_arr[1]+"]";
                        }else{
                            name = name_arr[0];
                        }
                        if (name == 'gender') {
                            $('input[name="'+name+'"]').parents('label').after(`<span class="text-danger">${val[0]}</span>`)
                        }else{
                            $('input[name="'+name+'"]').after(`<span class="text-danger">${val[0]}</span>`);
                            $('select[name^="'+name+'"]').after(`<span class="text-danger">${val[0]}</span>`);
                            $('textarea[name="'+name+'"]').after(`<span class="text-danger">${val[0]}</span>`);
                        }

                        $('input[name="'+name+'"]').addClass('border-danger');
                        $('select[name^="'+name+'"]').addClass('border-danger');
                        $('textarea[name="'+name+'"]').addClass('border-danger');
                    })
                })
        // $(this).submit();
    }
});

// Initialize validation
$(".steps-validation").validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'danger',
    successClass: 'success',
    highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    rules: {
        email: {
            email: true
        }
    }
});
