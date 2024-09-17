<?php

namespace App\Jobs;

use App\Helpers\ImageHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

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
	protected $filename;

	/**
	 * Create a new job instance.
	 *
	 * @param string $filename
	 */
    public function __construct(string $filename)
    {
	    $this->filename = $filename;
    }

	/**
	 * Execute the job.
	 *
	 * @return void
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
    public function handle()
    {
	    ImageHelper::previewResize($this->filename);
    }
}
