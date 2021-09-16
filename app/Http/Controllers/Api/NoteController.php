<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\NoteFilter;
use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NoteController extends Controller
{
	/**
	 * @param NoteFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(NoteFilter $filter)
	{
		return NoteResource::collection(
			Note::filter($filter)
				->with(['tags'])
				->get()
		);
	}
	
	/**
	 * @param int $id
	 * @return NoteResource
	 */
	public function show(int $id)
	{
		return new NoteResource(
			Note::findOrFail($id)->load(['tags'])
		);
	}
	
	/**
	 * @param NoteRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(NoteRequest $request)
	{
		$note = Note::create($request->all());
		
		if ($request->has('tags')) {
			$note->tags()->attach($request->get('tags'));
		}
		
		return (new NoteResource($note))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param NoteRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(NoteRequest $request, int $id)
	{
		$notion = Note::findOrFail($id)->update($request->all());
		
		if ($request->has('tags')) {
			$notion->syncTags($request->get('tags'));
		}
		
		return (new NoteResource($notion))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function destroy(int $id)
	{
		Note::findOrFail($id)->delete();
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
