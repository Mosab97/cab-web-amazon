<div class="modal fade text-left" id="package_subscribe_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="myModalLabel20">{!! trans('dashboard.package.subscribe_package') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form driver_package_form" method="post" action="{{ LaravelLocalization::localizeUrl('dashboard/ajax/set_subscribe_package_to_not_available_drivers') }}">
                <div class="modal-body" id="package_subscribe" style="height: 428px;">
                    <div class="card-body">
                        <div class="form-body">

                            <div class="form-group row">
                                <label for="feedback1" class="font-medium-1 col-md-2">
                                    {!! trans('dashboard.package.extend_to') !!}
                                </label>

                                <div class="col-md-10">
                                    <div class="input-group input-group-lg" style="width: 100%;">
                                        {!! Form::text('extend_to', null , ['class' => "extend_to form-control"]) !!}
                                    </div>
                                    <p class="text-success">{!! trans('dashboard.package.extend_to_desc') !!}</p>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="font-medium-1 col-md-3">
                                        {!! trans('dashboard.package.enable_subscribe') !!}
                                    </label>
                                    <div class="float-left col-md-9">
                                        <div class="custom-control toggle-edit toggle-switch custom-switch custom-switch-success mr-2 mb-1">
                                            <input id="enable_subscribe" checked class="custom-control-input" type="checkbox" name="is_paid">
                                            <label for="enable_subscribe"></label>
                                            <label class="custom-control-label" for="enable_subscribe">
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
                    <a href="javascript:void(0);" onclick="changePackageSubscribtion('not_available')" class="btn btn-primary mr-1 waves-effect waves-light float-right">{!!
                        trans('dashboard.general.save') !!}
                    </a>

                </div>
            </form>
        </div>
    </div>
</div>
