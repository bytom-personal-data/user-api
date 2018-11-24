<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiFormRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        $errors = array_merge(['is_valid' => false, 'errors' => $validator->errors(), 'params' => $this->all()]);
        throw new HttpResponseException(response()->json($errors, 200));
    }
}
