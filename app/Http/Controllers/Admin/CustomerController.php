<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

use DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'ckstatusadmin']);
    }

    public function customers()
    {
    	return view('admin.customers.index');
    }

    public function getCustomerList(Request $request)
    {
    	$result = User::select(
                        'bookings.user_id',
                        'users.id',
				        'users.name','users.email','users.phone','users.address','users.post_code','users.city','users.created_at',
                        DB::raw('COUNT(bookings.user_id) AS booking_count')
				    )
    				->leftJoin('bookings', 'bookings.user_id', '=', 'users.id')
    				->groupBy(['bookings.user_id', 'users.id','users.name','users.email','users.phone','users.address','users.post_code','users.city','users.created_at']);
    			//    ->orderBy('users.created_at', 'DESC');

        $aColumns = ['users.id','bookings.user_id','users.name','users.email','users.phone','users.address','users.post_code','users.city','users.created_at', 'booking_count'];

        $iStart = $request->get('iDisplayStart');
        $iPageSize = $request->get('iDisplayLength');

        $order = 'users.created_at';
        $sort = 'DESC';

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
                $query->orWhere('users.name', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('users.email', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('users.phone', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('users.post_code', 'LIKE', "%{$sKeywords}%");
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
        $userData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($userData as $key => $aRow) 
        {

        	$row = $key + 1;
            $customer = "<a href=\"/admin_panel/invoices/{$aRow->id}/customer\">{$aRow->name}</a><span class='d-block'>{$aRow->email}</span>";
            
            if($aRow->address == NULL) {
                $cust_address = "Address not available";   
            } else {
                $cust_address = $aRow->address;
            }

            $address = "<a href='javascript:;'>{$cust_address}</a><span class='d-block'>{$aRow->post_code}</span>";

            $bookings = "<p class=\"text-center\"><span class=\"badge badge-success badge-pill\">{$aRow->booking_count}</span></p>";

            $action = "<p class=\"text-center\"><span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"/admin_panel/customer/{$aRow->id}/edit\" class=\"dropdown-item\"><i class=\"ft-edit\"></i> Edit Customer</a>
                            <a href=\"/admin_panel/booking/create/{$aRow->id}\" class=\"dropdown-item\"><i class=\"ft-calendar\"></i> Add Booking</a>
                            <a href=\"/admin_panel/invoices/{$aRow->id}/customer\" class=\"dropdown-item\"><i class=\"ft-file-text\"></i> View Invoices</a>
                          </span>
                        </span></p>";

            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$row,
                @$customer,
                @$aRow->phone,
            //    @$aRow->city,
                @$bookings,
                @$action
            );    

            $i++;

        }

        echo json_encode($output);	
    }

    public function customerCreate()
    {
        return view('admin.customers.create');
    }

    public function customerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'phone' => 'nullable|min:5|max:50',
            'address' => 'nullable|min:10|max:250',
            'city' => 'nullable|min:2|max:50'
        ]);   

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->post_code = $request->post_code;
        $user->city = $request->city; 

        $user->save();   

        return redirect()->route('admin.customers.index')
                         ->with('success', "New customer created successfully.");
    }

    public function customerEdit($id)
    {
        $customer = User::find($id);
    
        if(!isset($customer) || empty($customer)) {
            abort(404);
        }

        view()->share('customer', $customer);

        return view('admin.customers.edit');
    }

    public function customerUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:191',
            'email' => 'required|string|email|max:191',
            'phone' => 'nullable|min:5|max:50',
            'address' => 'nullable|min:10|max:250',
            'city' => 'nullable|min:2|max:50'
        ]);      

        $customer = User::find($id);  

        if(!isset($customer) || empty($customer)) {
            abort(404);
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->post_code = $request->post_code;
        $customer->city = $request->city; 

        $customer->save();   

        return redirect()->route('admin.customers.index')
                         ->with('success', "Customer updated successfully.");
    }
}
