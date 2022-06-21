
window.connectToChat = function (chat_id) {

     window.Echo.private(`caberz-chat.${chat_id}`)
        .listen('.NewMessage', (e) => {
            var div = $('.chat_list');
            div.find('.no_message').remove();
            var scrolled_div = $('.scrolled_div');
            // $('.dashboard_li').hide();
            // console.log(e);

                var dashboard_html =  `
                ${(() => {
                    if (e.sender_data.id != window.Data.order_client_id) {
                        var content_html = `<div class="chat">
                                <div class="chat-avatar">
                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                    <img src="${ e.sender_data.image }" alt="avatar" height="40" width="40" />
                                </a>
                            </div>
                            `;
                            content_html += `
                            <div class="chat-body">
                            ${(() => {
                                if (e.message_type == 'image'){
                                    return `<a href="${ e.message }" data-fancybox="gallery">
                                        <img src="${ e.message }" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: left;margin-left: 18px;">
                                    </a>`
                                    }else if (e.message_type == 'location'){
                                    return `<div class="chat-content-media">
                                                <a href="//www.google.com/maps/place/${ e.message }" target="_blank">
                                                    <img src="${ e.location_img }" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: left;margin-left: 18px;">
                                                </a>
                                            </div>`;
                                    }else{
                                    return `<div class="chat-content">
                                                <p style="font-size: 1.1em;">${ e.message }</p>
                                            </div>`
                                    }
                              })()}
                              </div>`;

                    }else{
                        var content_html = `<div class="chat chat-left">
                            <div class="chat-avatar">
                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                    <img src="${ e.sender_data.image }" alt="avatar" height="40" width="40" />
                                </a>
                            </div>`;
                         content_html +=`
                         <div class="chat-body">
                         ${(() => {
                             if (e.message_type == 'image'){
                                 return `<a href="${ e.message }" data-fancybox="gallery">
                                     <img src="${ e.message }" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: right;margin-right: 18px;">
                                 </a>`
                                 }else if (e.message_type == 'location'){
                                 return `<div class="chat-content-media">
                                             <a href="//www.google.com/maps/place/${ e.message }" target="_blank">
                                                 <img src="${ e.location_img }" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: right;margin-right: 18px;">
                                             </a>
                                         </div>`;
                                 }else{
                                 return `<div class="chat-content">
                                             <p style="color: #0d4e79; font-size: 1.1em;">${ e.message }</p>
                                         </div>`
                                 }
                           })()}
                           </div>`
                    }
                    return content_html;
                    })()}`;
            // console.log(e.sender_data , dashboard_html);
            div.find('.typing-part').before(dashboard_html);
            scrolled_div.scrollTop(scrolled_div.prop('scrollHeight'));
        })
 }
 // Check Online
 window.Echo.join(`online`)
             .here((users) => {
                 // console.log(users);
                 var here_drivers_count = 0;
                 var here_admins_count = 0;
                 var here_clients_count = 0;
                 // console.log(users.length);
                 users.forEach((user, i) => {
                     $(`#online_${user.id}`).removeClass(`avatar-status-busy`);
                     $(`#online_${user.id}`).addClass(`avatar-status-online`);
                     // console.log(user.facility_list,user.user_type);
                     if (['admin','superadmin'].includes(user.user_type)){
                         if (user.id != window.Data.user_id) {
                             here_admins_count++;
                         }
                     }else if(user.user_type == 'driver') {
                          here_drivers_count++;
                     }else if(user.user_type == 'client') {
                          here_clients_count++;
                     }
                 });
                 $(`#online_drivers`).text(here_drivers_count);
                 $(`#online_admins`).text(here_admins_count);
                 $(`#online_clients`).text(here_clients_count);

             })
         .joining((user) => {
             // console.log(user);
             var driver_onlines = parseInt($(`#online_drivers`).text());
             var client_onlines = parseInt($(`#online_clients`).text());
             var admin_onlines = parseInt($(`#online_admins`).text());
             $(`#online_${user.id}`).removeClass(`avatar-status-busy`);
             $(`#online_${user.id}`).addClass(`avatar-status-online`);
             if (['admin','superadmin'].includes(user.user_type)){
                 if (user.id != window.Data.user_id) {
                     admin_onlines++;
                 }
             }else if(user.user_type == 'driver') {
                  driver_onlines++;
             }else if(user.user_type == 'client') {
                  client_onlines++;
             }
             $(`#online_clients`).text(client_onlines)
             $(`#online_drivers`).text(driver_onlines)
             $(`#online_admins`).text(admin_onlines)
         })
     .leaving((user) => {
         // console.log(user);
         var leave_driver_onlines = parseInt($(`#online_drivers`).text());
         var leave_client_onlines = parseInt($(`#online_clients`).text());
         var leave_admin_onlines = parseInt($(`#online_admins`).text());
         $(`#online_${user.id}`).removeClass(`avatar-status-online`);
         $(`#online_${user.id}`).addClass(`avatar-status-busy`);
         if (['admin','superadmin'].includes(user.user_type)){
             if (user.id != window.Data.user_id) {
                 if (leave_admin_onlines - 1 >= 0) {
                     leave_admin_onlines--;
                 }
             }
         }else if(user.user_type == 'driver') {
              if (leave_driver_onlines - 1 >= 0) {
                  leave_driver_onlines--;
              }
         }else if(user.user_type == 'client') {
              if (leave_client_onlines - 1 >= 0) {
                  leave_client_onlines--;
              }
         }
         $(`#online_clients`).text(leave_client_onlines)
         $(`#online_drivers`).text(leave_driver_onlines)
         $(`#online_admins`).text(leave_admin_onlines)
         if (window.cars.filter(item => item.driver_id == user.id).length > 0) {
             window.cars.filter(item => item.driver_id == user.id)[0].car_marker.setMap(null);
         }
         window.cars = window.cars.filter(item => item.driver_id != user.id);
     });
