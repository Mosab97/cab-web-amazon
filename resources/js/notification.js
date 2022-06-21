if (window.Data.user_id != null) {
window.Echo.private(`caberz-notification.${window.Data.user_id}`)
    .notification((notification) => {
        var notification_html = "";
        // console.log(notification);
        if(notification.type == "App\\Notifications\\Order\\ChangeOrderStatusNotification"){
            $(`#order_statuses_${notification.order_id} #${notification.order_status} .timeline-icon`).addClass('bg-success');
            $(`#order_statuses_${notification.order_id} #${notification.order_status} .timeline-icon`).removeClass('bg-danger');
            $(`#order_statuses_${notification.order_id} #${notification.order_status} .timeline-icon`).html(`<i class="feather icon-check font-medium-2"></i>`);
            $(`#order_statuses_${notification.order_id} #${notification.order_status} p`).addClass('text-success');
            $(`#order_statuses_${notification.order_id} #${notification.order_status} p`).removeClass('text-danger');
            $(`#order_statuses_${notification.order_id} #${notification.order_status} .time`).html(notification.order_status_time);
            window.Data.order_status = notification.order_status;
            if (['driver_finish','client_cancel','driver_cancel','client_finish','admin_finish'].includes(notification.order_status) && window.Data.driver_id != null && window.Data.order_id != null) {
                var driver_map = window.cars.filter(item => item.driver_id == window.Data.driver_id);
                if (driver_map.length > 0) {
                    driver_map[0].car_marker.setMap(null);
                }
            }
            if ((notification.order_status == 'shipped' || notification.order_status == 'start_trip') && window.Data.order_id == notification.order_id && window.Data.driver_id == null) {
                window.Data.driver_id = notification.driver.id;

                var driver_card_link =`<a href="${notification.route_to_edit_driver}" class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">
                    <i class="feather icon-edit-2"></i>
                </a>
                <a href="${notification.route_to_show_driver}" class="btn btn-icon btn-icon rounded-circle btn-success mr-1">
                    <i class="feather icon-airplay"></i>
                </a>`;

                var driver_card_data = `<div>
                    <a href="${notification.route_to_show_driver}">
                        <img src="${notification.driver_avatar}" style="width: 80px; height: 80px;" class="img-square" alt="">
                    </a>
                </div>
                <div class="ml-2">

                    <p>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chip chip-success mr-1">
                                    <div class="chip-body">
                                        <div class="avatar">
                                            <i class="feather icon-target text-bold font-small-3"></i>
                                        </div>
                                        <span class="chip-text text-white text-bold font-small-3"> ${notification.driver.fullname} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="chip chip-success mr-1">
                                    <div class="chip-body">
                                        <div class="avatar">
                                            <i class="feather icon-phone text-bold font-small-3"></i>
                                        </div>
                                        <span class="chip-text text-white text-bold font-small-3"> ${notification.driver.phone}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="chip chip-success mr-1">
                                <div class="chip-body">
                                    <div class="avatar">
                                        <i class="feather icon-flag text-bold font-small-3"></i>
                                    </div>
                                    <span class="chip-text text-white text-bold font-small-3">${notification.driver_orders_count_trans}</span>
                                </div>
                            </div>
                        </div>
                    </p>
                </div>`

                $('.driver_card_link').html(driver_card_link);
                $('.driver_card_data').html(driver_card_data);
            }

        }else{
            var notify_count = parseInt($('#notify_counter').text());
            new Audio(window.Data.notification).play();
            $('.notify_count').text(++notify_count);
            // $('.notify_count').show();
             if (notification.type == "App\\Notifications\\Order\\OrderNotification") {
                notification_html = `<a class="d-flex justify-content-between" href="${notification.route}">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left">
                                            ${(() => {
                                                if (notification.order_id != '') {
                                                    return ` <i class="feather icon-shopping-cart font-medium-5 primary"></i>`;
                                                }else{
                                                     return `<i class="feather icon-message-square font-medium-5 primary"></i>`;
                                                }
                                            })()}
                                            </div>
                                            <div class="media-body">
                                                <h6 class="primary media-heading">${notification.title}</h6>
                                                <small class="notification-text"> ${ notification.body }</small>
                                            </div>
                                            <small>
                                                <time class="media-meta">${ notification.created_at }</time>
                                            </small>
                                        </div>
                                    </a>`;


                if (notification.notify_type == 'order') {
                    var order_product = notification.order_ad;
                    var order_tr = `<tr class="text-center">
                    <td>#${ notification.order_id }</td>
                    <td>${notification.sender.fullname}</td>
                    <td><i class="fa fa-circle font-small-3 text-warning mr-50"></i>${ notification.trans_order_status }</td>
                    <td>
                        ${ notification.order_type_trans }
                    </td>
                    <td>${ notification.created_at }</td>
                    <td class="text-center font-medium-1">
                    <a href="${notification.route}" class="text-primary mr-2 font-medium-3">
                    <i class="feather icon-monitor"></i>
                    </a>
                    </td>
                    </tr>`;

                    $('#new .list-orders .new_orders_row').prepend(order_tr);
                }
            }else{

                notification_html = `<a class="d-flex justify-content-between" href="${notification.route}">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left">
                                            ${(() => {
                                                if (notification.order_id != '') {
                                                    return ` <i class="feather icon-shopping-cart font-medium-5 primary"></i>`;
                                                }else{
                                                     return `<i class="feather icon-message-square font-medium-5 primary"></i>`;
                                                }
                                            })()}
                                            </div>
                                            <div class="media-body">
                                                <h6 class="primary media-heading">${notification.title}</h6>
                                                <small class="notification-text"> ${ notification.body }</small>
                                            </div>
                                            <small>
                                                <time class="media-meta">${ notification.created_at }</time>
                                            </small>
                                        </div>
                                    </a>`;

            }
            $('.notification_list').find('a:first').before(notification_html);
            $('.no_notifications').remove();
            toastr.info(notification.title, '', { "progressBar": true });
        }

    }).listen('.NewMessage', (e) => {
            if (e.order_status == 'shipped' && window.Data.order_id == e.order_id && e.chat_id != null && window.Data.chat_id == null) {
                window.connectToChat(e.chat_id);
                window.Data.chat_id = e.chat_id;
            }
    })
}
