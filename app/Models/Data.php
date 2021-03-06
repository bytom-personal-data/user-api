<?php

namespace App\Models;

use App\Services\Secure\Hashing;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Data
 * @package App\Models
 *
 * @property int $id
 * @property string $owner_hash
 * @property string $maker_hash
 * @property string $label
 * @property string $data
 * @property string $hash
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read $is_verified
 *
 * @property User $maker
 * @property User $owner
 * @property Verification[] $verifications
 *
 * @property string $decrypted_data
 */
class Data extends Model
{
    protected $fillable = ['hash', 'label', 'owner_hash', 'maker_hash', 'verifier_hash', 'data', 'verify_utxo'];
    protected $hidden = ['verify_utxo', 'id'];

    public function getIsVerifiedAttribute()
    {
        return $this->verify_utxo != null && $this->verify_txhash != null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maker()
    {
        return $this->belongsTo(User::class, 'maker_hash', 'receiver_address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_hash', 'receiver_address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }
}
