<?php

namespace App\Policies;

use App\Enums\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(string $uuid): Response
    {
        $user = User::find(auth()->id());

        if ($user->getUuid() === $uuid) {
            return $this->deny(__('You cannot delete your own account.'));
        }

        if ($user->admin !== null && $user->admin->role >= Admin::Admin->value) {
            return $this->allow();
        }

        return $this->deny(__('You must be an Administrator to delete users.'), HttpResponse::HTTP_FORBIDDEN);
    }
}
