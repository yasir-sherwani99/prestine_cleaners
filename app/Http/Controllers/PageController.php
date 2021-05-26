<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Post;
use App\Contact;
use App\Service;
use App\Subscriber;
use App\Setting;
use App\Price;
use App\MetaTag;

use App\Mail\ContactFormEmail;
use App\Mail\SubscriberEmail;
use App\Http\Requests\ContactFormRequest;

use Mail;
use DB;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
//use Artesaos\SEOTools\Facades\SEOTools;

class PageController extends Controller
{
    
    public function index()
    {
        $meta = MetaTag::where('page', 'Homepage')->first();

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

        $pagePath = '/';
        view()->share('pagePath', $pagePath);

        return view('front.home.index');
    }

    public function about()
    {
        $meta = MetaTag::where('page', 'About')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/about');
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl('https://prestinecleaners.co.uk/about');
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

    	$title = 'About Us';
    	$pagePath = 'about';

    	view()->share('pagePath', $pagePath);

    	return view('front.about.index', compact('title'));
    }

    public function allServices()
    {
        $meta = MetaTag::where('page', 'Services')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/services');
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl('https://prestinecleaners.co.uk/services');
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

        $title = 'Our Services';
        $pagePath = 'services';

        view()->share('pagePath', $pagePath);

        // Services
        $services = Category::select( 'categories.*', DB::raw('(select image from category_images where category_id = categories.id order by id desc limit 1) as image'))
                    ->where('categories.active', 1)
                    ->get();

        view()->share('services', $services);

        return view('front.services.services_2', compact('title'));   
    }

    public function services($slug)
    {
        $meta = MetaTag::where('page', 'Services')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical("https://prestinecleaners.co.uk/service/{$slug}");
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl("https://prestinecleaners.co.uk/service/{$slug}");
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

    	// Get and Check the Controller's Method Parameters
    	$parameters = request()->route()->parameters();
		
		// Show 404 error if the Service's Slug is not empty
		if (!isset($parameters['slug']) || empty($parameters['slug'])) {
			abort(404);
		}

		if (isset($parameters['slug'])) {
			$slug = $parameters['slug'];
		}

		$category = Category::where('slug', $slug)->first();
		if (empty($category)) {
			abort(404);
		}
		
    	// Other Services
		$other_services = Category::where('slug', '<>', $slug)->where('active', 1)->get();
		view()->share('other_services', $other_services);
	
    	$cat_id = $this->getField($slug, 'id');;
    	$title =  $this->getField($slug, 'title');

    	$service = Post::where('category_id', $cat_id)->first();

    	$pagePath = 'service';

    	view()->share('pagePath', $pagePath);

    	return view('front.services.index', compact('service', 'title'));
    }

    public function areas()
    {
        $meta = MetaTag::where('page', 'Areas')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/areas-covered');
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl('https://prestinecleaners.co.uk/areas-covered');
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

    	$title = 'Areas Covered';
    	$pagePath = 'areas-covered';

    	view()->share('pagePath', $pagePath);
    	
    	return view('front.areas.index', compact('title'));
    }

    public function contactIndex()
    {
    	$meta = MetaTag::where('page', 'Contact')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/contact');
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl('https://prestinecleaners.co.uk/contact');
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

        $title = 'Contact';
    	$pagePath = 'contact';

    	view()->share('pagePath', $pagePath);

        $social = Setting::find(1);
        if(!isset($social) || empty($social)) {
            abort(404);
        }

        view()->share('social', $social);

    	return view('front.contact.index', compact('title'));
    }

    public function contactStore(ContactFormRequest $request)
    {
    	
    	$contact = new Contact;

    	$input = $request->only($contact->getFillable());
		foreach ($input as $key => $value) {
			$contact->{$key} = $value;
		}

		$contact->is_read = 0;

		// Save
		$contact->save();

		$objContact = new \stdClass();
        $objContact->name = $request->name;
        $objContact->email = $request->email;
        $objContact->phone = $request->phone;
        $objContact->subject = $request->subject;
        $objContact->message = $request->message;

        try {

            Mail::to('info@prestinecleaners.co.uk')->send(new ContactFormEmail($objContact));

        } catch(\Exception $e) {
            // get error here
            echo $e->getMessage();
        }

        return redirect()->route('contact.index')
                         ->with('success', "We have received your enquiry and will respond to you within 24 hours.  For urgent enquiries please call us on one of the telephone numbers.");
    
    }

