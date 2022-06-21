<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\{ LogoutRequest ,LoginRequest ,SendRequest ,CheckRequest ,ChangeRequest ,SignUpRequest, CodeApiRequest ,CheckDriverRegisterRequest};
use App\Notifications\Auth\{VerifyApiMail,ResetPassword};
use App\Notifications\General\{GeneralNotification};
use App\Models\ { User , Device ,Package , GeneralInviteCode};
use App\Http\Resources\User\{UserProfileResource};
use App\Services\{WaslElmService};
use DB;

class AuthController extends Controller
{
    use WaslElmService;
      /**
      * Create a new AuthController instance.
      *
      * @return void
      */
     public function __construct()
     {
         $this->middleware('auth:api', ['except' => ['login','signup','checkDriverRegister','confirm','sendCode','checkCode','resetPassword']]);
     }
     // SignUp
    public function checkDriverRegister(CheckDriverRegisterRequest $request)
    {
        return response()->json(['status' => 'success','data'=> null ,'message'=>""], 200);
    }

    public function signup(SignUpRequest $request)
    {
        // DB::beginTransaction();
        // try{
            $profile_date = ['country_id','city_id','is_infected'];
            $car_date = ['brand_id','car_model_id' , 'car_type_id' , 'car_licence_image','car_form_image','car_front_image' ,'car_back_image','car_insurance_image' , 'license_serial_number','plate_number','plate_letter_right','plate_letter_middle' , 'plate_letter_left' ,'plate_numbers_only', 'manufacture_year', 'plate_type'];
            $code = 1111;
            if (setting('use_sms_service') == 'enable') {
                $code = mt_rand(1111,9999);//generate_unique_code(4,'\\App\\Models\\User','verified_code');
            }
            $refer_user = null;
            $invitation = null;

            if ($request->referral_code) {
                $refer_user = User::firstWhere('referral_code' , $request->referral_code);
                if (!$refer_user) {
                    $invitation = GeneralInviteCode::active()->firstWhere('code',$request->referral_code);
                    $refer_user = null;
                }
            }

            $user_data = [
                'verified_code' => $code ,
                'is_active' => 0 ,
                'referral_id' => @$refer_user->id ,
                'referral_code' => generate_unique_code(8,'\\App\\Models\\User','referral_code','alpha_numbers','lower'),
                'points' => @$invitation->points
            ];

            $user = User::create(array_except($request->validated(),array_merge($profile_date , $car_date,['package_id' , 'plate_letters','health_certificate','driver_type','referral_code']))+$user_data);

            $user->profile()->create(array_only($request->validated(),$profile_date)+['added_by_id' => auth('api')->id()]);

            if ($invitation) {
                $user->userPoints()->create([
                    'points' => @$invitation->points,
                    'added_by_id' => auth('api')->id(),
                    'is_used' => false,
                    'status' => 'add',
                    'reason' => 'invite_code',
                    'transfer_type' => 'point',
                    'added_by_id' => auth('api')->id() ?? auth()->id(),
                ]);

                $invitation->invites()->create([
                    'user_id' => $user->id,
                    'code' => $invitation->code,
                    'points' => $invitation->points,
                ]);
            }
            if ($refer_user) {
                if ($user->user_type == 'client') {
                    $points = (int)setting('num_points_when_client_register_by_refer_code');
                }else{
                    $points = (int)setting('num_points_when_driver_register_by_refer_code');
                }
                // $amount = (int)setting('amount_of_single_point') * $points;

                $refer_user->myReferrals()->create(['child_user_id' => $user->id ,'points' => $points ,'referral_code' => $request->referral_code]);

                $refer_user->update(['points' => ($refer_user->points + $points)]);

                $refer_user->userPoints()->create([
                    'points' => $points,
                    'added_by_id' => auth('api')->id(),
                    'is_used' => false,
                    'status' => 'add',
                    'reason' => 'referral_code',
                    'transfer_type' => 'point',
                    'added_by_id' => auth('api')->id() ?? auth()->id(),
                ]);
            }
            if ($user->user_type == 'driver') {
                $user->car()->create(array_only($request->validated(),$car_date));
                $driver_data = ['is_on_default_package' => false, 'is_available' => 1 , 'driver_type' => $request->driver_type];
                if ($request->package_id) {
                    $package = Package::active()->findOrFail($request->package_id);
                    $subscribed_package = $user->driverPackages()->create([
                        'package_id' => $request->package_id,
                        'subscribe_status' => 'hold',
                        'price' => $package->package_price,
                        'is_paid' => false,
                        'package_data' => $package->toJson(),
                        'subscribed_at' => now(),
                        'end_at' => now()->addMonths(($package->duration + $package->free_duration)),
                        'price' => $package->package_price,
                    ]);
                    $driver_data += ['subscribed_package_id' => $subscribed_package->id , 'is_on_default_package' => false];
                }
                $user->driver()->create($driver_data);
            }

            if (setting('use_sms_service') == 'enable') {
                $message = trans('api.auth.verified_code_is',['code' => $code]);
                $response = send_sms($user->phone, $message);

                if (setting('sms_provider') == 'hisms' && $response['response'] != 3) {
                    $user->forceDelete();
                    $sms_response = $response['result'];
                    return response()->json(['status' => 'fail','data'=> null ,'message'=> "لم يتم حفظ رجاء التحقق من البيانات ( ".$sms_response." )" ], 422);
                }else{
                    if ($user->user_type == 'driver') {
                        $admin_data = [
                            'title' => ['dashboard.messages.new_register_driver_title'],
                            'body' => ['dashboard.messages.new_register_driver_body',['driver' => $user->fullname]],
                            'route' => route('dashboard.driver.show',$user->id),
                            'driver_id' => $user->id,
                            'notify_type' => 'new_register',
                        ];
                        $admins = User::whereIn('user_type',['admin' , 'superadmin'])->get();
                        \Notification::send($admins,new GeneralNotification($admin_data));
                    }
                }
            }
            // DB::commit();

          return response()->json(['status' => 'success','data'=> null ,'message'=>"تم التسجيل بنجاح  رجاء تفعيل حسابك ",'dev_message' => $code ], 200);
        // } catch(\Exception $e){
        //     // DB::rollback();
        //     \Log::info($e->getMessage());
        //     return response()->json(['status' => 'fail','data'=> null ,'message'=> "لم يتم التسجيل حاول مرة أخرى"] ,422);
        // }
    }



