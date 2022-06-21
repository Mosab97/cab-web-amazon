<script>
$(function(){
    var message_page = 1;
    var last_message_page = "{{ isset($messages) ? $messages->lastPage() : 0 }}";
    $('.scrolled_div').scrollTop($('.scrolled_div').prop('scrollHeight'));
    $('.scrolled_div').on('scroll',function() {
        if($('.scrolled_div').scrollTop() == 0 && message_page <= last_message_page) {
            message_page++;
            loadMoreData(message_page,'.ajax-message-load',".chat_list",'.ajax-message-load');
        }
    });


});



function loadMoreData(page,ajax_load,place,li_place){
  $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            global:false,
            beforeSend: function()
            {
                setTimeout(function() {
                    $(ajax_load).show();
                }, 4000);
				$(ajax_load).hide();
            }
        })
        .done(function(data)
        {
            if(data.view == ""){
                $(ajax_load).html("No more records found");
                return;
            }
            $(ajax_load).hide();
            setDataPosition(place,li_place,data)
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('server not responding...');
        });
}
    function setDataPosition(place,li_place,data){
            $(place).find(li_place).after(data.view);
            $(place).scrollTop(30);
            $(place).find(li_place).hide();

    }


</script>
