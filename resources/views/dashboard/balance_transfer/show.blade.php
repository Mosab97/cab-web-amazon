@extends('dashboard.layout.layout')
@section('content')
<!-- Inner container -->
{{-- <div class="d-flex align-items-start flex-column flex-md-row"> --}}
<div class="row">
    <div class="col-md-9">
        <!-- Left content -->
        <div class="w-100 overflow-auto order-2 order-md-1">

            <!-- Post -->
            <div class="card border-info bg-transparent">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="font-weight-semibold mb-1">
                            {{ $contact->title }}
                        </h4>

                        <ul class="list-inline list-inline-dotted text-muted mb-3">
                            <li class="list-inline-item">
                                {{ trans('dashboard.contact.writtenBy') }} <a href="#" class="text-muted"> {{ $contact->fullname }}</a>
                            </li>
                            <li class="list-inline-item">
                                {{ $contact->created_at->toDateString() }}
                                <i class="feather icon-clock ml-1 mr-1"></i>
                            </li>
                            @if ($contact->order_id)
                                <li class="list-inline-item">
                                    {{ $contact->order_id }}
                                    <i class="feather icon-shopping-cart ml-1 mr-1"></i>
                                </li>

                            @endif

                        </ul>
                        <div class="divider divider-success">
                            <div class="divider-text">{!! trans('dashboard.chat.message') !!}</div>
                        </div>
                        <div class="m-3">
                            <p>{{ $contact->content }}</p>
                        </div>

                        {{-- <div class="card card-body bg-light rounded-left-0 border-left-3 border-left-warning">

                        </div>
                        <p class="mb-1">{{ $contact->content }}</p> --}}

                    </div>

                </div>
            </div>
            <!-- /post -->



            <!-- Comments -->
            <div class="card border-info bg-transparent">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title font-weight-semibold">{!! trans('dashboard.contact.replies') !!}</h6>
                    <div class="header-elements">
                        {{-- <ul class="list-inline list-inline-dotted text-muted mb-0">
                    <li class="list-inline-item">{!! trans('dashboard.contact.reply_count') !!} / <span class="reply_count">{{ $contact->replies->count() }}</span> </li>

                        </ul> --}}
                        <p class="ml-auto d-flex align-items-center">
                            <i class="feather icon-message-square font-medium-2 mr-50"></i>
                            <span class="reply_count">{{ $contact->replies->count() }}</span>
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="media-list">
                        @foreach ($contact->replies as $reply)
                            <div class="d-flex justify-content-start align-items-center mb-1 {{ $reply->id }}">
                                <div class="avatar mr-50">
                                    <img src="{{ $reply->sender->avatar }}" alt="Avatar" height="30" width="30">
                                </div>
                                <div class="user-page-info">
                                    <h6 class="mb-0">{{ $reply->sender->fullname }}</h6>
                                    <span class="font-small-2">{!! $reply->reply !!}</span>
                                </div>
                                <div class="ml-auto cursor-pointer font-medium-1">
                                    {{-- <span class="font-small-1"><i class="feather icon-clock mr-50"></i> {{ $reply->created_at->diffForHumans() }}</span> --}}
                                    <a href="#" onclick="deleteItem({{ $reply->id }},'{{ LaravelLocalization::localizeUrl('dashboard/reply/'.$reply->id."/delete") }}')"><i class="feather icon-trash-2 mr-50"></i></a>

                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>

                <div class="divider divider-success">
                    <div class="divider-text"><i class="feather icon-message-circle"></i></div>
                </div>

                <div class="card-body">
                    <h6 class="mb-3">{!! trans('dashboard.contact.reply') !!}</h6>
                    {!! Form::open(['route'=>'dashboard.contact.store','method'=>'POST','files'=>true,'class'=>'form-horizontal']) !!}
                    <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                    <div class="form-group row">
                        <label class="control-label col-lg-2">@lang('dashboard.setting.sending_type')</label>
                        <div class="vs-radio-con vs-radio-success col-md-5">
                            {!! Form::radio('send_type', "fcm" ,'checked') !!}
                            <span class="vs-radio">
                                <span class="vs-radio--border"></span>
                                <span class="vs-radio--circle"></span>
                            </span>
                            <span class="">{{ trans('dashboard.setting.FCM') }}</span>

                        </div>
                        <div class="vs-radio-con vs-radio-success">
                            {!! Form::radio('send_type', "sms") !!}
                            <span class="vs-radio">
                                <span class="vs-radio--border"></span>
                                <span class="vs-radio--circle"></span>
                            </span>
                            <span class="">{{ trans('dashboard.setting.SMS') }}</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-label-group mb-0">
                                    {!! Form::textarea('reply', null , ['class'=>'form-control char-textarea border-info','id' => "textarea-counter" , 'data-length' => 500,'placeholder' => trans('dashboard.contact.reply')]) !!}
                                    <label for="textarea-counter">{{ trans('dashboard.contact.reply') }}</label>
                                </fieldset>
                                <small class="counter-value float-right font-small-2"><span class="char-count">0</span> / 500 </small>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="icon-plus22 mr-1"></i> {!! trans('dashboard.contact.reply') !!}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /comments -->

        </div>
        <!-- /left content -->

    </div>
    <div class="col-md-3">
        <!-- Right sidebar component -->
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Recent comments -->
                <div class="card border-info bg-transparent">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="card-title font-weight-semibold">{!! trans('dashboard.contact.latest_messages') !!}</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="media-list">
                            @forelse ($recentMsgs as $recent)
                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{ $recent->image }}" class="rounded-circle" width="36" height="36" alt="">
                                </div>

                                <div class="media-body">
                                    <a href="{{ route('dashboard.contact.show',$recent->id) }}" class="media-title">
                                        <div class="font-weight-semibold">{{ $recent->fullname }}</div>
                                    </a>

                                    <span class="text-muted">{{ str_limit($recent->content , 100 , "...") }}</span>
                                </div>
                            </li>
                            @empty
                            <li class="media font-weight-semibold border-0 py-2 justify-content-center">{!! trans('dashboard.contact.no_messages') !!}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <!-- /recent comments -->


                <!-- Archive -->


                <div class="card border-info">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom pb-1">
                        <div class="card-title">{!! trans('dashboard.contact.archive') !!}</div>
                    </div>
                    <div class="card-content">
                        <div class="list-group analytics-list">
                            @forelse ($archives as $archive)
                                <div class="list-group-item d-lg-flex justify-content-between align-items-start py-1">
                                    <div class="float-left">
                                        <p class="text-bold-600 font-medium-2 mb-0 mt-25">{{ $archive->month_name ." ".$archive->year }}</p>
                                    </div>
                                    <div class="float-right">
                                        <a href="{{ route('dashboard.contact.index') }}/?month={{ $archive->month }}&year={{ $archive->year }}" class="btn btn-sm btn-icon rounded-circle btn-outline-primary mr-50 waves-effect waves-light">
                                            <i class="feather icon-monitor"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <li class="media font-weight-semibold border-0 py-2 justify-content-center">{!! trans('dashboard.contact.no_archive') !!}</li>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- /archive -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /right sidebar component -->

    </div>
</div>



{{-- </div> --}}
<!-- /inner container -->
@include('dashboard.layout.delete_modal')

@endsection
@section('page_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/users.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

<style media="screen">
    body.dark-layout .card .note-toolbar,
    body.dark-layout .card .note-toolbar {
        color: #fff;
        background-color: #55565c;
    }

    .note-btn-group .note-btn {
        border-color: rgba(209, 110, 110, 0.2);
        padding: 0.50rem .75rem;
        font-size: 17px;
    }

    .note-btn-group .note-btn {
        color: #000;
    }

    .note-btn-group .note-btn .note-current-fontname {
        font-family: 'Cairo';
        color: #000;
    }

    .note-editor.note-airframe,
    .note-editor.note-frame {
        border: 1px solid;
        border-color: #000;
    }

    .note-resize button span {
        color: #000;
    }
</style>
@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/user-profile.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/lang/summernote-ar-AR.min.js"></script>
<script>
    $(function() {
        $('#summernote').summernote({
            tabsize: 10,
            height: 250,
            lang: "{{ app()->getLocale() == 'ar' ? 'ar-AR' : '' }}"
        });
    });
</script>

@endsection
