<div class="modal fade text-left" id="package_subscribe_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="myModalLabel20">{!! trans('dashboard.package.subscribe_package') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form driver_package_form" method="post" action="{{ LaravelLocalization::localizeUrl('dashboard/ajax/set_subscribe_package_to_driver/'. $driver->driver->subscribed_package_id ."/". $driver->id) }}">
                <div class="modal-body" id="package_subscribe">
                    <div class="card-body">
                        <div class="form-body">

                            <div class="form-group row">
                                <label for="feedback1" class="sr-only">
                                    {!! trans('dashboard.package.increment_subscribed_date') !!} ({{ optional(optional(@$driver->driver->subscribedPackage)->package)->name }})
                                </label>

                                {!! Form::date("end_at", optional(@$driver->driver->subscribedPackage->end_at)->format("Y-m-d") , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.package.end_at')]) !!}

                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label>
                                        {!! trans('dashboard.package.enable_subscribe') !!}
                                    </label>
                                    <div class="float-right">
                                        <div class="custom-control toggle-edit toggle-switch custom-switch custom-switch-success mr-2 mb-1">
                                            <input id="enable_subscribe_{{ $driver->id }}" {{ optional(@$driver->driver->subscribedPackage)->is_paid ? 'checked' : '' }} class="custom-control-input" type="checkbox" name="is_paid">
                                            <label for="enable_subscribe_{{ $driver->id }}"></label>
                                            <label class="custom-control-label" for="enable_subscribe_{{ $driver->id }}">
                                                <span class="switch-icon-left"></span>
                                                <span class="switch-icon-right"></span>
                                            </label>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" onclick="changePackageSubscribtion('{{ $driver->driver->subscribed_package_id }}','{{ $driver->id }}')" class="btn btn-primary mr-1 waves-effect waves-light float-right">{!!
                        trans('dashboard.general.save') !!}</a>

                </div>
            </form>
        </div>
    </div>
</div>
