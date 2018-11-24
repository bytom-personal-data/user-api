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
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'xpub', 'keyfile', 'account_id', 'receiver_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'keyfile'
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
