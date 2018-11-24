<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AllowanceRequest
 * @package App\Models
 *
 * @property int $id
 * @property string $label
 * @property string $accessor_hash
 * @property string $owner_hash
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $accessor
 * @property User $owner
 */
class AllowanceRequest extends Model
{
    public const NOT_ACCESSED = 0;
    public const ACCESSED = 1;

    protected $fillable = ['label', 'accessor_hash', 'owner_hash', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accessor()
    {
        return $this->belongsTo(User::class, 'accessor_hash', 'receiver_address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_hash', 'receiver_address');
    }
}
