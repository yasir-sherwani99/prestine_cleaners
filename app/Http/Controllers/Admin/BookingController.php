<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Booking;
use App\User;
use App\BookingDetail;
use App\Service;
use App\Price;

use App\Mail\BookingStatusEmail;

use Mail;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'ckstatusadmin']);
    }

    public function bookings()
    {
    	return view('admin.bookings.index');
    }

    public function bookingDetails($id)
    {
    	$booking = Booking::find($id);

    	if(!isset($booking) || empty($booking)) {
    		abort(404);
    	}

    	view()->share('booking', $booking);

    	return view('admin.bookings.details');
    }

    public function bookingsCalendar()
    {
    	$bookings = Booking::all();
    	
    	$wrapper = [];
    	$booking_array = [];
    	if(isset($bookings) || !empty($bookings)) {

	    	foreach($bookings as $key => $booking) {
	    		
	    		if($booking->is_booked == 1) {
	    			$color = '#257e4a';
	    			$status = 'BOOKED';
	    		} elseif($booking->is_booked == 0) {
	    			$color = '#3bafda';
	    			$status = 'PENDING';
	    		} else {
	    			$color = '#ff2133';
	    			$status = 'CANCELED';
	    		}

	    		$dt = Carbon::parse($booking->cleaning_start_date . ' ' . $booking->cleaning_start_time);
	    		$date = $dt->toDayDateTimeString();

	    		$booking_array['title'] = $booking->user->name;
                $booking_array['phone'] = $booking->user->phone;
	    	//	$booking_array['url'] 	= '/admin_panel/bookings/calendar';
	    		$booking_array['start'] = $booking->cleaning_start_date . 'T' . $booking->cleaning_start_time;
	    		$booking_array['color'] = $color;
	    		$booking_array['service'] = $booking->service->title;
	    		$booking_array['area'] = $booking->cleaning_area_post_code;
	    		$booking_array['booking_date'] = $date;
	    		$booking_array['booking_status'] = $status;
	    		
	    		array_push($wrapper, $booking_array);
	    	}
	    }

	    $final_data = json_encode($wrapper);
	 
	 	view()->share('final_data', $final_data);

    	return view('admin.bookings.calendar');
    }

    public function getBookingList(Request $request)
    {
   
    	$result = Booking::select('id','user_id','cleaning_start_date','service_id','is_booked','is_online','created_at')->where('is_booked', '=', 0);

        $aColumns = ['id','user_id','cleaning_start_date','service_id','is_booked','is_online','created_at'];

        $iStart = $request->get('iDisplayStart');
        $iPageSize = $request->get('iDisplayLength');

        $order = 'created_at';
        $sort = ' DESC';

        if ($request->get('iSortCol_0')) { //iSortingCols
      
            $sOrder = "ORDER BY  ";

            for ($i = 0; $i < intval($request->get('iSortingCols')); $i++) {
                if ($request->get('bSortable_' . intval($request->get('iSortCol_' . $i))) == "true") {
                    $sOrder .= $aColumns[intval($request->get('iSortCol_' . $i))] . " " . $request->get('sSortDir_' . $i) . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                 $sOrder = " id ASC";
            }

            $OrderArray = explode(' ', $sOrder);
            $order = trim($OrderArray[3]);
            $sort = trim($OrderArray[4]);

        }

        $sKeywords = $request->get('sSearch');
        
        if ($sKeywords != "") {

            $result->Where(function($query) use ($sKeywords) {
             //   $query->orWhere('invoice_no', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('cleaning_start_time', 'LIKE', "%{$sKeywords}%");
            	$query->orWhere('cleaning_start_date', 'LIKE', "%{$sKeywords}%");
            });
        }

        for ($i = 0; $i < count($aColumns); $i++) {
            $request->get('sSearch_' . $i);
            if ($request->get('bSearchable_' . $i) == "true" && $request->get('sSearch_' . $i) != '') {
                 $result->orWhere($aColumns[$i], 'LIKE', "%" . $request->orWhere('sSearch_' . $i) . "%");
            }
        }

        $iFilteredTotal = $result->count();

        if ($iStart != null && $iPageSize != '-1') {
            $result->skip($iStart)->take($iPageSize);
        }

        $result->orderBy($order, trim($sort));
        $result->limit($request->get('iDisplayLength'));
        $bookingData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($bookingData as $key => $aRow) 
        {

            $customer = "<a href='/admin_panel/customers' class='text-bold-600'>{$aRow->user->name}</a><span class='text-muted font-small-2 d-block'>{$aRow->user->email}</span>";

            $service = "<a href='#' class='text-bold-600'>{$aRow->service->title}</a><span class='text-muted font-small-2 d-block'><strong>Cleaning Date: </strong>{$aRow->cleaning_start_date}</span>";

            if($aRow->is_booked == 0){
			    $status = '<span class="badge badge-info bg-info round px-1 font-small-3">Pending</span>';
            }
			elseif($aRow->is_booked == 1){
			    $status = '<span class="badge badge-success bg-success bg-darken-4 round px-1 font-small-3">Approved</span>';
			}
			else{
			    $status = '<span class="badge badge-danger bg-danger bg-darken-4 round px-1 font-small-3">Cancelled</span>';
			}

            if($aRow->is_online == 1){
                $online = '<i class="la la-dot-circle-o success darken-4 font-medium-1 mr-1"></i>Online';
            }
            else{
                $online = '<i class="la la-dot-circle-o danger darken-4 font-medium-1 mr-1"></i>Manual';
            }

            $action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"/admin_panel/booking/{$aRow->id}/details\" class=\"dropdown-item\"><i class=\"ft-eye\"></i> View Details</a>
                          </span>
                        </span>";

            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$key+1,
                @$customer,
                @$service,
                @$status,
                @$online,
                @$action
            );    

            $i++;

        }

        echo json_encode($output);
    }

    public function changeStatus(Request $request, $id)
    {
    	// Get Booking
		$booking = Booking::find($id);

		if(!isset($booking) || empty($booking)) {
    		abort(404);
    	}

		if($request->booking_status == 1) {
			$status = 'approved';
		} else {
			$status = 'cancelled';
		}

        $service_date = $booking->cleaning_start_date . ' ' . $booking->cleaning_start_time;

        $objBooking = new \stdClass();
        $objBooking->name = ucwords($booking->user->name);
        $objBooking->cleaning_start_date = date('d F Y, h:i A', strtotime($service_date));
        $objBooking->service = isset($booking->service->title) ? $booking->service->title : 'Service Unknown';
        $objBooking->status = $status;

        $client_email = $booking->user->email;

        // Mail to Client
        try {

            Mail::to($client_email)->send(new BookingStatusEmail($objBooking));

        } catch(\Exception $e) {
            return redirect()->route('admin.bookings.index')
                         ->with('error', "Unable to send email to customer. Please try again.");
        }

        $booking->is_booked = $request->booking_status;

        // Save
        $booking->save();

		return redirect()->route('admin.bookings.index')
                         ->with('success', "Booking {$status} successfully.");

    }

    public function bookingCreate($id = NULL)
    {
        if(isset($id)) 
        {    
            $customer = User::find($id); 
            
            if(!isset($customer) || empty($customer)) {
                abort(404);
            }

            view()->share('customer', $customer);
        }

        $users = User::all();
        view()->share('users', $users);

        $services = Service::where('is_active', 1)->get();
        view()->share('services', $services);

        $items = Price::where('active', '=', 1)->get();
        view()->share('items', $items);

        return view('admin.bookings.create');
    }

    public function getAddress($id)
    {
        $user = User::find($id);
        if(!isset($user) || empty($user)) {
            return response()->json(['status' => 'fail']);
        }

        return response()->json(['status' => 'success', 'address' => $user->address ]);
    }

    public function bookingStore(Request $request)
    {
        
        $request->validate([
            'customer_id' => 'required',
            'service_id' => 'required',
            'service_cost' => 'nullable|numeric',
            'cleaning_area_address' => 'required|string|min:10|max:255',
            'cleaning_start_date' => 'required',
            'cleaning_start_time' => 'required'
        ]);

        $cleaning_start_time = date("H:i:s", strtotime($request->cleaning_start_time));

        $booking = new Booking;

        $booking->user_id = $request->customer_id;
        $booking->cleaning_start_time = $cleaning_start_time;
        $booking->additional_notes = $request->additional_info;
        $booking->cleaning_start_date = $request->cleaning_start_date;
        $booking->cleaning_area_post_code = $request->cleaning_area_address; 
        $booking->service_id = $request->service_id;
        $booking->service_cost = $request->service_cost;
        $booking->is_booked = 0;
        $booking->is_online = 0;
        $booking->is_active = 1;

        $booking->save();   

        $details = new BookingDetail;

        $details->booking_id = $booking->id;

        $details->save();

        return redirect()->route('admin.bookings.index')
                         ->with('success', "New booking created successfully.");
    }

    public function bookingsLog()
    {
        return view('admin.bookings.log');
    }

    public function getBookingsLog(Request $request)
    {
        $result = Booking::select('id','user_id','cleaning_start_date','service_id','is_booked','is_online','created_at')->whereIn('is_booked', [1,2]);

        $aColumns = ['id','user_id','cleaning_start_date','service_id','is_booked','is_online','created_at'];

        $iStart = $request->get('iDisplayStart');
        $iPageSize = $request->get('iDisplayLength');

        $order = 'cleaning_start_date';
        $sort = ' DESC';

        if ($request->get('iSortCol_0')) { //iSortingCols
      
            $sOrder = "ORDER BY  ";

            for ($i = 0; $i < intval($request->get('iSortingCols')); $i++) {
                if ($request->get('bSortable_' . intval($request->get('iSortCol_' . $i))) == "true") {
                    $sOrder .= $aColumns[intval($request->get('iSortCol_' . $i))] . " " . $request->get('sSortDir_' . $i) . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                 $sOrder = " id ASC";
            }

            $OrderArray = explode(' ', $sOrder);
            $order = trim($OrderArray[3]);
            $sort = trim($OrderArray[4]);

        }

        $sKeywords = $request->get('sSearch');
        
        if ($sKeywords != "") {

            $result->Where(function($query) use ($sKeywords) {
            //    $query->orWhere('invoice_no', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('cleaning_start_time', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('cleaning_start_date', 'LIKE', "%{$sKeywords}%");
            });
        }

        for ($i = 0; $i < count($aColumns); $i++) {
            $request->get('sSearch_' . $i);
            if ($request->get('bSearchable_' . $i) == "true" && $request->get('sSearch_' . $i) != '') {
                 $result->orWhere($aColumns[$i], 'LIKE', "%" . $request->orWhere('sSearch_' . $i) . "%");
            }
        }

        $iFilteredTotal = $result->count();

        if ($iStart != null && $iPageSize != '-1') {
            $result->skip($iStart)->take($iPageSize);
        }

        $result->orderBy($order, trim($sort));
        $result->limit($request->get('iDisplayLength'));
        $bookingData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($bookingData as $key => $aRow) 
        {

            $customer = "<a href='/admin_panel/customers' class='text-bold-600'>{$aRow->user->name}</a><span class='text-muted font-small-2 d-block'>{$aRow->user->email}</span>";

            $service = "<a href='#' class='text-bold-600'>{$aRow->service->title}</a><span class='text-muted font-small-2 d-block'><strong>Service Date: </strong>{$aRow->cleaning_start_date}</span>";

            if($aRow->is_booked == 0){
                $status = '<span class="badge badge-info bg-info round px-1 font-small-3">Pending</span>';
            }
            elseif($aRow->is_booked == 1){
                $status = '<span class="badge badge-success bg-success bg-darken-4 round px-1 font-small-3">Approved</span>';
            }
            else{
                $status = '<span class="badge badge-danger bg-danger bg-darken-4 round px-1 font-small-3">Cancelled</span>';
            }

            if($aRow->is_online == 1){
                $online = '<i class="la la-dot-circle-o success darken-4 font-medium-1 mr-1"></i>Online';
            }
            else{
                $online = '<i class="la la-dot-circle-o danger darken-4 font-medium-1 mr-1"></i>Manual';
            }

            $action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"/admin_panel/booking/{$aRow->id}/details\" class=\"dropdown-item\"><i class=\"ft-eye\"></i> View Details</a>
                            <a href=\"/admin_panel/invoice/{$aRow->id}/create\" class=\"dropdown-item\"><i class=\"ft-file-text\"></i> Create Invoice</a>
                          </span>
                        </span>";

            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$key+1,
                @$customer,
                @$service,
                @$status,
                @$online,
                @$action
            );    

            $i++;

        }

        echo json_encode($output);
    }
}
