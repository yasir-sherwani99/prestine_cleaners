<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Booking;
use App\Invoice;
use App\User;
use App\QuickMessage;

use Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $pagePath = 'dashboard';
        view()->share('pagePath', $pagePath);

        $stats = [];
        $stats['pending_bookings'] = Booking::where('user_id', Auth::user()->id)->where('is_booked', 0)->count();
        $stats['approve_bookings'] = Booking::where('user_id', Auth::user()->id)->where('is_booked', 1)->count();
        $stats['cancel_bookings'] = Booking::where('user_id', Auth::user()->id)->where('is_booked', 2)->count();
        $stats['total_invoices'] = Invoice::where('customer_id', Auth::user()->id)->where('is_draft', 0)->count();

        view()->share('stats', $stats);

        $recent_bookings = Booking::where('user_id', Auth::user()->id)->orderBy('cleaning_start_date', 'DESC')->limit(5)->get();
        view()->share('recent_bookings', $recent_bookings);

        $recent_invoices = Invoice::where('customer_id', Auth::user()->id)->where('is_draft', 0)->orderBy('created_at', 'DESC')->limit(5)->get();
        view()->share('recent_invoices', $recent_invoices);

        return view('client.home.index');
    }

    public function bookings()
    {
        $pagePath = 'bookings';
        view()->share('pagePath', $pagePath);

        $bookings = Booking::where('user_id', Auth::user()->id)->get();
        if(!isset($bookings) || empty($bookings)) {
            abort(404);
        }

        view()->share('bookings', $bookings);

        return view('client.bookings.index');
    }

    public function bookingCancel($booking_id)
    {
        $booking = Booking::find($booking_id);
        if(!isset($booking) || empty($booking)) {
            abort(404);
        }

        $booking->is_booked = 2;
        $booking->save();

        return redirect()->route('bookings.index')
                         ->withSuccess('Your booking cancel successfully.');
    }

    public function invoices()
    {
        $pagePath = 'invoices';
        view()->share('pagePath', $pagePath);

        $invoices = Invoice::where('customer_id', Auth::user()->id)->where('is_draft', 0)->get();
        if(!isset($invoices) || empty($invoices)) {
            abort(404);
        }

        view()->share('invoices', $invoices);

        return view('client.invoices.index');
    }

    public function invoiceView($invoice)
    {
        $invoice = Invoice::where('invoice_no', $invoice)->first();
        if(!isset($invoice) || empty($invoice)) {
            abort(404);
        }

        view()->share('invoice', $invoice);

        return view('client.invoices.view');
    }

    public function profileIndex()
    {
        $pagePath = 'profile';
        view()->share('pagePath', $pagePath);

        $customer = User::find(Auth::user()->id);
        if(!isset($customer) || empty($customer)) {
            abort(404);
        }

        view()->share('customer', $customer);

        return view('client.settings.profile');   
    }

    public function profileStore(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|min:2|max:100',
            'customer_phone' => 'required|min:5',
            'customer_address' => 'required|string|min:10|max:255',
            'customer_post_code' => 'required|string|min:2|max:20',
            'customer_city' => 'required|string|min:2|max:50'
        ]);

        $user = User::find(Auth::user()->id);
        if(!isset($user) || empty($user)) {
            abort(404);
        }

        $user->name = $request->customer_name;
        $user->phone = $request->customer_phone;
        $user->address = $request->customer_address;
        $user->post_code = $request->customer_post_code;
        $user->city = $request->customer_city;

        $user->save();

        return redirect()->route('home')
                         ->with('success', 'Profile updated successfully.');
    }

    public function password()
    {
        return view('client.settings.password');        
    }

    public function changePassword(Request $request, $id)
    {

        $request->validate([
            'passwordold' =>'required',
            'password' => 'required|min:6|max:50|confirmed'
        ]);

        try 
        {

            $user = User::findOrFail($id);
            $user_password = $user->password;
            
            if(Hash::check($request->passwordold, $user_password))
            {

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                Session::flash('success', "Your account password changed successfully.");
                return redirect()->back();
            
            } else {
            
                Session::flash('danger', 'Incorrect old password, Please try again.');
                return redirect()->back();
            
            }

        } catch (\PDOException $e) {
            Session::flash('danger', 'Some problem occurs, please try again!');
            return redirect()->back();
        }

    }

}
