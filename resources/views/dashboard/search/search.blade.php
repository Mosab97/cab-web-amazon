@extends('dashboard.layout.layout')

@section('content')

<!-- Search field -->
<div class="card border-info">
    <div class="card-body">
        <section id="search-bar">
            {{-- <div class="search-bar"> --}}
                <form action="{{ url('dashboard/search') }}" method="GET">
                    <div class="position-relative has-icon-left input-group form-group">
            			{!! Form::text('search', null , ['class' => 'form-control' ,'aria-describedby' => "button-addon2" , 'placeholder' => trans('dashboard.general.search') , 'autocomplete' => 'off']) !!}
                        <div class="form-control-position">
                            <i class="feather icon-search px-1"></i>
                        </div>
            			<div class="input-group-append" id="button-addon2">
            				<button type="submit" class="btn btn-primary btn-xs">{{ trans('dashboard.general.search') }}</button>
            			</div>
            		</div>
                    {{-- <ul class="search-list search-list-main search_section_page"></ul> --}}
                </form>
            {{-- </div> --}}
        </section>
    </div>
</div>


<div class="card border-info">
    <div class="card-header">
        <div class="alert alert-info alert-styled-left alert-dismissible" style="width: 100%;">
            <span class="font-weight-semibold"></span>
            @lang('dashboard.general.search_result_about' , ['query' => $keyword , 'count' => $total_count]) .
        </div>
        @if (!$total_count)
            {{-- <div class="search-results-list d-flex justify-content-center"> --}}
                <h4 class="text-center" style="width: 100%;">
                    @lang('dashboard.messages.no_search_result')
                </h4>
            {{-- </div> --}}
        @else
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                @if ($clients->count())
                    <li class="nav-item">
                        <a href="#clients" class="nav-link legitRipple {{  $search_type == 'client' ? 'show active' : ''}}" data-toggle="tab">
                            @lang('dashboard.client.clients')<span class="badge badge-success badge-pill ml-2">{{ $clients_count }}</span>
                        </a>
                    </li>
                    @endif
                    @if ($admins->count())
                        <li class="nav-item">
                            <a href="#admins" class="nav-link legitRipple {{  $search_type == 'admin' ? 'show active' : ''}}" data-toggle="tab">
                                @lang('dashboard.admin.admins')<span class="badge badge-success badge-pill ml-2">{{ $admins_count }}</span>
                            </a>
                        </li>
                        @endif
                    @if ($drivers->count())
                    <li class="nav-item">
                        <a href="#drivers" class="nav-link legitRipple {{  $search_type == 'driver' ? 'show active' : ''}}" data-toggle="tab">
                            @lang('dashboard.driver.drivers')<span class="badge badge-success badge-pill ml-2">{{ $drivers_count }}</span>
                        </a>
                    </li>
                    @endif
                    @if ($brands->count())
                    <li class="nav-item">
                        <a href="#brands" class="nav-link legitRipple {{  $search_type == 'brand' ? 'show active' : ''}}" data-toggle="tab">
                            @lang('dashboard.brand.brands')<span class="badge badge-success badge-pill ml-2">{{ $brands_count }}</span>
                        </a>
                    </li>
                    @endif
                    @if ($car_models->count())
                    <li class="nav-item">
                        <a href="#car_models" class="nav-link legitRipple {{  $search_type == 'car_model' ? 'show active' : ''}}" data-toggle="tab">
                            @lang('dashboard.car_model.car_models')<span class="badge badge-success badge-pill ml-2">{{ $car_models_count }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
                    @endif
    </div>
    <div class="card-body">
        <div class="tab-content">
            @if ($clients->count())
            <div class="tab-pane fade {{ $search_type == 'client' ? 'show active' : ''}}" id="clients">
                <div class="row mt-4">
                    @foreach ($clients as $client)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card text-white bg-gradient-primary text-center">
                            <div class="card-content d-flex">
                                <div class="card-body">
                                    <img src="{{ $client->image }}" style="height:100px; width:100px;" class="float-left img-thumbnail mt-2 ml-2">
                                    <h4 class="card-title text-white mt-3">{{ $client->fullname }}</h4>
                                    <p class="card-text"><i class="feather icon-shopping-cart"></i> {{ $client->clientOrders->count() }}</p>
                                    <a href="{{ route('dashboard.client.edit',$client->id) }}" class="font-medium-2 text-bold btn btn-success mt-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                    <a href="{{ route('dashboard.client.show',$client->id) }}" class="font-medium-2 text-bold btn btn-info mt-1 waves-effect waves-light"><i class="feather icon-monitor"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $clients->appends(['search' => $keyword])->links() !!}
                </div>

            </div>
            @endif


            @if ($admins->count())
            <div class="tab-pane fade {{  $search_type == 'admin' ? 'show active' : ''}}" id="admins">
                <div class="row mt-4">
                    @foreach ($admins as $admin)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card text-white bg-gradient-primary text-center">
                            <div class="card-content d-flex">
                                <div class="card-body">
                                    <img src="{{ $admin->image }}" style="height:100px; width:100px;" class="float-left img-thumbnail mt-2 ml-2">
                                    <h4 class="card-title text-white mt-3">{{ $admin->fullname }}</h4>
                                    <p class="card-text"><i class="feather icon-mail"></i> {{ $admin->email }}</p>
                                    <a href="{{ route('dashboard.manager.edit',$admin->id) }}" class="font-medium-2 text-bold btn btn-success mt-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $admins->appends(['search' => $keyword])->links() !!}

                </div>

            </div>
            @endif

            @if ($drivers->count())
            <div class="tab-pane fade {{  $search_type == 'driver' ? 'show active' : ''}}" id="drivers">
                <div class="row mt-4">
                    @foreach ($drivers as $driver)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card text-white bg-gradient-primary text-center">
                            <div class="card-content d-flex">
                                <div class="card-body">
                                    <img src="{{ $driver->image }}" style="height:100px; width:100px;" class="float-left img-thumbnail mt-2 ml-2">
                                    <h4 class="card-title text-white mt-3">{{ $driver->fullname }}</h4>
                                    <p class="card-text"><i class="feather icon-shopping-cart"></i> {{ $driver->driverOrders->count() }}</p>
                                    <a href="{{ route('dashboard.driver.edit',$driver->id) }}" class="font-medium-2 text-bold btn btn-success mt-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                    <a href="{{ route('dashboard.driver.show',$driver->id) }}" class="font-medium-2 text-bold btn btn-info mt-1 waves-effect waves-light"><i class="feather icon-monitor"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $drivers->appends(['search' => $keyword])->links() !!}
                </div>

            </div>
            @endif

            @if ($brands->count())
            <div class="tab-pane fade {{  $search_type == 'brand' ? 'show active' : ''}}" id="brands">
                <div class="row mt-4">
                    @foreach ($brands as $brand)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card text-white bg-gradient-primary text-center">
                            <div class="card-content d-flex">
                                <div class="card-body">
                                    <img src="{{ $brand->image }}" style="height:100px; width:100px;" class="float-left img-thumbnail mt-2 ml-2">
                                    <h4 class="card-title text-white mt-3">{{ $brand->name }}</h4>
                                    <p class="card-text"><i class="feather icon-crop"></i> {{ $brand->carModels->count() }}</p>
                                    <a href="{{ route('dashboard.brand.edit',$brand->id) }}" class="font-medium-2 text-bold btn btn-success mt-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                    <a href="{{ route('dashboard.brand.show',$brand->id) }}" class="font-medium-2 text-bold btn btn-info mt-1 waves-effect waves-light"><i class="feather icon-monitor"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $brands->appends(['search' => $keyword])->links() !!}
                </div>

            </div>
            @endif

            @if ($car_models->count())
            <div class="tab-pane fade {{  $search_type == 'car_model' ? 'show active' : ''}}" id="car_models">
                <div class="row mt-4">
                    @foreach ($car_models as $car_model)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card position-static text-white bg-gradient-primary text-center">
                            <div class="card-body">
                                <img src="{{ $car_model->brand->image }}" style="height:100px; width:100px;" class="float-left img-thumbnail mt-2 ml-2">
                                <h4 class="card-title">{{ $car_model->name }}</h4>
                                <p class="card-text">
                                    <i class="feather icon-truck"></i>
                                    {{ $car_model->cars->count() }}
                                </p>
                                <a href="{{ route('dashboard.car_model.edit',$car_model->id) }}" class="font-medium-2 text-bold btn btn-success mt-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                             </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $car_models->appends(['search' => $keyword])->links() !!}
                </div>

            </div>
            @endif

            {{-- <div class="text-center" style="display:none">
                <p class="text-center"><i class="icon-spinner9 spinner"></i></p>
            </div> --}}
        </div>
    </div>
</div>
<!-- /search field -->
@endsection
@include('dashboard.search.scripts')
