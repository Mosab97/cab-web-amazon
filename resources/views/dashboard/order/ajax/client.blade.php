@foreach ($chat_clients as $chat_client)
<li>
    <a href="{!! route('dashboard.client.show',$client->id) !!}?chat_id={{ $chat_client->id }}" style="display:contents;">
        <div class="pr-1">
            <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ $chat_client->sender_id == $client->id ? $chat_client->receiver->avatar : $chat_client->sender->avatar }}" height="42" width="42" alt="{{ $chat_client->sender_id == $client->id ? $chat_client->receiver->fullname : $chat_client->sender->fullname }}">
                <i></i>
            </span>
        </div>
        <div class="user-chat-info">
            <div class="contact-info">
                <h5 class="font-weight-bold mb-0">{{ $chat_client->sender_id == $client->id ? $chat_client->receiver->fullname : $chat_client->sender->fullname }}</h5>
                <p class="truncate">{{ str_limit($chat_client->last_message,20) }}</p>
            </div>
            <div class="contact-meta">
                <span class="float-right mb-25">{{ optional(optional($chat_client->messages->last())->created_at)->format("h:i A") }}</span>
            </div>
        </div>
    </a>
</li>
@endforeach
<script>
    $.merge(window.client_list,@json($chat_clients->pluck('id')->toArray()));
</script>
