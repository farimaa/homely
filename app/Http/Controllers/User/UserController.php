<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getLogin()
    {
        return view('user.login');
    }

    public function postLogin(\App\Http\Requests\UserLogin $request)
    {
        if($request->always == 1){
            $login_time = 1440;
        }else{
            $login_time = 30;
        }
        if (\Auth::attempt(['status' => User::STATUS_ACTIVE, 'phone' => $request['phone'], 'password' => $request['password'] ], $login_time)) {
            \App\Models\UserLogin::create([
                'user_agent' => \Request::header('User-Agent'),
                'user_ip' => \Request::ip(),
                'user_id' => \Auth::id()
                ]);
            return redirect()->intended('/');
        }else{
            \Log::error('user cant login with phone: '. $request['phone']);
            
            return redirect()->back()->withErrors('Phone or password is incorrect.');
        }
    }

    public function getRegister()
    {
        return view('user.register');
    }

    public function postRegister(\App\Http\Requests\UserRegister $request)
    {
        $user = \App\Models\User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $request->session()->flash('alert-success', 'Register was successfull.');
        \Log::info('user register with phone: '. $request['phone']);
        if (\Auth::attempt(['phone' => $request['phone'], 'password' => $request['password'] ], 1440 )) {
            if(\Auth::user()->email){
                \Mail::to(\Auth::user()->email)->send(new \App\Mail\UserLogin());
            }
            return redirect()->intended('/');
        } 
    }

    public function postForgetPassword(Request $request)
    {
        \Validator::make($request->all(), [
            'phone' => 'required|exists:users,phone',
        ])->validate();

        $user = \App\Models\User::Active()->where('phone',$request['phone'])->first();
        if($user)
        {
            $code = $this->_random_string();
            $user->password =  bcrypt($code);
            $user->save();
            $request->session()->flash('alert-success', 'New Password is sent to your phone.');
            $this->_sms_forget_password($request['phone'],$code);
        }

        return redirect()->back();
    }

    private function _random_string()
    {
        $characters = '12345678';
        $randstring = '';
        for ($i = 0; $i < 3; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;
    }

    private function _sms_forget_password($phone,$pass_code)
    {
        $user = \App\Models\User::where('phone',$phone)->Active()->first();
        if($user)
        {
            $user->notify(new ForgetPassword($pass_code));

            ini_set("soap.wsdl_cache_enabled", "0");
            $sms_client = new \SoapClient(
                'http://payamak-service.ir/SendService.svc?wsdl'
                , array('encoding'=>'UTF-8'));
            try 
            {
                $x = $sms_client->SendSMS([ 
                    'userName' => self::SMS_USER,
                    'password' => self::SMS_PASS,
                    'fromNumber' => self::SMS_PHONE,
                    'toNumbers' => [$phone],
                    'messageContent' => self::NAME.': Your new password ' . $pass_code . '.',
                    'isFlash' => false,
                    'recId' => [],
                    // 'status' => []
                    ]);
                \Log::info('sms با متن فراموشی رمز عبور فرستاده شد به '.$phone.' با رمز عبور: '.$pass_code. $x->SendSMSResult);
            } 
            catch (Exception $e) 
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }

}
