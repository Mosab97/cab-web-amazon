<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\{User , Facility , Country , City};
use App\Http\Requests\Site\User\RegisteredRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $facilities = Facility::get()->pluck('name','id');
        $countries = Country::get()->pluck('nationality','id');
        $cities = City::get()->pluck('name','id');
        return view('site.auth.register',compact('facilities','countries','cities'));
    }

    public function register(RegisteredRequest $request)
    {
        $client= User::create(array_except($request->validated(),['country_id','city_id'])+['user_type' => 'client','is_active' => 1 , 'is_ban' => 0 , 'email_verified_at' => now()]);
        $client->profile()->create(array_only($request->validated(),['country_id','city_id']));
        $this->guard()->login($client);

        return redirect(route('client.index'))->withTrue(trans('site.auth.welcome',['name' => $client->fullname]));
    }
}
