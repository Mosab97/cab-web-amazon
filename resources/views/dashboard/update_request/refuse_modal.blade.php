<!-- Basic modal -->
<div class="modal fade text-left" id="modal_refuse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger white">
        <h5 class="modal-title">@lang('dashboard.update_request.refuse_reason')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::model($update_request,['route' =>['dashboard.update_request.update',$update_request->id],'method' => 'PUT']) !!}
      <div class="modal-body">

          {!! Form::hidden('update_status', 'refused') !!}
          <div class="form-group row">
            <label class="control-label col-lg-2">@lang('dashboard.update_request.refuse_reason')</label>
            <div class="col-lg-10">
              {!! Form::textarea("refuse_reason", null, ['class'=>"form-control",'rows' => 4,'placeholder'=>trans('dashboard.update_request.refuse_reason')]) !!}
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">@lang('dashboard.general.cancel') </button>
        <button type="submit" class="btn btn-danger btn-print mb-1 mb-md-0 ml-3 text-white"><i class="feather icon-x-circle" title="{{ trans('dashboard.general.send') }}"></i> {!! trans('dashboard.update_request.refuse_update') !!}</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- /basic modal -->
