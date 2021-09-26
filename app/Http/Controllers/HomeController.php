<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    public $successStatus = 200;
    
    
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
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    
    /**
     * Run custom code.
     */
    public function run()
    {
    	
    	$d = Subscription::find(1);
	    
	    dd($d->getSubscriptionText());
	    
        exit;
    }
}
