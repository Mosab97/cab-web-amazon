var token = document.head.querySelector('meta[name="csrf-token"]').content;

function deleteItem(itemId,route) {
      $("#modal_default").modal('show');
      $('#item').attr('item-id',itemId);
      $('#item').attr('route',route);
    }

    function deleteModal() {
      var newId=$('#item').attr('item-id');
      var route=$('#item').attr('route');
      $("#modal_default").modal('hide');
      $.ajax({
        url: route,
        method: "POST",
        dataType:"json",
        data:{_token:token , _method:"delete"},
        success:function(data){
            if (data['value'] == 1) {
              $("."+newId).fadeOut('slow',function(){
                $(this).remove();
              });
            }else if (data['value'] == 0) {
                  toastr.error(data['message'], '', { "progressBar": true });
             }
            if (data['count'] != 'undefined') {
                $(".reply_count").text(data['count']);
            }
          }
        }).fail(function(data) {
            if (data.responseJSON != 'undefined') {
                $.each(data.responseJSON.errors, function(index, val) {
                    toastr.error(val, '', {
                        "progressBar": true
                    });
                });
            }
        });
    }

function notify(itemId,route,user_type) {
  $("#modal_notify").modal('show');
  $('#modal_notify #item').attr('item-id',itemId);
  $('#modal_notify #item').attr('route',route);
  $('#modal_notify #item').attr('user-type',user_type);
}

function editModal() {
    var userId=$('#modal_notify #item').attr('item-id');
    var route=$('#modal_notify #item').attr('route');
    var user_type=$('#modal_notify #item').attr('user-type');
    var title =$('#modal_notify input[name=title]').val();
    var status =$('#modal_notify input[name=status]').val();
    var body =$('#modal_notify textarea[name=body]').val();
    var clients = [];
    var checkboxes = document.querySelectorAll('input[class=check_list]:checked');
    for (var i = 0; i < checkboxes.length; i++) {
      clients.push(checkboxes[i].value)
    }
    // var send_type =$('#modal_notify input[name=send_type]:checked').val();
    $('#modal_notify textarea[name=body]').val('');
    $('#modal_notify input[name=title]').val('');
    $("#modal_notify").modal('hide');
    $.ajax({
      url: route,
      method: "POST",
      dataType:"json",
      data:{user_id:userId,body:body,status:status,title:title,user_type:user_type,_token:token,user_list: clients},
      success:function(data){
          if (data['value'] == 1) {
              if (clients.length > 0) {
                  clients = [];
                  $('.select_all_rows').prop('checked',false);
                  $(".datatable-new-ajax").dataTable().fnDestroy();
                  getData();
              }
             toastr.success(data['body'], '', { "progressBar": true });
           }else{
              toastr.error(data['body'], '', { "progressBar": true });
           }
        }
      }).fail(function(data) {
          console.log(data);
          $.each(data.responseJSON.errors, function(index, val) {
              toastr.error(val, '', {
                  "progressBar": true
              });
          });
      });
}

function printDiv(el){
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
}

function readUrl(target,className = 'image-preview'){
    if (target.files && target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.'+className).attr('src', e.target.result);
        }
        reader.readAsDataURL(target.files[0]);
    }
};

function clock(months, days) {
    // Create two variable with the names of the months and days in an array
    // var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
    var monthNames = months;
    // var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    var dayNames= days;

    // Create a newDate() object
    var newDate = new Date();
    // Extract the current date from Date object
    newDate.setDate(newDate.getDate());
    // Output the day, date, month and year
    $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

    setInterval( function() {
            // Create a newDate() object and extract the seconds of the current time on the visitor's
            var seconds = new Date().getSeconds();
            // Add a leading zero to seconds value
            $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
        },1000
    );

    setInterval( function() {
            // Create a newDate() object and extract the minutes of the current time on the visitor's
            var minutes = new Date().getMinutes();
            // Add a leading zero to the minutes value
            $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
        },1000
    );

    setInterval( function() {
            // Create a newDate() object and extract the hours of the current time on the visitor's
            var hours = new Date().getHours();
            // Add a leading zero to the hours value
            $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
        }, 1000
    );
}
