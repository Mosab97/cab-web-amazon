@if($client)
<a href="{!! route('dashboard.client.show',$client->id) !!}">{{ $client->fullname }}</a>
@endif
