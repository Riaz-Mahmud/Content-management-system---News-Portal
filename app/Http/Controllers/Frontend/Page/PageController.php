<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Models\Page;
use App\Models\Setting;
use App\Jobs\ContactUsJob;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Frontend\FrontendController;

class PageController extends FrontendController{

    protected $defaultData = [];

    function __construct(){
        $this->defaultData = parent::defaultData();
    }

    function index(Request $request, $slug){
        $slug = 'pages/'.$slug;
        $data = array();
        $data = $this->defaultData;

        $data['rows'] = Page::where('slug', $slug)->first();
        $data['rows']->content = htmlspecialchars_decode($data['rows']->content);

        parent::log($request, 'View Page: '.$data['rows']->title);

        return view('frontend.partials.pages.page.index')->with('data', $data);
    }

    function contact(Request $request){
        $data = array();
        $data = $this->defaultData;

        $settings = Setting::all();
        $settings = $settings->keyBy('settings_key');
        $data['settings'] = $settings;
        // dd($data['settings']);

        parent::log($request, 'View Contact Page');

        return view('frontend.partials.pages.contact.index')->with('data', $data);
    }

    function contactStore(Request $request){
        $data = array();
        $data = $this->defaultData;

        $mail = 'contact@almahmudriaz.com';
        Mail::to($mail)->send(new ContactUsMail($request));

        parent::log($request, 'Contact Form Submitted');

        return redirect()->route('page.contact')->with('success', 'Your message has been sent successfully.');
    }

    function privacyPolicy(Request $request){
        $data = array();
        $data = $this->defaultData;

        parent::log($request, 'View Privacy Policy Page');

        return view('frontend.partials.pages.page.privacy.index')->with('data', $data);
    }

    function tramsConditation(Request $request){
        $data = array();
        $data = $this->defaultData;

        parent::log($request, 'View Privacy Policy Page');

        return view('frontend.partials.pages.page.tramsConditation.index')->with('data', $data);
    }
}
