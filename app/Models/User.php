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
 */
class User extends Authenticatable
{
    use Notifiable;

    // Account Types
    const TYPE_ACCOUNT_USER = 1;
    const TYPE_ACCOUNT_ORGANISATION = 2;
    const TYPE_ACCOUNT_GOVERNMENT = 3;

    // Organisation Types
    const ORGANISATION_TYPE_MEDICINE = 1;
    const ORGANISATION_TYPE_MONEY = 2;
    const ORGANISATION_TYPE_JOB = 3;
    const ORGANISATION_TYPE_LAW = 4;
    const ORGANISATION_TYPE_PROPERTY = 5;

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
}
