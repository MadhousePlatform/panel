<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Enums\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class UpdateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['name' => "array", 'email' => "array"])]
    public function rules(): array
    {
        return [
            'name' => ['required_unless:action,removeRole', 'string', 'max:255'],
            'email' => ['required_unless:action,removeRole', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->id)],
            'user' => ['required_if:action,removeRole'],
            'action' => ['in:removeRole']
        ];
    }
}
