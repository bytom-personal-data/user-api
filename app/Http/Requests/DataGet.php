<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

/**
 * Class DataGet
 * @package App\Http\Requests
 *
 * @property array $labels
 * @property string $owner_hash
 */
class DataGet extends Request
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
            'labels' => 'array',
            'owner_hash' => 'required|string',
        ];
    }
}
