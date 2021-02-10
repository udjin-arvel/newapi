<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repositories\NoteRepository;
use App\Repositories\NotionRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\StoryRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;

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
    
        $data = new StoryRepository;
        
        
        dd($data->getOne(47));
        
        
        return response()->json(['success' => []], $this->successStatus);
    }
}
