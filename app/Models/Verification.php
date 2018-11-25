<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Verification
 * @package App
 *
 * @property int $id
 * @property int $data_id
 * @property string $verifier_hash
 * @property string $verify_txhash
 * @property string $verify_utxo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $verifier
 */
class Verification extends Model
{
    protected $fillable = ['txhash', 'data_id', 'verifier_hash', 'verify_utxo'];
    protected $hidden = ['id'];

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verifier_hash', 'receiver_address');
    }
}
