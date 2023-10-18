<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Traits\GalleryUploadTrait;
use App\Http\Filters\CharacterFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CharacterController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class CharacterController extends Controller
{
    use GalleryUploadTrait;
    
    /**
     * @var string
     */
    protected $directory = 'characters';
    
    /**
     * @var string
     */
    protected $model = Character::class;
    
    
    /**
     * @param CharacterFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CharacterFilter $filter): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CharacterResource::collection(
            Character::filter($filter)
                ->with(['user', 'tags', 'images'])
                ->get()
        );
    }
    
    /**
     * @param int $id
     * @return CharacterResource
     */
    public function show(int $id): CharacterResource
    {
        return new CharacterResource(
            Character::findOrFail($id)->load(['user', 'tags', 'images'])
        );
    }
    
    /**
     * @param CharacterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CharacterRequest $request): \Illuminate\Http\JsonResponse
    {
        /**
         * @var Character $model
         */
        $model = Character::create($request->all());
        
        if ($request->has('tags')) {
            $model->tags()->attach($request->get('tags'));
        }
        
        return (new CharacterResource($model))
            ->response()
            ->setStatusCode(201);
    }
    
    /**
     * @param CharacterRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CharacterRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $model = Character::findOrFail($id)->update($request->all());
        
        if ($request->has('tags')) {
            $model->syncTags($request->get('tags'));
        }
        
        return (new CharacterResource($model))
            ->response()
            ->setStatusCode(201);
    }
    
    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $model = Character::findOrFail($id)
            ->with('images')
            ->first();
    
        $this->removeContentGallery($model);
        $model->delete();
        
        return (new JsonResource(collect($id)))
            ->response()
            ->setStatusCode(200);
    }
    
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCharacterTraits(): \Illuminate\Http\JsonResponse
    {
        return (new JsonResource(collect(Character::TRAITS)->sort()))
            ->response()
            ->setStatusCode(200);
    }
}
