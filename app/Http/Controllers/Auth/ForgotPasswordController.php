<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

use App\User;

use DB;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

use App\MetaTag;

use App\Mail\ForgotPasswordEmail;
use App\Mail\PasswordChangedEmail;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
//use Artesaos\SEOTools\Facades\SEOTools;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        $meta = MetaTag::where('page', 'Forgot_Password')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/');
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl('https://prestinecleaners.co.uk/');
        OpenGraph::addProperty('type', 'company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('Company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

        $title = 'Forgot Password';

        return view('auth.passwords.email', compact('title'));
    }

    public function forgotPass(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!isset($user) || empty($user)) {
            return back()->withErrors('This email does not exist in the system.');   
        }

        
        $to = $user->email;
        $code = Str::random(32);
            
        $objPass = new \stdClass();
        $objPass->name = $user->name;
        $objPass->email = $user->email;
        $objPass->code = $code;

        DB::table('password_resets')
        ->insert([
            'email' => $to, 
            'token' => $code, 
            'status' => 0,
            'created_at' => Carbon::now(), 
        ]);

        try {

            Mail::to($user->email)->send(new ForgotPasswordEmail($objPass));

        } catch(\Exception $e) {
            
            return back()->withErrors('Email could not be delivered. Please try again.'); 
        }

        return back()->with('success', 'Password reset email sent successfully.');

    }

    public function resetLink($token)
    {
        $reset = DB::table('password_resets')
                    ->where('token', $token)
                    ->orderBy('created_at', 'DESC')
                    ->first();

        if(!isset($reset) || empty($reset)) {
            return redirect()->route('password.request')->withErrors('Your password reset link appears to be invalid. Please request a new link.');   
        }

        if($reset->status == 1)
        {
            return redirect()->route('password.request')->withErrors('You have tried to use an old one-time password reset link that has expired. Please request a new link.');
        }

        view()->share('reset', $reset);

        $title = "Reset Password";

        return view('auth.passwords.reset', compact('title'));

    }

    public function passwordReset(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|string|email',
            'token' => 'required|string',
            'password' => 'required|string|min:6|max:50|confirmed'
        ]);

        $reset = DB::table('password_resets')
                    ->where('email', $request->email)
                    ->where('token', $request->token)
                    ->orderBy('created_at', 'DESC')
                    ->first();

        if(!isset($reset) || empty($reset)) {
            return redirect()->back()->withErrors('Your password reset link appears to be invalid. Please request a new link.');
        }

        if($reset->status == 1) {
            return redirect()->back()->withErrors('You have tried to use an old one-time password reset link that has expired. Please request a new link.');   
        }

        if($request->password == $request->password_confirmation)
        {
            $user = User::where('email', $request->email)->first();

            if(!isset($user) || empty($user)) {
                return redirect()->back()->withErrors('User not found!');
            }

            $user->password = bcrypt($request->password);
            $user->save();

            DB::table('password_resets')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->update([
                    'status' => 1
                ]);

            $objChange = new \stdClass();
            $objChange->name = $user->name;
            $objChange->email = $user->email;

            try {

                Mail::to($user->email)->send(new PasswordChangedEmail($objChange));

            } catch(\Exception $e) {
                // get error here
                echo $e->getMessage();
            }

            return redirect()->route('login')->with('success', 'Your password has changed successfully.');
        } else {
            return redirect()->back()->withErrors('Password and confirmed password does not match.');   
        }
      
    }
}
