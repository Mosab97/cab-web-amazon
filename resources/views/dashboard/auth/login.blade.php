@extends('dashboard.auth.layout')

@section('content')
<section class="row flexbox-container">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0 login-form">
            <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    <img src="{{ asset('dashboardAssets') }}/images/cover/full_cover_sm_bg.png" alt="branding logo" style="width: 297.5px;height: 322px;padding: 2px 3px;">
                </div>
                <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2">
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="mb-0">{!! trans('dashboard.auth.dashboard') !!}</h4>
                            </div>
                        </div>
                        <p class="px-2">{!! trans('dashboard.auth.credentials') !!}</p>
                        <div class="card-content">
                            <div class="card-body pt-1">
                                <form action="{!! route('dashboard.post_login') !!}" method="post" class="pb-3">
                                    {!! csrf_field() !!}
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input type="text" name="username" class="form-control" id="user-name" placeholder="{!! trans('dashboard.auth.username') !!}" required>
                                        <div class="form-control-position">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        <label for="user-name">{!! trans('dashboard.auth.username') !!}</label>
                                    </fieldset>

                                    <fieldset class="form-label-group position-relative has-icon-left">
                                        <input type="password" name="password" class="form-control" id="user-password" placeholder="{!! trans('dashboard.general.password') !!}" required>
                                        <div class="form-control-position">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        <label for="user-password">{!! trans('dashboard.general.password') !!}</label>
                                    </fieldset>
                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <div class="text-left">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" name="remember">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">{!! trans('dashboard.auth.remember') !!}</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        {{-- <div class="text-right"><a href="auth-forgot-password.html" class="card-link">Forgot Password?</a></div> --}}
                                    </div>
                                    {{-- <a href="auth-register.html" class="btn btn-outline-primary float-left btn-inline">Register</a> --}}
                                    <button type="submit" class="btn btn-primary float-right btn-inline">{!! trans('dashboard.auth.login') !!} </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /login card -->
@endsection
