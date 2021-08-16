<?php

namespace App\Models\Interfaces;

interface PosterableInterface {
	/**
	 * @return mixed
	 */
	public function storePoster();
	
	/**
	 * @return mixed
	 */
	public function deletePoster();
}