    public function faqs()
    {
        $meta = MetaTag::where('page', 'FAQ')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/faqs');
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl('https://prestinecleaners.co.uk/faqs');
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

    	$title = 'Faq';
    	$pagePath = 'faq';

    	view()->share('pagePath', $pagePath);

    	return view('front.faqs.index', compact('title'));
    }

    public function prices()
    {
        $meta = MetaTag::where('page', 'Prices')->first();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/prices');
        SEOMeta::addKeyword($meta->keywords);

        OpenGraph::setDescription($meta->description);
        OpenGraph::setTitle($meta->title);
        OpenGraph::setUrl('https://prestinecleaners.co.uk/prices');
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle($meta->title);
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($meta->title);
        JsonLd::setDescription($meta->description);
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

    	$title = 'Prices';
    	$pagePath = 'prices';

    	view()->share('pagePath', $pagePath);

        $prices = Price::whereIn('item_id', [1,2,3,4,10,11,16,19])
                        ->where('active', 1)
                        ->orderBy('item_id', 'ASC')
                        ->get();

        view()->share('prices', $prices);

    	return view('front.prices.index', compact('title'));
    }

    public function subscribe(Request $request)
    {

        $this->validate($request,[
            'email' => 'required|string|email|max:255|unique:subscribers'
        ]); 
               
        $subscriber = new Subscriber;

        $subscriber->email =  $request->email;
        $subscriber->is_subscribe = 1;

        $subscriber->save();        

        $objSubscriber = new \stdClass();
        $objSubscriber->email =  $request->email;

        try {    

            Mail::to($request->email)->send(new SubscriberEmail($objSubscriber));

        } catch(\Exception $e) {
         //   echo $e->getMessage();
            return response()->json(['response' => 'partial_success']);
        }

        return response()->json(['response' => 'success']);

    }

    public function termsConditions()
    {
        SEOMeta::setTitle("Prestine Cleaners | Terms & Conditions");
        SEOMeta::setDescription('Prestine Professional Services is family-run business with the principal and ethics on which we were founded still very much at the heart of what we are today. We have a deeply held commitment to deliver excellent client satisfaction.');
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/tcs');
        SEOMeta::addKeyword('Prestine Cleaners');

        OpenGraph::setDescription('Prestine Professional Services is family-run business with the principal and ethics on which we were founded still very much at the heart of what we are today. We have a deeply held commitment to deliver excellent client satisfaction.');
        OpenGraph::setTitle('Prestine Cleaners | Terms & Conditions');
        OpenGraph::setUrl('https://prestinecleaners.co.uk/tcs');
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle('Prestine Cleaners | Terms & Conditions');
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle('Prestine Cleaners | Terms & Conditions');
        JsonLd::setDescription('Prestine Professional Services is family-run business with the principal and ethics on which we were founded still very much at the heart of what we are today. We have a deeply held commitment to deliver excellent client satisfaction.');
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

        $title = 'Terms & Conditions';
        $pagePath = 'tcs';

        view()->share('pagePath', $pagePath);

        return view('front.terms_conditions.index', compact('title'));
    }

    public function employment()
    {
        SEOMeta::setTitle("Prestine Cleaners | Employment");
        SEOMeta::setDescription('Prestine Professional Services is family-run business with the principal and ethics on which we were founded still very much at the heart of what we are today. We have a deeply held commitment to deliver excellent client satisfaction.');
        SEOMeta::setCanonical('https://prestinecleaners.co.uk/employment');
        SEOMeta::addKeyword('Prestine Cleaners');

        OpenGraph::setDescription('Prestine Professional Services is family-run business with the principal and ethics on which we were founded still very much at the heart of what we are today. We have a deeply held commitment to deliver excellent client satisfaction.');
        OpenGraph::setTitle('Prestine Cleaners | Terms & Conditions');
        OpenGraph::setUrl('https://prestinecleaners.co.uk/employment');
        OpenGraph::addProperty('type', 'cleaning company');
        OpenGraph::addProperty('locale', 'en-UK');

        TwitterCard::setTitle('Prestine Cleaners | Employment');
    //    TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle('Prestine Cleaners | Employment');
        JsonLd::setDescription('Prestine Professional Services is family-run business with the principal and ethics on which we were founded still very much at the heart of what we are today. We have a deeply held commitment to deliver excellent client satisfaction.');
        JsonLd::setType('cleaning company');
        JsonLd::addImage('https://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png');

        $title = 'Employment';
        $pagePath = 'employment';

        view()->share('pagePath', $pagePath);

        return view('front.employment.index', compact('title'));   
    }

    public function getField($slug, $column)
    {
        $column_value = Category::where('slug', $slug)->value($column);
        return $column_value;
    }

}
