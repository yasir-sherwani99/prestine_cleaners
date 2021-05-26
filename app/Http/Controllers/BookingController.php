<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;
use App\Booking;
use App\BookingDetail;
use App\User;
use App\Price;
use App\MetaTag;

use App\Http\Requests\BookingFormRequest;

use App\Mail\BookingClientEmail;
use App\Mail\BookingAdminEmail;
use App\Mail\NewAccountEmail;

use Mail;
use DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
//use Artesaos\SEOTools\Facades\SEOTools;

class BookingController extends Controller
{
    public function index()
    {
    	$meta = MetaTag::where('page', 'Booking')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/booking');
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl('https://prestinecleaners.co.uk/booking');
        OpenGraph::addProperty('type', 'company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('Company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

    	$title = 'Book Online';
    	$pagePath = 'booking';
    	view()->share('pagePath', $pagePath);

    	$prices = Price::all();
    	view()->share('prices', $prices);

    	return view('front.booking.index', compact('title'));
    }

    public function loadStep1()
    {
    	$services = Service::where('is_active', 1)->get();
    	view()->share('services', $services);

    	return view('front.booking.steps.service');
    }

    public function loadStep2()
    {
    	return view('front.booking.steps.service_details');	
    }

    public function loadStep3()
    {
    	return view('front.booking.steps.additional_information');	
    }

    public function loadStep4()
    {
    	return view('front.booking.steps.login_submit');	
    }

    public function loadTenancy()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.tenancy_details');
    } 