     /**
      * login
      */
     public function login(LoginRequest $request)
     {
         if (!$token = auth('api')->attempt($this->getCredentials($request))) {
            return response()->json(['status' => 'fail', 'data' => null,'is_active' => false , 'is_ban' => false, 'message' => trans('api.auth.failed')],401);
        }

        $user = auth('api')->user();
        if (! $user->is_active) {
            auth('api')->logout();

            return response()->json([
              'status' => 'fail',
              'data' => null,
              'message' => "هذا الحساب غير مفعل ",
              'is_active' => false ,
              'is_ban' => false,
              'dev_message' => $user->verified_code
            ], 403);
          }elseif ($user->is_ban) {
            auth('api')->logout();
            return response()->json([
              'status' => 'fail',
              'data' => null,
              'message' => "هذا الحساب تم حظرة من قبل الادارة لـ " .$user->ban_reason,
              'is_active' => true ,
              'is_ban' => true
            ], 403);
          }
        if (in_array($user->user_type , ['admin','superadmin'])) {
          auth('api')->logout();
          return response()->json(['status' => 'fail','data'=> null ,'message'=> "محاولة تسجيل بحساب ادمن"]);
        }
        if (!$user->referral_code) {
            $user->update(['referral_code' => generate_unique_code(8,'\\App\\Models\\User','referral_code','alpha_numbers','lower')]);
        }
         $user->devices()->firstOrCreate($request->only(['device_token','type']));
         if ($user->user_type == 'driver') {
             $user->driver()->updateOrCreate(['user_id' => $user->id],['lat' => $request->lat , 'lng' => $request->lng , 'location' => $request->location , 'type' => $request->type , 'device_token' => $request->device_token]);
             // auth('api')->logoutOtherDevices($request->password);
             // $user->devices()->where('device_token',"<>",$request->device_token)->delete();
         }
         $user->profile()->update(['last_login_at' => now()]);
         data_set($user,'token' , $token);
         return (new UserProfileResource($user))->additional(['status' => 'success','message'=>'']);
     }


     //To Confirmation Email
    public function confirm(CodeApiRequest $request)
    {
        $user = User::where(['verified_code'=>$request->code,'phone'=>$request->phone])->whereNull('phone_verified_at')->first();
        if (! $user) {
          return response()->json(['status' => 'fail','data'=> null ,'message'=> "الكود غير صحيح"] , 404);
        }
        $user->update(['is_active'=> 1 , 'verified_code' => null ,'phone_verified_at' => now()]);
        $user->devices()->firstOrCreate($request->only(['device_token','type']));
        $token = auth('api')->login($user);
        if ($user->user_type == 'driver') {
            $driver_data = ['lat' => $request->lat , 'lng' => $request->lng , 'location' => $request->location , 'type' => $request->type , 'device_token' => $request->device_token,'user_id' => $user->id];
            if (setting('register_in_elm') == 'after_register') {
                $elm_reply = $this->registerDriver($user);
                $driver_data += ['elm_reply' => $elm_reply];
                if (@$elm_reply['resultCode'] == 'success') {
                    $driver_data += ['is_signed_to_elm' => true];
                }
            }
            $user->driver()->updateOrCreate(['user_id' => $user->id],$driver_data);
        }
        $user->profile()->update(['last_login_at' => now()]);
        data_set($user,'token' , $token);
        return (new UserProfileResource($user))->additional(['status' => 'success','message'=>'']);

    }

