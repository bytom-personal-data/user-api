<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $xpub
 * @property string $keyfile
 * @property string $account_id
 * @property string $receiver_address
 * @property int $type
 */
class User extends Authenticatable
{
    // Account Types
    public const TYPE_VERIFIER = 1000;
    public const TYPE_GOVERNMENT = 900;
    public const TYPE_MEDICINE = 30;
    public const TYPE_FINANCE = 20;
    public const TYPE_BUSINESS = 10;
    public const TYPE_DEFAULT = 1;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'xpub', 'keyfile', 'type', 'account_id', 'receiver_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'keyfile', 'xpub'
    ];

    public function ownerData()
    {
        $this->hasMany(Data::class, 'owner_hash', 'receiver_address');
    }

    public function madeData()
    {
        $this->hasMany(Data::class, 'maker_hash', 'receiver_address');
    }
}
