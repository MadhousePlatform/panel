<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UserController extends Controller
{
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
     * @param  string  $uuid
     * @return JsonResponse
     */
    public function show(string $uuid): JsonResponse
    {
        try {
            $user = User::whereUuid($uuid)
                ->with(['admin'])->first();

            Log::debug(sprintf("%s called by %s", __METHOD__, auth()->user()->name));
            return response()->json(['user' => $user], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            Log::debug(
                sprintf("Error in %s called by %s. [Message: %s]",
                    __METHOD__,
                    auth()->user()->name,
                    $e->getMessage()
                ));
            return response()->json([
                'message' => $e->getMessage(),
            ], $this->getErrorCode($e->getCode()));
        }
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
