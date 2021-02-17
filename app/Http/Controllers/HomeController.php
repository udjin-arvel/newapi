<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Note;
use App\Models\Subscription;
use App\Repositories\NoteRepository;
use App\Repositories\NotionRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\StoryRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
     *
     * @return Response
     */
    public function run()
    {
    
        
        
        $data = Subscription::where('book_id', 8)->get();
        
        
        
        dd($data);
        
        
        return response()->json(['success' => []], $this->successStatus);
    }
}
