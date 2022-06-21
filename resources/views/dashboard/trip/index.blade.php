@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.trip.trips') !!}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="card border-info bg-transparent">
                    <div class="card-content">
                        <div class="card-body">
                            <div id="map" class="height-800"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@include('dashboard.trip.scripts')
