<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\MetaTag;

use Auth;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
//use Artesaos\SEOTools\Facades\SEOTools;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $meta = MetaTag::where('page', 'Login')->first();

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

        $title = 'Login';

        return view('auth.login', compact('title'));
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush(); // flush() vs invalidate()

        $message = "You've been logged out.";

        return redirect('/login')->withLogout($message);
    }
}
