<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Mail\NewAccountEmail;

use Mail;
use Session;

use App\MetaTag;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
//use Artesaos\SEOTools\Facades\SEOTools;

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

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $meta = MetaTag::where('page', 'Register')->first();

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
        
        $title = "Sign Up";

        return view('auth.register', compact('title'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'phone' => ['required', 'string', 'min:6', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $objAccount = new \stdClass();
        $objAccount->name = ucwords($data['name']);
        $objAccount->email = $data['email'];
        $objAccount->password = $data['password'];

        // Welcome Mail to Client
        try {

            Mail::to($data['email'])->send(new NewAccountEmail($objAccount));

        } catch(\Exception $e) {
            // get error here
            echo $e->getMessage();
        }

        Session::flash('success-new', 'Welcome to <b>Prestine Cleaners</b> - we are excited you are here!');

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
