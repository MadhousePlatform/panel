<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\User\{
    CreateRequest,
    UpdateRequest
};
use App\Models\User;
use DB;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Log;
use Ramsey\Uuid\Uuid;
use Redirect;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Throwable;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $user = new User;
        DB::transaction(function () use ($user, $request) {
            $user
                ->setUuid(Uuid::uuid4())
                ->setName($request->get('name'))
                ->setEmail($request->get('email'))
                ->setPassword(bin2hex(openssl_random_pseudo_bytes(32)))
                ->save();
        });

        activity('admin')
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties($request->all())
            ->log('created user');

        return response()->json([
            'message' => __('User has been created.'),
        ], HttpResponse::HTTP_OK);
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
                ->with(['admin']);

            if ($user->count() === 0) {
                throw new ModelNotFoundException(__('This user could not be found.'), HttpResponse::HTTP_NOT_FOUND);
            }

            activity('admin')
                ->performedOn($user->first())
                ->causedBy(auth()->user())
                ->log('viewed user');

            Log::debug(sprintf("%s called by %s", __METHOD__, auth()->user()->name));
            return response()->json(['user' => $user->first()], HttpResponse::HTTP_OK);
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
     * @param  UpdateRequest  $request
     * @param  string  $uuid
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdateRequest $request, string $uuid): JsonResponse
    {
        $user = User::whereUuid($uuid)->first();
        DB::transaction(function () use ($user, $request) {
            $user->setName($request->get('name'))
                ->setEmail($request->get('email'))
                ->save();

            activity('admin')
                ->performedOn($user)
                ->causedBy(auth()->user())
                ->withProperties($request->all())
                ->log('updated user');
            if($request->get('role') !== null) {
                DB::transaction(function () use ($user, $request) {
                    $admin = Admin::firstOrCreate(['user_id' => $user->id, 'role' => $request->get('role')['id']]);
                    $admin = Admin::find($admin->id);
                    activity('admin')
                        ->performedOn($admin)
                        ->causedBy(auth()->user())
                        ->withProperties($request->all())
                        ->log('updated user');
                });
            }
        });

        return response()->json(['message' => __('User has been updated.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return Response|RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(string $uuid): Response|RedirectResponse
    {
        $this->authorize('delete', User::class);

        $user = User::whereUuid($uuid)->first();

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->admin?->delete();
        $user->delete();

        activity('admin')
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->log('deleted user');

        return Redirect::route('admin.users.index', [], HttpResponse::HTTP_SEE_OTHER);
    }
}
