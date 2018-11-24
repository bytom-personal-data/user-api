<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Data
 * @package App\Http\Resources
 *
 * @property int $id
 * @property string $owner_hash
 * @property string $maker_hash
 * @property string $label
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read $is_verified
 *
 * @property User $maker
 * @property User $owner
 * @property Verification[] $verifications
 */
class Data extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $basicData = [
            'id' => $this->id,
            'label' => $this->label,
            'owner' => $this->owner,
            'maker' => $this->maker,
            'data' => $this->data,
            'verifications' => $this->verifications,
            'is_verified' => $this->is_verified,
            'created_at' => $this->created_at,
        ];

        return $basicData;
    }
}
