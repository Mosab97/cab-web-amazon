<div class="modal fade text-left" id="change_package_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="myModalLabel20">{!! trans('dashboard.package.subscribe_package') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form driver_change_package_form" method="post" action="">
                <div class="modal-body" id="package_change">
                    <div class="card-body">

                        <input type="hidden" name="driver_id" value="">
                        <div class="form-group row">
                            <label class="font-medium-1 col-md-3">
                                {!! trans('dashboard.package.packages') !!}
                            </label>
                            <div class="col-md-9">
                                {!! Form::select('package_id', $all_packages, isset($driver) ? optional($driver->driver->subscribedPackage)->package_id : null , ['class' => 'select2 form-control package_select' , 'placeholder' => trans('dashboard.package.packages')]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="font-medium-1 col-md-3">
                                    {!! trans('dashboard.package.enable_subscribe') !!}
                                </label>
                                <div class="float-right col-md-9">
                                    <div class="custom-control toggle-edit toggle-switch custom-switch custom-switch-success mr-2 mb-1">
                                        <input id="change_subscribe_driver" {{ isset($driver) && optional($driver->driver->subscribedPackage)->is_paid ? 'checked' : null }} class="custom-control-input" type="checkbox" name="is_paid">
                                        <label for="change_subscribe_driver"></label>
                                        <label class="custom-control-label" for="change_subscribe_driver">
                                            <span class="switch-icon-left"></span>
                                            <span class="switch-icon-right"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" onclick="changePackageId()" class="btn btn-primary mr-1 waves-effect waves-light float-right">
                        {!! trans('dashboard.general.save') !!}
                    </a>

                </div>
            </form>
        </div>
    </div>
</div>
