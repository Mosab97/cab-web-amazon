<div class="modal fade text-left" id="refuse_driver_data_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="myModalLabel20">{!! trans('dashboard.driver.refuse_driver_data') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="refuse_reason_modal">
                {!! Form::hidden('driver_id', null) !!}
                <div class="form-group row">
                    <label class="control-label col-lg-2">
                        @lang('dashboard.update_request.refuse_reason')
                    </label>
                    <div class="col-lg-10">
                        {!! Form::textarea("refuse_reason", null, ['class'=>"form-control",'rows' => 4,'placeholder'=>trans('dashboard.update_request.refuse_reason')]) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" onclick="refuseDriverData()" class="btn btn-primary mr-1 waves-effect waves-light float-right">
                    <i class="feather icon-navigation"></i>
                    {!! trans('dashboard.general.send') !!}
                </a>
            </div>
        </div>
    </div>
</div>
