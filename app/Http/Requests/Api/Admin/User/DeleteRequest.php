<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Enums\Admin;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (auth()->user()->admin->role >= Admin::Admin->value) {
            return true;
        }
        return false;
    }
}
