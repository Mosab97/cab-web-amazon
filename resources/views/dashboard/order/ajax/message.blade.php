
    @forelse ($messages->reverse() as $message)
    @if ($message->created_at->format("Y-m-d") != $format )
    @php
    $format= $message->created_at->format("Y-m-d");
    @endphp
    <div class="divider">
        <div class="divider-text">{{ $format }}</div>
    </div>
    @endif

    @if ($message->sender_id != $order->client_id)
    <div class="chat">
        <div class="chat-avatar">
            <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                <img src="{{ $message->sender->avatar }}" alt="avatar" height="40" width="40" />
            </a>
        </div>
        <div class="chat-body">
            @if ($message->message_type == 'image')
            <div class="chat-content-media">
                <a href="{{ $message->message }}" data-fancybox="gallery">
                    <img src="{{ $message->message }}" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: left;margin-left: 18px;">
                </a>
            </div>
        @elseif ($message->message_type == 'location')
                <div class="chat-content-media">
                    <a href="https://www.google.com/maps/place/{{ $message->message }},15z" target="_blank">
                        <img src="{{ asset('dashboardAssets') }}/images/icons/chat_map.jpg" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: left;margin-left: 18px;">
                    </a>
                </div>
            @else
            <div class="chat-content">
                <p style="font-size: 1.1em;">{{ $message->message }}</p>
            </div>
            @endif
        </div>
    </div>
    @else
    <div class="chat chat-left">
        <div class="chat-avatar mt-50">
            <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                <img src="{{ $message->sender->avatar }}" alt="avatar" height="40" width="40" />
            </a>
        </div>
        <div class="chat-body">
            @if ($message->message_type == 'image')
            <div class="chat-content-media">
                <a href="{{ $message->message }}" data-fancybox="gallery">
                    <img src="{{ $message->message }}" class="img-thumbnail chat-image" alt="" style="width: auto;height: 120px;float: right;margin-right: 18px;">
                </a>
            </div>
        @elseif ($message->message_type == 'location')
            <div class="chat-content-media">
                <a href="https://www.google.com/maps/place/{{ $message->message }},15z" target="_blank">
                    <img src="{{ asset('dashboardAssets') }}/images/icons/chat_map.jpg" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: right;margin-right: 18px;">
                </a>
            </div>
            @else
            <div class="chat-content">
                <p style="color: #0d4e79; font-size: 1.1em;">{{ $message->message }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif
    @empty
    <h3 class="d-flex justify-content-center no_message">
        {!! trans('dashboard.chat.no_messages') !!}
    </h3>
    @endforelse
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
