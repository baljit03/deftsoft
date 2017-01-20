<?php

namespace App\Http\Controllers;

use App\User;
use App\PasswordReset;
use Mail;
use DB;
use Auth;
use Hash;
use View;
use Request;
use Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {

    /**
     * Show Login
     */
    public function showLogin() {
        if (Auth::check()) {
            return Redirect::to('admin/dashboard');
        } else {
            return View::make('admin/login');
        }
    }

    /*     * *
     * Do Login Info
     */

    public function doLogin() {
        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        // validate the info, create rules for the inputs
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|alphaNum'
        );
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form with errors
        if ($validator->fails()) {
            return Redirect::to('admin/login')->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $userdata = array(
                'email' => Input::get('email'),
//                'password' => bcrypt(Input::get('password'))
                'password' => Input::get('password')
            );

            $user = User::where('email', $userdata['email'])->where("status", "active")->first();

            if (!empty($user)) {
                //if login attempt successful
                if (Auth::attempt($userdata)) {
                    $cookie_name = "deftsoft";
                    if (!isset($_COOKIE[$cookie_name])) {
                        $cookie_value = $userdata['email'] . '|' . $userdata['password'];
                        setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
                    }
                    return Redirect::to('admin/dashboard'); //redirect to dashboard
                } else {
                    $validator = "Username or password incorrect.";
                    // validation not successful, send back to form
                    return Redirect::to('admin/login')->withErrors($validator)->withInput(Input::except('password'));
                }
            } else {
                $validator = "Username or password incorrect.";
                return Redirect::to('admin/login')->withErrors($validator);
            }
        }
    }

    /**
     *  Change Password Page
     */
    public function changePassword() {
        if (Auth::check()) {

            return View::make('admin/password');
        } elseif (!empty(Input::get('ref')) && !empty(Input::get('key'))) {

            $key = Input::get('key');
            $ref = Input::get('ref');

            return View::make('admin/password')->with('key', $key)->with('ref', $ref);
        } else {
            return Redirect::to('login');
        }
    }

    /**
     *  Process Password Change Information
     */
    public function updatePassword() {
        if (Auth::check()) {

            /**
             *  Validation Rules
             *  Passwords must match.
             *
             * @lines 134-144
             */
            $rules = array(
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password'
            );
            $messages = array(
                'required' => 'The :attribute is required.',
                'same' => 'The :others must match.',
                'min' => 'The :attribute must be at least 6 characters.'
            );

            $validator = Validator::make(Input::all(), $rules, $messages);

            //grab password data
            $userdata = array(
                'password' => Input::get('password'),
                'confirm_password' => Input::get('confirm_password')
            );

            if ($validator->fails()) {

                $this->log_attempts('Password change attempt failed.', Auth::user()->id); //log into UserHistory Model

                return Redirect::to('change-password')->withErrors($validator)->withInput(Input::except('password', 'confirm_password'));
            } else {
                $new_password = Hash::make($userdata['confirm_password']); //hash new password

                $update_password = User::where('email', Auth::user()->email)->update(['password' => $new_password]); //add hashed password to database

                if ($update_password) {

                    $this->log_attempts('Password change attempt successful.', Auth::user()->id); //log into UserHistory Model
                    return Redirect::to('dashboard');
                } else {

                    $this->log_attempts('Password change attempt failed.', Auth::user()->id); //log into UserHistory Model
                    return Redirect::to('change-password');
                }
            }
        } else {

            $rules = array(
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password'
            );
            $messages = array(
                'required' => 'The :attribute is required.',
                'same' => 'The :others must match.',
                'min' => 'The :attribute must be at least 6 characters.'
            );

            $validator = Validator::make(Input::all(), $rules, $messages);

            //grab password data
            $userdata = array(
                'password' => Input::get('password'),
                'confirm_password' => Input::get('confirm_password'),
                'token' => Input::get('ref'),
                'key' => Input::get('key'),
            );

            $resetRequest = DB::table('password_resets')->where('key', $userdata['key'])->where('token', $userdata['token'])->where('active', 1)->orderBy('created_at', 'DESC')->value('user_id');

            if ($validator->fails()) {

                return Redirect::to('password-reset')->withErrors($validator)->withInput(Input::except('password', 'confirm_password'));
            } else {

                $new_password = Hash::make($userdata['confirm_password']); //hash new password

                $user = User::find($resetRequest);

                $update_password = $user->update(['password' => $new_password]); //add hashed password to database

                if ($update_password) {

                    event(new \App\Events\SuccessfulPasswordReset($user));
                    //$this->log_attempts('Password change attempt successful.', $resetRequest); //log into UserHistory Model
                    return Redirect::to('dashboard');
                } else {
                    $this->log_attempts('Password change attempt failed.', $resetRequest); //log into UserHistory Model
                    return Redirect::to('change-password');
                }
            }
        }
    }

    /**
     *  Request Password Reset
     */
    public function forgotPassword() {
        $method = Request::method();
        if (Request::isMethod('post')) {


            // validate the info, create rules for the inputs
            $rules = array(
                'email' => 'required|exists:users'
            );
            $messages = array(
                'email.exists' => 'Sorry, we could not find that account!',
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make(Input::all(), $rules, $messages);

            // if the validator fails, redirect back to the form with errors
            if ($validator->fails()) {

                return View::make('admin/forgotpass', ['errors' => $validator->errors()]);
            } else {

                $reset_pwdlink_token = $this->generateRandomString();
                // $password = Hash::make($ManualPassword);
                $updated = ['reset_password_token' => $reset_pwdlink_token, 'reset_password_time' => date('Y-m-d H:i:s')];

                DB::table('users')->where('email', $_POST['email'])->update($updated);

                //send mail for setup his account for all types user

                $resetLinkUrl = $_SERVER['HTTP_HOST'] . '/reset-password/' . $reset_pwdlink_token;

                $user = DB::table('users')->where('email', $_POST['email'])->first();
                $Data = array('reset_link' => $resetLinkUrl, 'userinfo' => $user);
                $email = $_POST['email'];

                Mail::send('emails.passwordreset', ['user' => $Data], function ($m) use ($email) {
                    $m->from('noreply@oncallms.com', 'OnCall Management');
                    $m->to('patrickphp4@gmail.com')->subject('Password Reset Request - OnCall Management Systems');
                });

                return View::make('admin/forgotpass', ['message' => 'You have successfully requested a password reset! Please Check Your Email!']);
            }
        } else {
            return View::make('admin/forgotpass');
        }
    }

    /**
     *  Log Information Into UserHistory Model
     *
     */
    public function online_status($user_id) {
        $updated = ['online_status' => 1];

        DB::table('users')->where('id', $user_id)->update($updated);
    }

    public function offline_status($user_id) {
        $updated = ['online_status' => 0];

        DB::table('users')->where('id', $user_id)->update($updated);
    }

    public function log_attempts($activity, $user_id) {

        /**
         *  Grab Real IP  -  Skip proxy
         */
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $ip = $_SERVER['REMOTE_ADDR'];

        $log = new UserHistory; //initiate Model
        $log->user_id = $user_id;
        $log->activity = $activity;
        $log->ip = $ip;
        $log->browser = $_SERVER['HTTP_USER_AGENT'];

        $log->referral = isset($_SERVER["HTTP_REFERER"]) && !empty($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';


        $log->save(); //save
    }

    /*     * *
     * Logout 
     */

    public function logout() {
        Auth::logout();
        return Redirect::to('admin/login');
    }

}
