<?php

declare(strict_types = 1);

namespace App\Http\Requests\Front;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AccountUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = auth()->user();

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignoreModel($user),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
        ];

        if ($password = $this->input('password')) {
            $data['password'] = Hash::make($password);
        }

        return $data;
    }

    /**
     * @param Validator $validator
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if ($this->isOldPasswordInCorrect()) {
                $validator->errors()->add('old_password', 'Wrong your password.');
            }
        });
    }

    /**
     * @return bool
     */
    private function isOldPasswordInCorrect(): bool
    {
        if (!Hash::check($this->input('old_password'), auth()->user()->getAuthPassword())) {
            return true;
        }

        return false;
    }
}
