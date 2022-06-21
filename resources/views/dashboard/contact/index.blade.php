@extends('dashboard.layout.layout')
@section('current',trans('dashboard.contact.contacts'))
@section('content')
<!-- Basic datatable -->
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline pb-1">
        <h5 class="card-title">{!! trans('dashboard.contact.contacts') !!}</h5>
    </div>
    <div class="card-body border-info bg-transparent">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex py-75 active" id="account-pill-unread" data-toggle="pill" href="#unread" aria-expanded="true">
                            <i class="feather icon-globe mr-50 font-medium-3"></i>
                            {!! trans('dashboard.contact.unread_contacts') !!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-read" data-toggle="pill" href="#read" aria-expanded="false">
                            <i class="feather icon-lock mr-50 font-medium-3"></i>
                            {!! trans('dashboard.contact.read_contacts') !!}
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="tab-content">


                    <div role="tabpanel" class="tab-pane active" id="unread" aria-labelledby="account-pill-unread" aria-expanded="true">
                        <div class="table-responsive">
                            <table class="table table-bordered dataex-html5-selectors">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>
                                            @lang('dashboard.general.name')
                                        </th>

                                        <th>
                                            @lang('dashboard.contact.user_type')
                                        </th>

                                        <th>
                                            @lang('dashboard.order.order_number')
                                        </th>
                                        <th>
                                            @lang('dashboard.general.read')
                                        </th>
                                        <th>
                                            @lang('dashboard.general.added_date')
                                        </th>
                                        <th class="text-center">
                                            @lang('dashboard.general.control')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unMessages as $message)
                                    <tr class="{{ $message->id }} text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ $message->user_id ? route('dashboard.'.$message->user->user_type.'.show',$message->user_id) : '#' }}">{{ $message->fullname }}</a></td>
                                        <td>
                                            {{ $message->user_id ? trans('dashboard.user.user_types.'.$message->user->user_type) : '---' }}
                                        </td>
                                        <td><a href="{{ $message->order_id ?  route('dashboard.order.show',$message->order_id) : '#' }}">{{ $message->order_id }}</a></td>
                                        <td>
                                            <a href="{{ route('dashboard.contact.show',$message->id) }}" class="btn btn-success btn-md">
                                                {{ trans('dashboard.general.read') }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="badge badge-violet badge-md mr-1 mb-1">
                                                {{ $message->created_at->format("(Y-m-d) h:i A") }}
                                            </div>
                                        </td>
                                        <td class="text-center font-medium-1">
                                            <a onclick="deleteItem({{ $message->id }} , '{{ route('dashboard.contact.destroy',$message->id) }}')" class="text-danger font-medium-3">
                                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="read" role="tabpanel" aria-labelledby="account-pill-read" aria-expanded="false">
                        <div class="table-responsive">
                            <table class="table table-bordered dataex-html5-selectors">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>
                                            @lang('dashboard.general.name')
                                        </th>
                                        <th>
                                            @lang('dashboard.contact.user_type')
                                        </th>

                                        <th>
                                            @lang('dashboard.order.order_number')
                                        </th>
                                        <th>
                                            @lang('dashboard.general.read_at')</th>
                                        <th>
                                            @lang('dashboard.general.added_date')</th>
                                        <th class="text-center">
                                            @lang('dashboard.general.control')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rMessages as $message)
                                    <tr class="{{ $message->id }} text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ $message->user_id ? route('dashboard.'.$message->user->user_type.'.show',$message->user_id) : '#' }}">{{ $message->fullname }}</a>
                                        </td>
                                        <td>
                                            {{ $message->user_id ? trans('dashboard.user.user_types.'.$message->user->user_type) : '---' }}
                                        </td>
                                        <td><a href="{{ $message->order_id ?  route('dashboard.order.show',$message->order_id) : '#' }}">{{ $message->order_id }}</a></td>
                                        <td>
                                            <div class="badge badge-violet badge-md mr-1 mb-1">
                                                {{ $message->read_at->format("Y-m-d") }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="badge badge-primary badge-md mr-1 mb-1">
                                                {{ $message->created_at->format("(Y-m-d) h:i A") }}
                                            </div>
                                        </td>
                                        <td class="text-center font-medium-1">
                                            <a onclick="deleteItem({{ $message->id }} , '{{ route('dashboard.contact.destroy',$message->id) }}')" class="text-danger font-medium-3">
                                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                                            </a>
                                            <a href="{!! route('dashboard.contact.show',$message->id) !!}" class="text-primary mr-2 font-medium-3">
                                                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /basic datatable -->


@include('dashboard.layout.delete_modal')

@endsection

@include('dashboard.contact.scripts')
