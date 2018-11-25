<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Allowance
 * @package App\Models
 *
 * @property int $id
 * @property string $accessor_hash
 * @property string $owner_hash
 * @property string $label
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Allowance extends Model
{
    protected $fillable = ['accessor_hash', 'owner_hash', 'label'];
    protected $hidden = ['id'];

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
