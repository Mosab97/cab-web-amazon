
{!! Form::select("order_status",$order->order_statuses , $order->order_status , ['class' => 'select2 form-control', 'onchange' => "changeOrderStatus(this.value,'". $order->id ."')"]) !!}
