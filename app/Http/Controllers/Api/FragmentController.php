<?php
    
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FragmentRequest;
use App\Http\Resources\FragmentResource;
use App\Models\Fragment;
use Log;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class FragmentController extends Controller
{
    /**
     * @param FragmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FragmentRequest $request, int $id)
    {
        /**
         * @var Fragment $fragment
         */
        $fragment = Fragment::where('id', $id)
            ->first()
            ->update($request->all());
        
        return (new FragmentResource($fragment))
            ->response()
            ->setStatusCode(201);
    }
}
