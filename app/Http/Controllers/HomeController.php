<?php

namespace App\Http\Controllers;

use App\Events\UpdateNotifications;
use App\Http\Controllers\Api\NotionController;
use App\Models\Book;
use App\Models\Description;
use App\Models\Notification;
use App\Models\Story;
use App\Models\StoryComment;
use App\Models\Subscription;
use App\Repositories\NotionRepository;
use App\Repositories\SeriesRepository;
use App\Repositories\StoryRepository;
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
        
        $d = new NotionController;
        
        dd($d);
        
        exit;
    }
}
