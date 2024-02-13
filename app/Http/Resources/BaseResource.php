<?php

namespace App\Http\Resources;

use App\Models\BaseModel;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BaseResource
 * @package App\Http\Resources
 *
 * @property bool $isSkimpyMode
 *
 * @mixin BaseModel
 */
class BaseResource extends JsonResource
{
    /**
     * Режим минимального количества данных
     * @var bool $isSkimpyMode
     */
    protected bool $isSkimpyMode = false;
    
    /**
     * @return BaseResource
     */
    public function enableSkimpyMode(): BaseResource
    {
        $this->isSkimpyMode = true;
        return $this;
    }
    
    /**
     * Вернуть минимальный объем данных
     * @return array
     */
    protected function toSkimpyArray(): array
    {
        return [];
    }
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->whenLoaded('user')),
            'created_at' => optional($this->created_at)->format('d.m.Y H:i'),
        ];
    }
    
    /**
     * Resolve the resource to an array.
     *
     * @param  \Illuminate\Http\Request|null  $request
     * @return array
     */
    public function resolve($request = null): array
    {
        if ($this->isSkimpyMode) {
            return $this->filter($this->toSkimpyArray());
        }
        
        return parent::resolve($request);
    }
}
