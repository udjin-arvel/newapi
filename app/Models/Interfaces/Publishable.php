<?php

namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface Publishable
 * @package App\Models\Interfaces
 */
interface Publishable
{
	public function scopeIsPublic(Builder $query, bool $value = true);
}