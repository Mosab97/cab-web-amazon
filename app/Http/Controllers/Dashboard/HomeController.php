<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Brand, City, Country, User, CarModel, CarType, Car, Order, Package, PackageDriver, Driver};
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!request()->ajax()) {
            $data = [];
            //     Carbon::setWeekStartsAt(Carbon::SATURDAY);
            //     Carbon::setWeekEndsAt(Carbon::FRIDAY);
            // //statistics
            $data['countries_count'] = Country::count();
            $data['cities_count'] = City::count();
            $data['brands'] = Brand::latest()->get();
            $data['brands_count'] = $data['brands']->count();
            $data['car_models'] = CarModel::latest()->get();
            $data['car_models_count'] = $data['car_models']->count();
            //
            $data['car_types_count'] = CarType::latest()->count();
            $data['cars'] = Car::latest()->get();
            $data['cars_count'] = $data['cars']->count();
            $data['packages'] = Package::latest()->get();
            $data['active_packages'] = $data['packages']->where('is_active', 1)->count();
            //
            $data['orders'] = Order::latest()->get();
            $data['wallet_orders_count'] = Order::where('is_paid_by_wallet', true)->count();
            $data['cash_orders_count'] = Order::where('is_paid_by_wallet', false)->orWhereNull('is_paid_by_wallet')->count();
            $data['orders_count'] = $data['orders']->count();
            $data['pending_orders_count'] = $data['orders']->whereIn('order_status', ['pending', 'client_recieve_offers'])->count();
            $data['canceled_orders_count'] = $data['orders']->whereIn('order_status', ['client_cancel', 'admin_cancel', 'driver_cancel'])->count();
            $data['finished_orders_count'] = $data['orders']->whereIn('order_status', ['client_finish', 'admin_finish', 'driver_finish'])->count();
            $data['today_client_finished_orders'] = Order::latest()->whereDate('created_at', date("Y-m-d"))->where('order_status', 'client_finish')->count();
            $data['today_driver_finished_orders'] = Order::latest()->whereDate('created_at', date("Y-m-d"))->where('order_status', 'driver_finish')->count();
            $data['today_admin_finished_orders'] = Order::latest()->whereDate('created_at', date("Y-m-d"))->where('order_status', 'admin_finish')->count();
            $data['today_finished_orders'] = Order::latest()->whereDate('created_at', date("Y-m-d"))->whereIn('order_status', ['admin_finish', 'client_finish', 'driver_finish'])->count();
            $data['app_commission'] = $data['orders']->whereIn('order_status', ['client_finish', 'driver_finish', 'admin_finish'])->sum('app_commission');

            $data['finished_orders_percent'] = number_format(($data['orders']->whereIn('order_status', ['client_finish', 'driver_finish', 'admin_finish'])->count() / ($data['orders']->count() > 0 ? $data['orders']->count() : 1)) * 100, 2);

            $data['new_orders'] = Order::latest()->whereIn('order_status', ['pending', 'client_recieve_offers'])->paginate(10);
            $data['current_orders'] = Order::latest()->whereIn('order_status', ['shipped', 'start_trip', 'pre_client_accept_start'])->paginate(10);
            $data['finished_orders'] = Order::latest()->whereIn('order_status', ['driver_finish', 'client_finish', 'admin_finish'])->paginate(10);
            //
            $data['managers_count'] = User::where('user_type', 'admin')->latest()->count();

            $clients = \DB::table('users')->where('user_type', 'client')->get();
            $data['clients_is_with_special_needs_count'] = $clients->where('is_with_special_needs', 1)->count();
            $data['clients_count'] = $clients->count();
            $data['clients_is_ban_count'] = $clients->where('is_ban', 1)->count();
            $data['clients_is_active_count'] = $clients->where('is_active', 0)->count();

            $drivers = \DB::table('users')->where('user_type', 'driver')->get();
            $data['drivers_count'] = $drivers->count();
            $data['drivers_is_active_count'] = $drivers->where('is_active', 0)->count();
            $data['drivers_is_ban_count'] = $drivers->where('is_ban', 1)->count();
            $data['drivers_is_with_special_needs_count'] = $drivers->where('is_with_special_needs', 1)->count();

            $data['wait_accept_drivers'] = \DB::table('users')->where('user_type', 'driver')->join('drivers', function ($join) {
                $join->on('users.id', '=', 'drivers.user_id')
                    ->where('is_admin_accept', 0)->where(function ($q) {
                        $q->whereNull('accepted_status')->orWhere('accepted_status', 'waiting');
                    });
            })->count();
            $data['refused_drivers'] = \DB::table('users')->where('user_type', 'driver')->join('drivers', function ($join) {
                $join->on('users.id', '=', 'drivers.user_id')->where('is_admin_accept', 0)->where('accepted_status', 'refused');
            })->count();

            $data['accepted_drivers'] = \DB::table('users')->where('user_type', 'driver')->join('drivers', function ($join) {
                $join->on('users.id', '=', 'drivers.user_id')->where('is_admin_accept', 1);
            })->count();

            // $data['paid_drivers'] = User::where('user_type' , 'driver')->whereHas('subscribedPackage',function ($q) {
            //     $q->whereDate('package_drivers.end_at',">",date("Y-m-d"))->where('is_paid',1);
            // })->count();

            $data['both_type_drivers'] = \DB::table('users')->where('user_type', 'driver')->join('drivers', function ($join) {
                $join->on('users.id', '=', 'drivers.user_id')->where('driver_type', 'both');
            })->count();
            $data['delivery_drivers'] = \DB::table('users')->where('user_type', 'driver')->join('drivers', function ($join) {
                $join->on('users.id', '=', 'drivers.user_id')->where('driver_type', 'delivery');
            })->count();
            $data['ride_drivers'] = \DB::table('users')->where('user_type', 'driver')->join('drivers', function ($join) {
                $join->on('users.id', '=', 'drivers.user_id')->where('driver_type', 'ride');
            })->count();

            // $data['available_drivers'] = \DB::table('users')->where('user_type' , 'driver')->join('drivers', function ($join) {
            //         $join->on('users.id', '=', 'drivers.user_id')->where('drivers.is_on_default_package',1)->where(['drivers.is_available' => 1 , 'drivers.is_driver_available' => 1 , 'drivers.is_admin_accept' => 1])->where('users.wallet',">",-((float)setting('min_wallet_to_recieve_order')));
            // })->count();


            $data['drivers_not_subscribes'] = User::where('user_type', 'driver')->whereDoesntHave('driverPackages')->count();

            $data['drivers_subscribed_this_week'] = User::where('user_type', 'driver')->whereHas('driverPackages', function ($q) {
                $q->whereBetween('subscribed_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })->count();

            $from_date = now()->subMonths(11)->format('Y-m-d');
            $to_date = now()->format('Y-m-d');
            if ($request->from_date && $request->to_date) {
                $from_date = \Carbon\Carbon::parse($request->from_date)->format('Y-m-d');
                $to_date = \Carbon\Carbon::parse($request->to_date)->format('Y-m-d');
            } elseif ($request->from_date) {
                $from_date = \Carbon\Carbon::parse($request->from_date)->format('Y-m-d');
            } elseif ($request->to_date) {
                $to_date = \Carbon\Carbon::parse($request->to_date)->format('Y-m-d');
            }
            // $data['from_date'] = clone($from_date);
            // $data['to_date'] = clone($to_date);
            // <==============================Charts============================>
            $client_analytics = $clients->when($request->from_date || $request->to_date, function ($collection) use ($from_date, $to_date) {
                if ($from_date && $to_date) {
                    return $collection->filter(function ($item) use ($from_date, $to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date && Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($from_date) {
                    return $collection->filter(function ($item) use ($from_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($to_date) {
                    return $collection->filter(function ($item) use ($to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date) {
                            return $item;
                        }
                    });
                }
            })->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
            });

            $driver_analytics = $drivers->when($request->from_date || $request->to_date, function ($collection) use ($from_date, $to_date) {
                if ($from_date && $to_date) {
                    return $collection->filter(function ($item) use ($from_date, $to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date && Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($from_date) {
                    return $collection->filter(function ($item) use ($from_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($to_date) {
                    return $collection->filter(function ($item) use ($to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date) {
                            return $item;
                        }
                    });
                }
            })->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
            });


            $order_analytics = $data['orders']->when($request->from_date || $request->to_date, function ($collection) use ($from_date, $to_date) {
                if ($from_date && $to_date) {
                    return $collection->filter(function ($item) use ($from_date, $to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date && Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($from_date) {
                    return $collection->filter(function ($item) use ($from_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($to_date) {
                    return $collection->filter(function ($item) use ($to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date) {
                            return $item;
                        }
                    });
                }
            })->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
            });

            $brand_analytics = $data['brands']->when($request->from_date || $request->to_date, function ($collection) use ($from_date, $to_date) {
                if ($from_date && $to_date) {
                    return $collection->filter(function ($item) use ($from_date, $to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date && Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($from_date) {
                    return $collection->filter(function ($item) use ($from_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($to_date) {
                    return $collection->filter(function ($item) use ($to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date) {
                            return $item;
                        }
                    });
                }
            })->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
            });

            $car_analytics = $data['cars']->when($request->from_date || $request->to_date, function ($collection) use ($from_date, $to_date) {
                if ($from_date && $to_date) {
                    return $collection->filter(function ($item) use ($from_date, $to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date && Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($from_date) {
                    return $collection->filter(function ($item) use ($from_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($to_date) {
                    return $collection->filter(function ($item) use ($to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date) {
                            return $item;
                        }
                    });
                }
            })->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
            });
            $car_model_analytics = $data['car_models']->when($request->from_date || $request->to_date, function ($collection) use ($from_date, $to_date) {
                if ($from_date && $to_date) {
                    return $collection->filter(function ($item) use ($from_date, $to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date && Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($from_date) {
                    return $collection->filter(function ($item) use ($from_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") >= $from_date) {
                            return $item;
                        }
                    });
                } elseif ($to_date) {
                    return $collection->filter(function ($item) use ($to_date) {
                        if (Carbon::parse($item->created_at)->format("Y-m-d") <= $to_date) {
                            return $item;
                        }
                    });
                }
            })->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
            });

            $diffInMonths = \Carbon\Carbon::parse($from_date)->diffInMonths(\Carbon\Carbon::parse($to_date));
            $months_arr = [];
            for ($i = 0; $i <= $diffInMonths; $i++) {
                $months_arr[] = \Carbon\Carbon::parse($from_date)->addMonths($i)->format("Y-m");
                if ($i == 0) {
                    if (isset($client_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')])) {
                        $data['client_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = $client_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')]->count();
                    } else {
                        $data['client_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = 0;
                    }
                    if (isset($driver_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')])) {
                        $data['driver_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = $driver_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')]->count();
                    } else {
                        $data['driver_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = 0;
                    }

                    if (isset($order_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')])) {
                        $data['order_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = $order_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')]->count();
                    } else {
                        $data['order_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = 0;
                    }
                    if (isset($brand_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')])) {
                        $data['brand_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = $brand_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')]->count();
                    } else {
                        $data['brand_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = 0;
                    }
                    if (isset($car_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')])) {
                        $data['car_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = $car_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')]->count();
                    } else {
                        $data['car_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = 0;
                    }
                    if (isset($car_model_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')])) {
                        $data['car_model_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = $car_model_analytics[\Carbon\Carbon::parse($to_date)->format('Y-m')]->count();
                    } else {
                        $data['car_model_analytics'][\Carbon\Carbon::parse($to_date)->format('Y-m')] = 0;
                    }
                } else {
                    if (isset($client_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')])) {
                        $data['client_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = $client_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')]->count();
                    } else {
                        $data['client_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = 0;
                    }
                    if (isset($driver_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')])) {
                        $data['driver_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = $driver_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')]->count();
                    } else {
                        $data['driver_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = 0;
                    }

                    if (isset($order_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')])) {
                        $data['order_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = $order_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')]->count();
                    } else {
                        $data['order_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = 0;
                    }
                    if (isset($brand_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')])) {
                        $data['brand_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = $brand_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')]->count();
                    } else {
                        $data['brand_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = 0;
                    }
                    if (isset($car_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')])) {
                        $data['car_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = $car_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')]->count();
                    } else {
                        $data['car_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = 0;
                    }
                    if (isset($car_model_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')])) {
                        $data['car_model_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = $car_model_analytics[\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')]->count();
                    } else {
                        $data['car_model_analytics'][\Carbon\Carbon::parse($to_date)->subMonths($i)->format('Y-m')] = 0;
                    }
                }
            }
            $data['months_arr'] = $months_arr;
            return view('dashboard.home.index', $data);
        }
    }

    // Search Method

    public function getSearch(Request $request)
    {
        $query = request()->search;
        $request->validate([
            'search' => 'required'
        ]);
        $user_query = User::latest();
        $clients = $user_query->where('user_type', 'client')->where(function ($q) use ($query) {
            $q->where('fullname', "LIKE", "%{$query}%")->orWhere('email', "LIKE", "%{$query}%")->orWhere('phone', "LIKE", "%{$query}%");
        });

        $drivers = $user_query->where('user_type', 'driver')->where(function ($q) use ($query) {
            $q->where('fullname', "LIKE", "%{$query}%")->orWhere('email', "LIKE", "%{$query}%")->orWhere('phone', "LIKE", "%{$query}%");
        });

        $admins = $user_query->where('user_type', 'admin')->where(function ($q) use ($query) {
            $q->where('fullname', "LIKE", "%{$query}%")->orWhere('email', "LIKE", "%{$query}%")->orWhere('phone', "LIKE", "%{$query}%");
        })->where('id', "<>", auth()->id());

        $brands = Brand::whereTranslationLike('name', "%{$query}%", 'ar')->orWhereTranslationLike('name', "%{$query}%", 'en')->orWhereTranslationLike('desc', "%{$query}%", 'ar')->orWhereTranslationLike('desc', "%{$query}%", 'en');

        $car_models = CarModel::whereTranslationLike('name', "%{$query}%", 'ar')->orWhereTranslationLike('name', "%{$query}%", 'en')->orWhereTranslationLike('desc', "%{$query}%", 'ar')->orWhereTranslationLike('desc', "%{$query}%", 'en');




        $search_type = 'client';
        if (array_key_exists('admin', $request->query()) || ($admins->count() && !$clients->count())) {
            $search_type = 'admin';
        } elseif (array_key_exists('driver', $request->query()) || (!$admins->count() && !$clients->count() && $drivers->count())) {
            $search_type = 'driver';
        } elseif (array_key_exists('brand', $request->query()) || (!$drivers->count() && !$clients->count() && !$admins->count() && $brands->count())) {
            $search_type = 'brand';
        } elseif (array_key_exists('car_model', $request->query()) || (!$drivers->count() && !$clients->count() && !$admins->count() && !$brands->count() && $car_models->count())) {
            $search_type = 'car_model';
        }

        $data = [
            'clients_count' => $clients->count(),
            'admins_count' => $admins->count(),
            'drivers_count' => $drivers->count(),
            'brands_count' => $brands->count(),
            'car_models_count' => $car_models->count(),

            'clients' => $clients->paginate(50, ['*'], 'client'),
            'admins' => $admins->paginate(50, ['*'], 'admin'),
            'drivers' => $drivers->paginate(50, ['*'], 'driver'),
            'brands' => $brands->paginate(50, ['*'], 'brand'),
            'car_models' => $car_models->paginate(50, ['*'], 'car_model'),
            'keyword' => $query,
            'search_type' => $search_type,
            'total_count' => $clients->count() + $admins->count()  + $brands->count()  + $car_models->count() + $drivers->count()
        ];
        return view('dashboard.search.search', $data);
    }


    //post setting
    public function postSetting(SettingRequest $request)
    {
        if (!request()->ajax()) {
            $inputs = $request->except('logo', 'password', '_token');
            if ($request->password) {
                $inputs['password'] = $request->password;
            }
            if ($request->hasFile('logo')) {
                $setting = Setting::where('key', 'logo')->first();
                $setting = ($setting && $setting->value) ? $setting : null;
                $inputs['logo'] = uploadImg($request->logo);
            }
            foreach ($inputs as $key => $value) {
                Setting::updateOrCreate(['key' => trim($key)], ['value' => $value]);
            }
            return redirect()->route('dashboard.setting.index')->withTrue("تم التعديل بنجاح ");
        } else {
            abort(404);
        }
    }
}
