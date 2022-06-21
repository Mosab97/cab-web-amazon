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
        method: "DELETE",
        dataType:"json",
        data:{_token:token},
        success:function(data){
            if (data['value'] == 1) {
              $("."+newId).fadeOut('slow',function(){
                $(this).remove();
              });
            }
            if (data['count'] != 'undefined') {
                $(".reply_count").text(data['count']);
            }
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
    var body =$('#modal_notify textarea[name=body]').val();
    $('#modal_notify textarea[name=body]').val('');
    $('#modal_notify input[name=title]').val('');
    $("#modal_notify").modal('hide');
    $.ajax({
      url: route,
      method: "POST",
      dataType:"json",
      data:{user_id:userId,body:body,title:title,user_type:user_type,_token:token},
      success:function(data){
         if (data['value'] == 1) {
            new Noty({
                  text: data['body'],
                  type: 'success',
                  timeout: 6000,
              }).show();
          }else{
            new Noty({
                text: data['body'],
                type: 'error',
                timeout: 6000,
            }).show();
          }
        }
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
