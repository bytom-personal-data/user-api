<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Validation\Rule;

/**
 * Class UserSignup
 * @package App\Http\Requests
 *
 * @property string $username
 * @property string $password
 * @property string $password_repeat
 * @property integer $type
 */
class UserSignup extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'password_repeat' => 'same:password',
            'account_type' => [
                'integer',
                Rule::in([User::TYPE_DEFAULT, User::TYPE_FINANCE, User::TYPE_MEDICINE, User::TYPE_BUSINESS])
            ]
        ];
    }
}
