<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Booking;
use App\User;
use App\Service;
use App\Admin;
use App\Invoice;
use App\Setting;
use App\MetaTag;
use App\Snippet;

use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'ckstatusadmin']);
    }

    public function index()
    {
    	$recent_bookings = Booking::orderBy('cleaning_start_date', 'DESC')->limit(5)->get();
    	view()->share('recent_bookings', $recent_bookings);

        // $recent_invoices = Invoice::orderBy('created_at', 'DESC')->limit(5)->get();
        // view()->share('recent_invoices', $recent_invoices);

        $today_services = Booking::whereDate('cleaning_start_date', date('Y-m-d'))
                                 ->where('is_booked', 1)
                                 ->orderBy('cleaning_start_time', 'ASC')
                                 ->get();
        view()->share('today_services', $today_services);        

    	$data = [];
		
		$data['today_services'] = Booking::whereDate('cleaning_start_date', date('Y-m-d'))->where('is_booked', 1)->count();
        $data['total_bookings'] = Booking::count();
		$data['pending_bookings'] = Booking::where('is_booked', 0)->count();
		$data['total_customers'] = User::count();
		$data['total_services'] = Service::where('is_active', 1)->count();
		
        view()->share('stats', $data);

    	return view('admin.home.index');
    }

    public function admins()
    {
    	$admins = Admin::orderBy('name', 'ASC')->get();
    	view()->share('admins', $admins);

    	return view('admin.admins.index');
    }

    public function adminCreate()
    {
    	return view('admin.admins.create');
    }

    public function adminStore(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:5|max:191',
            'email' => 'required|string|email|max:191|unique:admins',
            'designation' => 'required|string|min:2|max:191',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required',
        ]);

        $admin = new Admin;

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->designation = $request->designation;
        $admin->password = bcrypt($request->password);
        $admin->status = $request->status;
        
        $admin->save();

        return redirect()->route('admin.admins.index')
                         ->with('success', "System administrator created successfully.");

    }

    public function adminEdit($id)
    {
    	$admin = Admin::find($id);

    	if(!isset($admin) || empty($admin)) {
    		abort(404);
    	}

    	view()->share('admin', $admin);

    	return view('admin.admins.edit');
    }

    public function adminUpdate(Request $request, $id)
    {

    	$request->validate([
            'name' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'status' => 'required',
        ]);
    	
    	// Get Profile
		$admin = Admin::find($id);

		if(!isset($admin) || empty($admin)) {
    		abort(404);
    	}

    	$admin->name = $request->name;
    	$admin->designation = $request->designation;
    	$admin->status = $request->status;

    	// Save
		$admin->save();

		return redirect()->route('admin.admins.index')
                         ->with('success', "Admin profile updated successfully.");
    }

    public function password()
    {
        return view('admin.password.index');
    }

    public function changePassword(Request $request, $id)
    {

        $request->validate([
            'passwordold' =>'required',
            'password' => 'required|min:6|max:50|confirmed'
        ]);

        try 
        {

            $admin = Admin::findOrFail($id);
            $admin_password = $admin->password;
            
            if(Hash::check($request->passwordold, $admin_password))
            {

                $password = Hash::make($request->password);
                $admin->password = $password;
                $admin->save();

                Session::flash('success', "Your account password changed successfully.");
                return redirect()->back();
            
            } else {
            
                Session::flash('alert', 'Incorrect old password, Please try again.');
               // Session::flash('type', 'warning');
                return redirect()->back();
            
            }

        } catch (\PDOException $e) {
            Session::flash('alert', 'Some problem occurs, please try again!');
         //   Session::flash('type', 'warning');
            return redirect()->back();
        }

    }

    public function social()
    {
        $socials = Setting::find(1);
        if(!isset($socials) || empty($socials)) {
            abort(404);
        }

        view()->share('socials', $socials);

        return view('admin.social.index');
    }

    public function socialUpdate(Request $request, $id)
    {
        $social = Setting::find($id);
        if(!isset($social) || empty($social)) {
            abort(404);
        }

        $social->facebook = $request->facebook;
        $social->twitter = $request->twitter;
        $social->instagram = $request->instagram;
        $social->pinterest = $request->pinterest;
        $social->youtube = $request->youtube;

        $social->update();

        return redirect()->route('admin.social.index')
                        ->with('success', 'Social media links updated successfully.');
    }

    public function metaIndex()
    {
        return view('admin.meta_tags.index');
    }

    public function getMetaTagsPages(Request $request)
    {
        $result = MetaTag::select('id', 'page', 'title', 'description');

        $aColumns = ['id','page','title','description'];

        $iStart = $request->get('iDisplayStart');
        $iPageSize = $request->get('iDisplayLength');

        $order = 'created_at';
        $sort = ' ASC';

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
                $query->orWhere('page', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('title', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('description', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('keywords', 'LIKE', "%{$sKeywords}%");
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
        $metaData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($metaData as $key => $aRow) 
        {

            $row = $key + 1;
            $page = "<a href=\"/admin_panel/meta_tag/{$aRow->id}/edit\">{$aRow->page}</a>";

            
            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$row,
                @$page,
                @$aRow->title,
                @Str::limit($aRow->description, 50)
            );    

            $i++;

        }

        echo json_encode($output);
    }

    public function metaEdit($id)
    {
        $metatag = MetaTag::find($id);
        if(!isset($metatag) || empty($metatag)) {
            abort(404);
        }   

        view()->share('metatag', $metatag);

        return view('admin.meta_tags.edit');
    }

    public function metaUpdate(Request $request, $id)
    {
        $request->validate([
            'title' =>'required|min:10|max:57',
            'description' => 'required|min:10|max:250',
            'keywords' => 'required|min:5|max:250'
        ]);   

        $meta = MetaTag::find($id);
        if(!isset($meta) || empty($meta)) {
            abort(404);
        }

        $meta->title = $request->title;
        $meta->description = $request->description;
        $meta->keywords = $request->keywords;

        $meta->update();

        return redirect()->route('admin.meta_tags.index')
                        ->with('success', 'Meta tags updated successfully.');
    }

    public function snippetIndex()
    {
        return view('admin.snippets.index');
    }

    public function getSnippets(Request $request)
    {
        $result = Snippet::select('id', 'name', 'location', 'code', 'is_active');

        $aColumns = ['id','page','title','description'];

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
                $query->orWhere('display', 'LIKE', "%{$sKeywords}%");
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
        $snippetData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($snippetData as $key => $aRow) 
        {

            $row = $key + 1;

            if($aRow->is_active == 1) {
                $status = "<span class='badge badge-success bg-success  bg-darken-4'>Active</span>";
            } else {
                $status = "<span class='badge badge-danger bg-danger bg-darken-4'>Inactive</span>";
            }

            $action = "<a href=\"/admin_panel/snippet/{$aRow->id}/edit\" class=\"mr-1\"><i class=\"ft-edit\"></i></a><a href=\"/admin_panel/snippet/{$aRow->id}/delete\" onclick=\"return confirm('Are you sure you want to delete this item')\"><i class=\"ft-trash-2\"></i></a>";
            
            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$row,
                @$aRow->name,
                @ucfirst($aRow->location),
                @$status,
                @$action
            );    

            $i++;

        }

        echo json_encode($output);   
    }

    public function snippetCreate()
    {
        return view('admin.snippets.create');
    }

    public function snippetStore(Request $request)
    {
        $request->validate([
            'name' =>'required|string|min:5|max:255|unique:snippets',
            'site_display' => 'required',
            'location' => 'required',
            'status' => 'required',
            'code' => 'required'
        ]);   

        $snippet = new Snippet;

        $snippet->name = $request->name;
        $snippet->display = $request->site_display;
        $snippet->page = isset($request->page) ? $request->page : NULL; 
        $snippet->location = $request->location;
        $snippet->code = $request->code;
        $snippet->is_active = $request->status;

        $snippet->save();

        return redirect()->route('admin.snippet.index')
                        ->with('success', 'Snippet created successfully.');   
    }

    public function snippetEdit($id)
    {
        $snippet = Snippet::find($id);
        if(!isset($snippet) || empty($snippet)) {
            abort(404);
        }   

        view()->share('snippet', $snippet);

        return view('admin.snippets.edit');   
    }

    public function snippetUpdate(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|string|min:5|max:255',
            'site_display' => 'required',
            'location' => 'required',
            'status' => 'required',
            'code' => 'required'
        ]);   

        $snippet = Snippet::find($id);
        if(!isset($snippet) || empty($snippet)) {
            abort(404);
        }

        $snippet->name = $request->name;
        $snippet->display = $request->site_display;
        $snippet->page = isset($request->page) && $request->site_display == 'page' ? $request->page : NULL;
        $snippet->location = $request->location;
        $snippet->code = $request->code;
        $snippet->is_active = $request->status;

        $snippet->update();

        return redirect()->route('admin.snippet.index')
                        ->with('success', 'Snippet updated successfully.');
    }

    public function snippetDestroy($id)
    {
        $snippet = Snippet::find($id);
        if(!isset($snippet) || empty($snippet)) {
            abort(404);
        }

        $snippet->delete();

        return redirect()->route('admin.snippet.index')
                        ->with('success', 'Snippet deleted successfully.');        
    }

}




