<?php

namespace App\Jobs;

use App\Helpers\ImageHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class ImageResize
 * @package App\Jobs
 */
class ImageResize implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
	/**
	 * @var string
	 */
	protected $directory;
	
	/**
	 * @var string
	 */
	protected $filename;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filename, string $directory)
    {
	    $this->filename = $filename;
	    $this->directory = $directory;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    ImageHelper::previewResize($this->filename, $this->directory);
    }
}
