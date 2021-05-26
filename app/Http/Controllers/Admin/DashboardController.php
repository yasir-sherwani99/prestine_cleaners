<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Service;
use App\Contact;
use App\Admin;
use App\Price;

use Yajra\DataTables\Facades\DataTables;
use DB;
use Mail;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'ckstatusadmin']);
    }

    public function services()
    {
    	$services = Service::orderBy('title', 'ASC')->get();

    	view()->share('services', $services);

    	return view('admin.services.index');
    }

    public function messages()
    {
    	return view('admin.messages.index');
    }

    public function getMessagesList(Request $request)
    {
    	$result = Contact::select('id','name','email','is_read','created_at')
    			  ->orderBy('created_at', 'DESC');

        $aColumns = ['id','name','email','is_read','created_at'];

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
                $query->orWhere('name', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('email', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('phone', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('subject', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('message', 'LIKE', "%{$sKeywords}%");
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
        $messagesData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($messagesData as $key => $aRow) 
        {

        	$row = $key + 1;
            $customer = "<a href='#'>{$aRow->name}</a><p>{$aRow->email}</p>";

            if($aRow->is_read == 1){
        		$status = "<p class='text-center'><span class='badge badge-success bg-success  bg-darken-4'>Read</span></p>";
            }
        	else{
        		$status = "<p class='text-center'><span class='badge badge-danger bg-danger bg-darken-4'>Unread</span></p>";
        	}

        	$action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"/admin_panel/message/{$aRow->id}/details\" class=\"dropdown-item\"><i class=\"ft-eye\"></i> View Message</a>
                          </span>
                        </span>";
        	
            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$row,
                @$customer,
                @$status,
                @$action
            );    

            $i++;

        }

        echo json_encode($output);
    }

    public function messageDetails($id)
    {
    	$message = Contact::find($id);

    	if(!isset($message) || empty($message)) {
    		abort(404);
    	}

    	$message->is_read = 1;
    	$message->save();

    	view()->share('message', $message);

    	return view('admin.messages.details');
    }

    public function prices()
    {
        $prices = Price::whereIn('item_id', [1,2,3,4,10,11,16,19])
                        ->where('active', 1)
                        ->orderBy('item_id', 'ASC')
                        ->get();

        view()->share('prices', $prices);

        return view('admin.prices.index');
    }

    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'item_price' => 'required|numeric|min:1'
        ]);

        $price = Price::find($id);
        if(!isset($price) || empty($price)) {
            abort(404);
        }

        $price->price = $request->item_price;
        $price->save();

        return redirect()->route('admin.items_prices.index')
                         ->with('success', 'Item price updated successfully.');

    }

}

