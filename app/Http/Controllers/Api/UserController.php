<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidOperationException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            if ($request->has('per_page')) {
                $per_page = $request->get('per_page');
            } else {
                $per_page = 25;
            }

            Log::debug(sprintf("%s requested by %s", __METHOD__, auth()->user()));
            $users = (new User)->with('admin')->paginate($per_page);

            if ($users->count() < 1) {
                Log::error(
                    sprintf("Invalid Operation in %s:%s", __METHOD__, __LINE__),
                    [compact('request'), compact('per_page')]
                );
                throw new InvalidOperationException(__('This operation is invalid.'));
            }

            return response()->json($users, HttpResponse::HTTP_OK);
        } catch (InvalidOperationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            ], $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        //
    }
}