     /**
      * Log the user out (Invalidate the token).
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function logout(LogoutRequest $request)
     {
        if (auth('api')->check()) {
            $user = auth('api')->user();
          $device = Device::where(['user_id'=>auth('api')->id(),'device_token' => $request->device_token , 'type' => $request->type ])->first();
          if ($device) {
              $device->delete();
          }
          if(auth('api')->user()->user_type == 'driver'){
              $user->driver()->update(['type' => null , 'device_token' => null]);
          }
          $user->profile()->update(['last_login_at' => null]);
          auth('api')->logout();
          return response()->json(['status' => 'success','data'=> null ,'message'=> "تم تسجيل الخروج بنجاح"]);
        }

     }

     // Forget Password
     public function sendCode(SendRequest $request)
      {
        $user = User::where('phone',$request->phone)->first();
        if (! $user) {
          return response()->json(['status' => 'fail','data'=> null ,'message'=> "رقم الجوال غير صحيح"]);
        }
        try{
          if ($user->phone_verified_at || $user->email_verified_at) {
              $code = 1111;
              if (setting('use_sms_service') == 'enable') {
                  $code = mt_rand(1111,9999);//generate_unique_code(4,'\\App\\Models\\User','reset_code');
                  $message = trans('api.auth.reset_code_is',['code' => $code]);
                  $response = send_sms($user->phone, $message);
              }
              $user->update(['reset_code' => $code]);
              return response()->json(['status' => 'success','data'=> null ,'message'=>"تم الارسال بنجاح",'is_active' => true ,'dev_message' => $code ]);
          }else {
              $code = 1111;
              if (setting('use_sms_service') == 'enable') {
                  $code = mt_rand(1111,9999);//generate_unique_code(4,'\\App\\Models\\User','verified_code');
                  $message = trans('api.auth.verified_code_is',['code' => $code]);
                  $response = send_sms($user->phone, $message);
              }
              $user->update(['verified_code' => $code , 'is_active' => 0]);

              return response()->json(['status' => 'success','data'=> null ,'message'=>"تم الارسال بنجاح" ,'is_active' => false ,'dev_message' => $code]);
          }
        }catch(\Exception $e){
          return response()->json(['status' => 'fail','data'=> null ,'message'=> "لم يتم الارسال"]);
        }

      }

      public function checkCode(CheckRequest $request)
      {
          $user = User::where(['phone'=>$request->phone])->first();
          if (! $user) {
              return response()->json(['status' => 'fail','data'=> null ,'message'=>trans('api.auth.user_not_found')],404);
          }elseif (!$user->phone_verified_at && $user->verified_code == $request->code) {
              return response()->json(['status' => 'success','data'=> null ,'message'=>"الكود المدخل صحيح" ,'is_active' => false],404);
          }elseif ($user->phone_verified_at && $user->reset_code == $request->code) {
              return response()->json(['status' => 'success','data'=> null ,'message'=>"الكود المدخل صحيح" ,'is_active' => true]);
          }
          return response()->json(['status' => 'success','data'=> null ,'message'=>"رجاء تفعيل الحساب أولا" ,'is_active' => true]);
      }

      public function resetPassword(ChangeRequest $request)
      {
          $user = User::where(['phone' => $request->phone , 'reset_code' => $request->code])->whereNotNull('phone_verified_at')->first();
          if (! $user) {
              return response()->json(['status' => 'fail','data'=> null ,'message'=>"رقم الهاتف غير صحيح أو الحساب غير مفعل"]);
          }
          $user->update(['password' => $request->password , 'reset_code' => null ]);
          return response()->json(['status' => 'success','data'=> null ,'message'=>"تم تغيير كلمة المرور بنجاح" ]);
      }


     protected function getCredentials(Request $request)
     {
         $username = $request->username;
         $credentials =[];
         switch ($username) {
           case filter_var($username, FILTER_VALIDATE_EMAIL):
               $username = 'email';
             break;
           case is_numeric($username):
                 $username = 'phone';
                 break;
           default:
                $username = 'email';
             break;
         }
        $credentials[$username] = $request->username;
        $credentials['password'] = $request->password;
        // $credentials['is_active'] = 1;
        return $credentials;
     }

}
