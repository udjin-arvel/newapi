<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Storage;
use Response;

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
        // $this->middleware('auth');
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
	 * Получить изображение из storage
	 *
	 * @param string $filename
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 */
    public function file($filename)
    {
    	if (! Storage::exists($filename)) {
		    return Response::file(public_path('img/noimage.gif'));
	    }
    	
    	return Response::file(storage_path('app/tb/' . $filename));
    }
    
    /**
     * Run custom code.
     */
    public function run()
    {
	    dd(1);
    }
}
