<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabelAllowance extends Model
{
    public const READ_MODE = 1;
    public const WRITE_MODE = 2;

    protected $fillable = ['accessor_hash', 'label', 'mode', 'is_active'];
}
