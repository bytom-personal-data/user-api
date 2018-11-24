<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DataAdd
 * @package App\Http\Requests
 *
 * @property string $data
 * @property string $owner_hash
 * @property string $label
 */
class DataAdd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|string',
            'label' => 'required|string',
            'owner_hash' => 'string',
        ];
    }
}
