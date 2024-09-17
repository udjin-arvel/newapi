<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
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
	 * @param string $directory
	 *
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 */
    public function file(string $filename, string $directory = DIRECTORY_SEPARATOR)
    {
    	$path = $directory ? $directory . DIRECTORY_SEPARATOR . $filename : $filename;

    	if (! Storage::exists($path)) {
		    return Response::file(public_path('img/noimage.gif'));
	    }

    	return Response::file(Storage::path($path));
    }

    /**
     * Run custom code.
     */
    public function run()
    {
        dispatch(new TestJob);
	    dd(1);
    }
}
