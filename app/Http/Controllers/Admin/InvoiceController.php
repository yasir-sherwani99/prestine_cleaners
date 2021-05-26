<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Invoice;
use App\InvoiceItem;
use App\Booking;

use App\Http\Requests\InvoiceRequest;

use PDF;
use Mail;
use DB;

use App\Mail\InvoiceToCustomerEmail;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'ckstatusadmin']);
    }

    public function index()
    {
    	return view('admin.invoices.index');
    }

    public function getInvoicesList(Request $request)
    {
    	$result = Invoice::select('id','customer_id','invoice_no','title','invoice_date','due_date','total','is_sent','created_at');

        $aColumns = ['id','customer_id','invoice_no','title','invoice_date','due_date','total','is_sent','created_at'];

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
                $query->orWhere('invoice_no', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('invoice_date', 'LIKE', "%{$sKeywords}%");
            	$query->orWhere('due_date', 'LIKE', "%{$sKeywords}%");
            	$query->orWhere('total', 'LIKE', "%{$sKeywords}%");
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
        $invoiceData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($invoiceData as $aRow) 
        {

            $customer = "<a href=\"/admin_panel/invoices/{$aRow->customer_id}/customer\">{$aRow->user->name}</a>";

            $invoice = "<a href=\"/admin_panel/invoice/{$aRow->id}\" class=\"text-bold-600\">{$aRow->invoice_no}</a>";

           	$amount = "<span>&pound; {$aRow->total}</span>";

            if($aRow->is_sent == 1) {
                $delivered = "<input type=\"checkbox\" class=\"form-control\" value=\"1\" checked disabled>";
            } else {
               $delivered = "<input type=\"checkbox\" class=\"form-control\" value=\"0\" disabled>";
            }

            $action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"/admin_panel/invoice/{$aRow->id}\" class=\"dropdown-item\"><i class=\"ft-eye\"></i> View Invoice</a>
                            <a href=\"/admin_panel/invoice/{$aRow->id}/edit\" class=\"dropdown-item\"><i class=\"ft-edit\"></i> Edit Invoice</a>
                          </span>
                        </span>";

            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$aRow->invoice_date,
                @$invoice,
                @$customer,
                @$aRow->due_date,
                @$amount,
                @$delivered,
                @$action
            );    

            $i++;

        }

        echo json_encode($output);
    }

    public function create($id)
    {
    	$booking = Booking::find($id);
    	if(!isset($booking) || empty($booking)) {
    		abort(404);
    	}

		view()->share('booking', $booking);

    	return view('admin.invoices.create');
    }

    public function store(InvoiceRequest $request)
    {
	    $invoice = new Invoice;

    	$invoice->booking_id = $request->booking_id;
    	$invoice->customer_id = $request->customer_id;
    	$invoice->invoice_no = 'PC-' . mt_rand(100000, 999999);
        $invoice->title = $request->title;
    	$invoice->invoice_date = $request->invoice_issue_date;
    	$invoice->due_date = $request->invoice_due_date;
    	$invoice->payment_terms = $request->payment_method;
    	$invoice->additional_notes = $request->notes;
    	$invoice->sub_total = $request->sub_total;
    	$invoice->tax = $request->tax;
    	$invoice->discount = $request->discount;
    	$invoice->total = $request->grand_total;
        $invoice->is_draft = 1;
        $invoice->is_cancelled = 0;
        $invoice->is_sent = 0;

    	$invoice->save();

    	foreach($request->data as $data) 
    	{	
    		$items = new InvoiceItem;

	    	$items->invoice_id = $invoice->id;
	    	$items->item_description = $data['item_description'];	
	    	$items->quantity = $data['item_qty'];	
	    	$items->rate = $data['item_rate'];	
	    	$items->amount = $data['item_total'];	

	    	$items->save();
    	}

        $pdf_file = $invoice->invoice_no . '-' . date('Y-m-d') . '.pdf';

        view()->share('invoice', $invoice);
        $pdf = PDF::loadView('admin.invoices.pdf_view')->setPaper('a4', 'portrait');
        Storage::put('public/invoices_pdf/' . $pdf_file, $pdf->output());
        $pdf->download($pdf_file);

        Invoice::whereId($invoice->id)
                ->update([
                    'pdf_file' => $pdf_file
                ]);

		return redirect()->route('admin.invoices.index')
                         ->with('success', "Invoice successfully created.");
    }

    public function show($id)
    {
    	$invoice = Invoice::find($id);
    	if(!isset($invoice) || empty($invoice)) {
    		abort(404);
    	}

    	view()->share('invoice', $invoice);

    	return view('admin.invoices.view');
    }

    public function edit($id)
    {
    	
    	$users = User::all();
    	view()->share('users', $users);

    	$invoice = Invoice::find($id);
    	if(!isset($invoice) || empty($invoice)) {
    		abort(404);
    	}

    	view()->share('invoice', $invoice);

    	return view('admin.invoices.edit');
    }

    public function update(InvoiceRequest $request, $id)
    {
        // Get Invoice
		$invoice = Invoice::find($id);

		if(!isset($invoice) || empty($invoice)) {
    		abort(404);
    	}

    	$invoice->booking_id = $request->booking_id;
    	$invoice->customer_id = $request->customer_id;
        $invoice->title = $request->title;
    	$invoice->invoice_date = $request->invoice_issue_date;
    	$invoice->due_date = $request->invoice_due_date;
    	$invoice->payment_terms = $request->payment_method;
    	$invoice->additional_notes = $request->notes;
    	$invoice->sub_total = $request->sub_total;
    	$invoice->tax = $request->tax;
    	$invoice->discount = $request->discount;
    	$invoice->total = $request->grand_total;

    	$invoice->update();

    	foreach($request->data as $data) 
    	{	
    		$item = InvoiceItem::find($data['invoice_item_id']);
            if(isset($item) || !empty($item)) {
     
                $item->item_description = $data['item_description'];   
                $item->quantity = $data['item_qty'];   
                $item->rate = $data['item_rate'];  
                $item->amount = $data['item_total'];   

                $item->update();
            
            } else {

                $newItem = new InvoiceItem;
                
                $newItem->invoice_id = $id;
                $newItem->item_description = $data['item_description'];   
                $newItem->quantity = $data['item_qty'];   
                $newItem->rate = $data['item_rate'];  
                $newItem->amount = $data['item_total'];

                $newItem->save();

            }
    	}

        Storage::delete('public/invoices_pdf/' . $invoice->pdf_file);

        $pdf_file = $invoice->invoice_no . '-' . date('Y-m-d') . '.pdf';

        view()->share('invoice', $invoice);
        $pdf = PDF::loadView('admin.invoices.pdf_view')->setPaper('a4', 'portrait');
        Storage::put('public/invoices_pdf/' . $pdf_file, $pdf->output());
        $pdf->download($pdf_file);

        Invoice::whereId($invoice->id)
                ->update([
                    'pdf_file' => $pdf_file
                ]);

		return redirect()->route('admin.invoices.index')
                         ->with('success', "Invoice successfully updated.");
    }

    public function sendInvoiceToCustomer(Request $request)
    {
    	$invoice = Invoice::find($request->invoice_id);
    	
    	if(!isset($invoice) || empty($invoice)) {
    		abort(404);
    	}

        $objInvoice = new \stdClass();
        $objInvoice->name = ucwords($invoice->user->name);
        $objInvoice->invoice_no = $invoice->invoice_no;
        $objInvoice->invoice_date = $invoice->invoice_date;
        $objInvoice->invoice_due_date = $invoice->invoice_due_date;
        $objInvoice->subject = "Invoice - {$invoice->invoice_no} from Prestine Cleaners";
        $objInvoice->pdf_file_name = $invoice->pdf_file;
    	
        $client_email = $invoice->user->email;

       // Mail to Client
        try {

            Mail::to($client_email)->send(new InvoiceToCustomerEmail($objInvoice));

        } catch(\Exception $exception) {
            return redirect()->route('admin.invoices.index')
                         ->with('error', "Unable to send invoice in email. Please try again.");
        }

        $invoice->is_draft = 0;
        $invoice->is_sent = 1;
        $invoice->save();

        return redirect()->route('admin.invoices.index')
                         ->with('success', "Invoice successfully sent to customer.");

    }

    public function deleteInvoiceItem($item_id)
    {
        $item = InvoiceItem::find($item_id);
        if(isset($item)) {

            $item_amount = $item->amount;

            $invoice = Invoice::find($item->invoice_id);
            if(isset($invoice)) {
                $new_sub_total = $invoice->sub_total - $item_amount;
                $new_total = $invoice->total - $item_amount;

                $invoice->sub_total = $new_sub_total;
                $invoice->total = $new_total;
                $invoice->save();
            }

            DB::table('invoice_items')
              ->where('id', $item_id)
              ->delete();

            return response()->json(['status' => 'success', 'sub_total' => $new_sub_total, 'total' => $new_total]);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }

    public function customerInvoices($id)
    {
        $user = User::find($id);
        if(!isset($user) || empty($user)) {
            abort(404);
        }

        $data = [];
        $data['user_id'] = $id;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['phone'] = $user->phone;
        $data['address'] = $user->address;
        $data['post_code'] = $user->post_code;
        $data['city'] = $user->city;

        view()->share('data', $data);

        return view('admin.invoices.customer_invoices');
    }

    public function getCustomerInvoicesList(Request $request, $id)
    {
    
        $result = Invoice::select('id','customer_id','invoice_no','title','invoice_date','due_date','total','is_sent','created_at')->where('customer_id', $id);

        $aColumns = ['id','customer_id','invoice_no','title','invoice_date','due_date','total','is_sent','created_at'];

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
                $query->orWhere('invoice_no', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('invoice_date', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('due_date', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('total', 'LIKE', "%{$sKeywords}%");
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
        $invoiceData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($invoiceData as $aRow) 
        {

            $invoice = "<a href=\"/admin_panel/invoice/{$aRow->id}\" class=\"text-bold-600\">{$aRow->invoice_no}</a>";

            $amount = "<span>&pound; {$aRow->total}</span>";

            if($aRow->is_sent == 1) {
                $delivered = "<input type=\"checkbox\" class=\"form-control\" value=\"1\" checked disabled>";
            } else {
               $delivered = "<input type=\"checkbox\" class=\"form-control\" value=\"0\" disabled>";
            }

            $action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"/admin_panel/invoice/{$aRow->id}\" class=\"dropdown-item\"><i class=\"ft-eye\"></i> View Invoice</a>
                            <a href=\"/admin_panel/invoice/{$aRow->id}/edit\" class=\"dropdown-item\"><i class=\"ft-edit\"></i> Edit Invoice</a>
                          </span>
                        </span>";

            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$aRow->invoice_date,
                @$invoice,
                @$aRow->title,
                @$aRow->due_date,
                @$amount,
                @$delivered,
                @$action
            );    

            $i++;

        }

        echo json_encode($output);
    }

}

