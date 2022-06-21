<!-- Basic modal -->
<div class="modal fade text-left" id="modal_zero_wallet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning white">
                <h5 class="modal-title">{{ trans('dashboard.general.warning') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="item" user-id="" user-type="">
                <div class="form-group row client_category">

                </div>
                <div class="row justify-content-center">
                    {{-- <div class="col-12 m-1"> --}}
                        <p class="text-warning">{!! trans('dashboard.messages.r_u_sure_to_set_user_wallet_zero') !!}</p>

                    {{-- </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">
                        {{ trans('dashboard.general.cancel') }} </button>
                    <a class="btn btn-warning btn-print mb-1 mb-md-0 ml-3 text-white" onclick="updateWalletByZero()"><i class="feather icon-plus" title="{{ trans('dashboard.general.sure') }}"></i> {{ trans('dashboard.general.sure') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- /basic modal -->
