<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Common\MailComponent;
use Mail;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
       // $this->mailer = new MailComponent();
    }


    public function dashboard()
    {
        $all = User::orderby('id', 'desc')->count();
        $active = User::where('status', 1)->count();
        $inactive = User::where('status', 0)->count();
        $data = [];
        $data['all'] = $all;
        $data['active'] = $active;
        $data['inactive'] = $inactive;
        return view("admin.index", ['data' => $data]);
    }


    public function index()
    {
        return view("admin.user.userlist");
    }


    public function user_list(Request $request)
    {

        $filter = array('id', 'name', 'email', 'createdDate', 'license_key', 'plan_id', 'status');
        $data = User::select('id', 'name', 'email', 'createdDate', 'license_key', 'plan_id', 'status', 'paddle_subscription_id');
        if (!empty($request->get('search'))) {
            $data = $data->orWhere('email', 'LIKE', '%' . $request->get('search')['value'] . '%')->orWhere('license_key', 'LIKE', '%' . $request->get('search')['value'] . '%');
        }
        if (!empty($request->get('order'))) {
            if ($request->get('order')[0]['column'] == 0) {
                $data = $data->orderby('id', 'desc');
            } else {
                $checkcolumn = $filter[$request->get('order')[0]['column']];
                $orderby = $request->get('order')[0]['dir'];
                $data = $data->orderby($checkcolumn, $orderby);
            }
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('license', function ($row) {
                return $row->license_key;
            })
            ->addColumn('createdDate', function ($row) {
                return $row->createdDate;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<input type="checkbox" ' . (($row->status == 1) ? "checked" : "") . '  class="switchery user_status"    data-size="small" data-value="' . $row->id . '"  >';
                } else {
                    return '<input type="checkbox" ' . (($row->status == 1) ? "checked" : "") . '  class="switchery user_status"    data-size="small" data-value="' . $row->id . '"  >';
                }
            })
            ->addColumn('action', function ($row) {

                $btn = '<div class="btn-group dropdown-split-primary">
                    <button type="button" style="background: inherit;border: inherit;"class="dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-gears" style="font-size: 33px;color: #af5e9d;"></i></button>
                    </button>
                    <div class="dropdown-menu" style="will-change: transform;">';

                $btn .= '<a class="dropdown-item waves-effect waves-light" href="' . route('user.user_edit', ['id' => $row->id]) . '">View</a>';
                    $btn .= '<a class="dropdown-item waves-effect waves-light" href="#" onclick="deleteuser('.$row->id.')">User Delete</a>';
               

                // $btn .= '<div class="dropdown-divider"></div>
                //     <a class="dropdown-item waves-effect waves-light"  href="' . route('user.sendlicence', ['id' => $row->id]) . '">Send Licence</a>';
                $btn .= '</div>
                    </div>';

                return $btn;
            })
            ->rawColumns(['DT_RowIndex', 'email', 'license', 'subscription_id', 'createdDate', 'status', 'action'])
            ->toJson(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userregisterform()
    {
        return view("admin.auth.register");
    }


    public function userregistersubmit(Request $request)
    {
        $check = User::where('email', $request->email)->first();
        if ($check) {
            Session::flash('error', 'User Already Register.');
            return redirect()->route('admin.user.register');
        }
        
        $lic = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password_pool = 'bcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $licence = substr(str_shuffle(str_repeat($lic, 4)), 0, 16);
        $data = $request->all();
        $reseller_id = Auth::guard('admin')->user()->id;
        $user = User::insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($request->password),
             'new_password' =>  Hash::make($request->password),
            'license_key' => $licence,
            'status' => 1,
            'role' => 'subscriber',
            'started_on' => Carbon::now(),
            'expired_on' => Carbon::now()->addMonth(1),
            'createdDate' => Carbon::now(),
            'updatedDate' => Carbon::now()
        ]); //inserting data
        if ($user) {
            Session::flash('success', 'user Add Succesfully.');
           // $this->mailer->sendWelcomeMailNew($data['email'], $password, //$data['name'], $licence);
        } else {
            Session::flash('error', 'Unable to add User.');
        }
        return redirect()->route('admin.user.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function active_inactive($id, $state)
    {
        $user = User::where('id', $id)->first();
        $user->status = $state;
        $user->save();
        if ($user) {
            if ($user->status == 1) {
               // $this->mailer->SendActive($user);
                return 1;
            } else {
              //  $this->mailer->SendDeactive($user);
                return 1;
            }
        } else {
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function user_edit($id)
    {

        $userdetail = User::where('id', $id)
            ->first();
        return view("admin.user.user_detail", ['userdetail' => $userdetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function user_edit_submit(Request $request, $id)
    {
        $check = User::findOrFail($id);
        $data = $request->all();
        if ($check) {
            unset($data['_token']);
            unset($data['license']);
            //return $data;
            $status = User::whereId($id)->update($data);
            if ($status) {
                Session::flash('success', 'User update Succesfully.');
            } else {
                Session::flash('error', 'Unable to Update User.');
            }
        }
        return redirect()->back();

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function fb_account_delete(Request $request)
    {
        $status = LinkedFbAccount::where('id', $request->id)->delete();
        if ($status) {
           return 1;
        } else {
            return 0;
        }
    }

    public function updateSubscription($id)
    {

        $plans = Plan::select('id', 'name', 'plan_type', 'amount')->get();
        $userdetail = User::with([
            'plan' => function ($q) {
                $q->select('id', 'name');
            },
            'account' => function ($q) {
                $q->select('id', 'user_id', 'fb_account_id', 'is_primary')->first();
            },
            'planfeature' => function ($q) {
                $q->select('id', 'plan_id', 'tags', 'notes', 'reminders', 'templates', 'calendar_integration', 'fb_accounts');
            },
        ])->where('id', $id)->first();
        return view("admin.user.userplan", ['userdetail' => $userdetail, 'plans' => $plans]);
    }

    public function updateSubscriptionStore(Request $request, $id)
    {
        $validated = $request->validate([
            'plan_id' => 'required',
        ]);
        $check = User::with('plan')->findOrFail($id);
        $data = $request->all();
        
        if ($check) {
            $action = '';
            $plan_type = Plan::select('id', 'name', 'plan_type', 'amount')->where('id', $data['plan_id'])->first();
            if ($check->plan->plan_type == "monthly" && $check->plan->plan_type !=  $plan_type->plan_type) {
                $action = "upgraded";
            } elseif ($check->plan->plan_type == "lifetime" && $check->plan->plan_type != $plan_type->plan_type) {
                $action = "downgraded";
            } elseif ($check->plan->plan_type == "yearly" && $plan_type->plan_type == "monthly") {
                $action = "downgraded";
            } elseif ($check->plan->plan_type == "yearly" && $plan_type->plan_type == "lifetime") {
                $action = "upgraded";
            }

            if ($plan_type->plan_type == "monthly") {
                $expired_on = date('Y-m-d', strtotime('+1 month'));
            } elseif ($plan_type->plan_type == "yearly") {
                $expired_on = date('Y-m-d', strtotime('+1 year'));
            } elseif ($plan_type->plan_type == "lifetime" ) {
                $expired_on = date('Y-m-d', strtotime('+50 years'));
            }

            $data['expired_on'] = $expired_on; 
            // echo $check->plan->plan_type.' '.$data['expired_on'];
            // die;
            unset($data['_token']);
            unset($data['licence']);
            $status = User::where('id', $id)->update($data);
            if ($status) {
                $user = User::with('plan')->findOrFail($id);
              //  $this->mailer->sendUpgradeDowngradeMail($user, $action);
                Session::flash('success', 'User Plan Update Succesfully.');
            } else {
                Session::flash('error', 'Unable to Update User.');
            }
        }

        return redirect()->back();
    }

    public function subscription(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->status = $request->status;
       $user->save();
        if ($user) {
            // $this->mailer->SendActiveDeactive($user);
           if ($user->status == 1) {
              //  $this->mailer->SendActive($user);
                return 1;
            } else {
              //  $this->mailer->SendDeactive($user);
                return 1;
            }
        } else {
                return 0;
            }

        // return redirect()->back();
    }

    public function sendlicence($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            
            // $sendMail = $this->mailer->SendLicence($user);
            // print_r($sendMail);
            
            
            
            Session::flash('success', 'Licence Send Succesfully.');
        } else {
            Session::flash('error', 'Unable to Send Licence.');
        }

        return redirect()->back();
    }
    public function deleteUser(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->delete();
           echo 1;
        } else {
           echo 0;
        }
     }
}
