<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    protected $fillable = ['xpub', 'txid', 'created_at', 'updated_at'];
}
