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

    public function update(string $uuid): Response
    {
        $user = User::find(auth()->id());

        if ($user->admin === null) {
            return $this->deny(__('You must be an Administrator to edit users.'), HttpResponse::HTTP_FORBIDDEN);
        }

        if ($user->admin->role < Admin::Basic->value) {
            return $this->deny(__('You do not have permission to delete users.'), HttpResponse::HTTP_FORBIDDEN);
        }

        return $this->allow();
    }


    public function delete(string $uuid): Response
    {
        $user = User::find(auth()->id());

        if ($user->getUuid() === $uuid) {
            return $this->deny(__('You cannot delete your own account.'), HttpResponse::HTTP_FORBIDDEN);
        }

        if ($user->admin === null) {
            return $this->deny(__('You must be an Administrator to delete users.'), HttpResponse::HTTP_FORBIDDEN);
        }

        if ($user->admin->role < Admin::Admin->value) {
            return $this->deny(__('You do not have permission to delete users.'), HttpResponse::HTTP_FORBIDDEN);
        }

        return $this->allow();
    }
}