    public function loadCarpet()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.carpet_rug_details');
    }

    public function loadUpholstery()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.upholstery_details');	
    }

    public function loadWindow()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.window_details');	
    }

    public function loadOven()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.oven_details');	
    }

    public function loadOneOffCleaning()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.one_off_details');	
    }

    public function loadRegularFortnightly()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.fortnightly_details');	
    }

    public function loadOffice()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.office_details');	
    } 

    public function loadAfterBuilders()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.after_builders_details');	
    }

    public function loadMattress()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.mattress_details');	
    }

    public function loadSofa()
    {
    	$items = Price::where('active', '=', 1)->get();
    	view()->share('items', $items);

    	return view('front.booking.inc.sofa_details');	
    }

    public function loadUnknown()
    {
    	return view('front.booking.inc.unknown_service');	
    }

    public function store(BookingFormRequest $request)
    {
    	// If customer logged in
    	if(Auth::check()) {
    	
    		$user_id = Auth::user()->id;
    	
    	} else {
	    	// Existing customer
	   		if($request->customer == 1) 
	   		{
	   			if(DB::table('users')->where('email', $request->login_email)->exists())
	   			{
	   				$password = User::where('email', $request->login_email)->value('password');	

	   				if(Hash::check($request->login_password, $password))
		   			{
		   				$user_id = User::where('email', $request->login_email)->value('id');
		   			} else {
		   				// Session::flash('alert', 'Incorrect email or password, Please try again.');
		                return redirect()->route('booking.index')
		                				 ->withErrors('Incorrect email or password, Please try again.');
		   			}
	   			} else {
	   			//	Session::flash('alert', 'This email does not exist in our system.');
		            return redirect()->route('booking.index')
		            				 ->withErrors('No account found with that email address. Please try again');
	   			}	
	   		// New customer	
	   		} else {

	   			if(DB::table('users')->where('email', $request->email)->exists())
	   			{
	   			//	Session::flash('alert', 'This email is already in use, please try another email.');
		            return redirect()->route('booking.index')
		            				 ->withErrors('This email is already in use, please try another email.');

			    } else {

			    	$user = new User;

			    	$user->name = ucwords($request->complete_name);
			    	$user->email = $request->email;
			    	$user->phone = $request->phone;
			    	$user->password = Hash::make($request->password);

			    	$user->save();

			    	$objAccount = new \stdClass();
	        		$objAccount->name = ucwords($request->complete_name);
	        		$objAccount->email = $request->email;
	        		$objAccount->password = $request->password;

	        		$user_id = $user->id;

					// Welcome Mail to Client
				    try {

			        	Mail::to($request->email)->send(new NewAccountEmail($objAccount));

				    } catch(\Exception $e) {
				        // get error here
				        echo $e->getMessage();
				    }		    	

			    }

	   		}

	   	}

    	$cleaning_start_time = date("H:i:s", strtotime($request->cleaning_start_time));

    	$booking = new Booking;

		$booking->user_id = $user_id;
		$booking->cleaning_start_time = $cleaning_start_time;
		$booking->additional_notes = $request->additional_info;
		$booking->cleaning_start_date = $request->cleaning_start_date;
		$booking->cleaning_area_post_code = $request->cleaning_area_post_code; 
		$booking->service_id = $request->service;
		$booking->is_booked = 0;
		$booking->is_online = 1;
		$booking->is_active = 1;

		$booking->save();

		// House Parts
		$house_parts = [];
		if(!empty($request->house_parts)){
			foreach($request->house_parts as $part)
			{
				if($part == 1){
					$house_qty = $request->house_bedrooms_qty;
				}elseif($part == 2){
					$house_qty = $request->house_bathrooms_qty;
				}else{
					$house_qty = $request->house_floors_qty;
				}

				$house_parts[$part] = $house_qty; 
			}

			$house_parts_json = json_encode($house_parts);
		
		}else{
			$house_parts_json = null;
		}	

		// Property Inside Design
		$property_inside_design = [];
		if(!empty($request->property_inside_design)){
			foreach($request->property_inside_design as $inside)
			{
				array_push($property_inside_design, $inside);				
			}

			$property_inside_design_json = json_encode($property_inside_design);			
		
		}else{
			$property_inside_design_json = null;
		}

		// Carpet House Locations
		$carpet_house_location = [];
		if(!empty($request->carpet_house_location)){
			foreach($request->carpet_house_location as $carpet)
			{
				if($carpet == 11){
					$carpet_qty = $request->carpet_bedroom_qty;
				}elseif($carpet == 12){
					$carpet_qty = $request->carpet_livingroom_qty;
				}elseif($carpet == 13){
					$carpet_qty = $request->carpet_diningroom_qty;
				}elseif($carpet == 14){
					$carpet_qty = $request->carpet_hallway_qty;
				}elseif($carpet == 15){
					$carpet_qty = $request->carpet_staircase_qty;
				}else{
					$carpet_qty = $request->carpet_landing_qty;
				}

				$carpet_house_location[$carpet] = $carpet_qty; 
			}

			$carpet_house_location_json = json_encode($carpet_house_location);
		
		}else{
			$carpet_house_location_json = null;
		}

		// Rug Size
		$rug_size = [];
		if(!empty($request->rug_size)){
			foreach($request->rug_size as $rug)
			{
				if($rug == 17){
					$rug_qty = $request->rugs_small_qty;
				}elseif($rug == 18){
					$rug_qty = $request->rugs_medium_qty;
				}else{
					$rug_qty = $request->rugs_large_qty;
				}

				$rug_size[$rug] = $rug_qty; 
			}

			$rug_size_json = json_encode($rug_size);
		
		}else{
			$rug_size_json = null;
		}

		// Upholstery Items
		$upholstery = [];
		if(!empty($request->upholstery)){
			foreach($request->upholstery as $up)
			{
				if($up == 53){
					$upholstery_qty = $request->sofa_qty;
				}elseif($up == 54){
					$upholstery_qty = $request->armchair_qty;
				}elseif($up == 55){
					$upholstery_qty = $request->mattress_qty;
				}else{
					$upholstery_qty = $request->curtain_qty;
				}

				$upholstery[$up] = $upholstery_qty; 
			}

			$upholstery_json = json_encode($upholstery);
		
		}else{
			$upholstery_json = null;
		}

		// Extra Items
		$extra_items = [];
		if(!empty($request->extra_items)){
			foreach($request->extra_items as $extra)
			{
				array_push($extra_items, $extra);				
			}

			$extra_items_json = json_encode($extra_items);			
		
		}else{
			$extra_items_json = null;
		}

		// Carpet/Rug Material
		$carpet_rug_material = [];
		if(!empty($request->carpet_rug_material)){
			foreach($request->carpet_rug_material as $material)
			{
				array_push($carpet_rug_material, $material);				
			}

			$carpet_rug_material_json = json_encode($carpet_rug_material);
		
		}else{
			$carpet_rug_material_json = null;
		}

		// Furniture Items
		$furniture_items = [];
		if(!empty($request->furniture_items)){
			foreach($request->furniture_items as $furniture)
			{
				if($furniture == 21){
					$furniture_qty = $request->armchair_qty;
				}elseif($furniture == 25){
					$furniture_qty = $request->twoseater_qty;
				}elseif($furniture == 26){
					$furniture_qty = $request->threeseater_qty;
				}elseif($furniture == 27){
					$furniture_qty = $request->fourseater_qty;
				}elseif($furniture == 28){
					$furniture_qty = $request->fiveseater_qty;
				}else{
					$furniture_qty = $request->diningchair_qty;
				}

				$furniture_items[$furniture] = $furniture_qty; 
			}

			$furniture_items_json = json_encode($furniture_items);
		
		}else{
			$furniture_items_json = null;
		}

		// Furniture Material
		$furniture_material = [];
		if(!empty($request->furniture_material)){
			foreach($request->furniture_material as $material)
			{
				array_push($furniture_material, $material);				
			}

			$furniture_material_json = json_encode($furniture_material);
		
		}else{
			$furniture_material_json = null;
		}

		// Mattress Size
		$mattress_size = [];		  
		if(!empty($request->mattress_size)){
			foreach($request->mattress_size as $mattress)
			{
				if($mattress == 22){
					$mattress_qty = $request->single_mattress_qty;
				}elseif($mattress == 23){
					$mattress_qty = $request->double_mattress_qty;
				}else{
					$mattress_qty = $request->king_mattress_qty;
				}

				$mattress_size[$mattress] = $mattress_qty; 
			}

			$mattress_size_json = json_encode($mattress_size);
		
		}else{
			$mattress_size_json = null;
		}

		// Curtain Size
		$curtain_size = [];
		if(!empty($request->curtain_size)){
			foreach($request->curtain_size as $curtain)
			{
				if($curtain == 30){
					$curtain_qty = $request->curtain_halflength_qty;
				}else{
					$curtain_qty = $request->curtain_fulllength_qty;
				}

				$curtain_size[$curtain] = $curtain_qty; 
			}

			$curtain_size_json = json_encode($curtain_size);
		
		}else{
			$curtain_size_json = null;
		}

		// Window Extras
		$window_others = [];
		if(!empty($request->window_others)){
			foreach($request->window_others as $window)
			{
				if($window == 35){
					$window_qty = $request->conservatory_qty;
				}elseif($window == 36){
					$window_qty = $request->glassroof_qty;
				}else{
					$window_qty = $request->skylight_qty;
				}

				$window_others[$window] = $window_qty; 
			}

			$window_others_json = json_encode($window_others);
		
		}else{
			$window_others_json = null;
		}

		// Oven Types
		$oven_type = [];
		if(!empty($request->oven_type)){
			foreach($request->oven_type as $oven)
			{
				if($oven == 38){
					$oven_qty = $request->singleoven_qty;
				}elseif($oven == 39){
					$oven_qty = $request->doubleoven_qty;
				}elseif($oven == 40){
					$oven_qty = $request->rangecooker_qty;
				}else{
					$oven_qty = $request->agaoven_qty;
				}

				$oven_type[$oven] = $oven_qty; 
			}

			$oven_type_json = json_encode($oven_type);
		
		}else{
			$oven_type_json = null;
		}

		// Oven Extras
		$oven_extras = [];
		if(!empty($request->oven_extras)){
			foreach($request->oven_extras as $oextra)
			{
				if($oextra == 42){
					$oextra_qty = $request->hobs_qty;
				}elseif($oextra == 43){
					$oextra_qty = $request->splashback_qty;
				}else{
					$oextra_qty = $request->extractor_qty;
				}

				$oven_extras[$oextra] = $oextra_qty; 
			}

			$oven_extras_json = json_encode($oven_extras);
		
		}else{
			$oven_extras_json = null;
		}

		// Kitchen Items
		$kitchen_items = [];
		if(!empty($request->kitchen_items)){
			foreach($request->kitchen_items as $kitchen)
			{
				if($kitchen == 45){
					$kitchen_qty = $request->fridge_qty;
				}elseif($kitchen == 46){
					$kitchen_qty = $request->microwave_qty;
				}elseif($kitchen == 47){
					$kitchen_qty = $request->washingmachine_qty;
				}else{
					$kitchen_qty = $request->dishwasher_qty;
				}

				$kitchen_items[$kitchen] = $kitchen_qty; 
			}

			$kitchen_items_json = json_encode($kitchen_items);
		
		}else{
			$kitchen_items_json = null;
		}

		// Office Rooms
		$office_rooms = [];
		if(!empty($request->office_rooms)){
			foreach($request->office_rooms as $office)
			{
				if($office == 58){
					$office_qty = $request->office_kitchen_qty;
				}elseif($office == 59){
					$office_qty = $request->office_bathrooms_qty;
				}elseif($office == 60){
					$office_qty = $request->office_toilets_qty;
				}elseif($office == 61){
					$office_qty = $request->office_rooms_qty;
				}else{
					$office_qty = $request->office_halls_qty;
				}

				$office_rooms[$office] = $office_qty; 
			}

			$office_rooms_json = json_encode($office_rooms);
		
		}else{
			$office_rooms_json = null;
		}

		$details = new BookingDetail;

		$details->booking_id = $booking->id;
		$details->furnished = isset($request->furnished) ? $request->furnished : null;
		$details->property_type = isset($request->property_type) ? $request->property_type : null;
		$details->house_parts = $house_parts_json;
		$details->property_inside_design = $property_inside_design_json;
		$details->carpet_service = isset($request->carpet_service) ? $request->carpet_service : null;
		$details->carpet_house_location = $carpet_house_location_json;
		$details->rug_size = $rug_size_json;
		$details->upholstery_items = $upholstery_json;
		$details->extra_items = $extra_items_json;
		$details->carpet_rug_material = $carpet_rug_material_json;
		$details->furniture_items = $furniture_items_json;
		$details->furniture_material = $furniture_material_json;
		$details->furniture_material_others = isset($request->furniture_material_others) ? $request->furniture_material_others : null;
		$details->mattress_size = $mattress_size_json;
		$details->curtain_size = $curtain_size_json;
		$details->highest_window_location = isset($request->highest_window_location) ? $request->highest_window_location : null;
		$details->window_sides = isset($request->window_sides) ? $request->window_sides : null;
		$details->window_qty = isset($request->window_qty) ? $request->window_qty : null;
		$details->window_others = $window_others_json;
		$details->oven_type = $oven_type_json;
		$details->kitchen_accessory = $oven_extras_json;
		$details->kitchen_items = $kitchen_items_json;
		$details->kitchen_appliances = isset($request->kitchen_appliances) ? $request->kitchen_appliances : null; 
		$details->cleaning_schedule = isset($request->cleaning_schedule) ? $request->cleaning_schedule : null;
		$details->pets = isset($request->pets) ? $request->pets : null;
		$details->iron = isset($request->iron) ? $request->iron : null;
		$details->office_rooms = $office_rooms_json;

		$details->save();

		$service = Service::findOrFail($request->service);
		$service_title = $service->title;

		$service_date = $request->cleaning_start_date . ' ' . $request->cleaning_start_time; 
		$subject = 'Prestine Cleaners: Your Booking is all set for ' . date('d F Y, h:i A', strtotime($service_date));

		$user = User::find($user_id);

		if(isset($user)) {

			$objBooking = new \stdClass();
	        $objBooking->name = ucwords($user->name);
	        $objBooking->email = $user->email;
	        $objBooking->phone = $user->phone;
	        $objBooking->cleaning_start_date_time = date('d F Y, h:i A', strtotime($service_date));
	        $objBooking->cleaning_area_post_code = strtoupper($request->cleaning_area_post_code);
	        $objBooking->service = $service_title;
	        $objBooking->subject = $subject; 

	        // Mail to Client
	        try {

				Mail::to($user->email)->send(new BookingClientEmail($objBooking));

	        } catch(\Exception $e) {
	            // get error here
	            echo $e->getMessage();
	        }

	        // Mail to Owner
	        try {

				Mail::to('info@prestinecleaners.co.uk')->send(new BookingAdminEmail($objBooking));

	        } catch(\Exception $e) {
	            // get error here
	            echo $e->getMessage();
	        }

		}

		return redirect()->route('booking.index')
                         ->with('success', "We have received your enquiry and will respond to you within 24 hours.  For urgent enquiries please call us on this 07387 312 723 telephone number.");
    }

}
