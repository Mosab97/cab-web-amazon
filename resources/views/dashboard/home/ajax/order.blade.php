@foreach ($orders as $order)
    <tr class="text-center">
        <td># {{ $order->id }}</td>
        <td>{{ $order->client->fullname }}</td>
        <td><i class="fa fa-circle font-small-3 {{ $css_class }} mr-50"></i>{{ trans('dashboard.order.statuses.'.$order->order_status) }}</td>
        <td>
            {{ trans('dashboard.order.order_types.'.$order->order_type) }}
        </td>
        <td>{{ $order->created_at->isoFormat("D MMMM , Y ( h:mm a )") }}</td>
        <td class="text-center font-medium-1">
            <a href="{!! route('dashboard.order.show',$order->id) !!}" class="text-primary mr-2 font-medium-3">
                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
            </a>
        </td>
    </tr>
@endforeach
