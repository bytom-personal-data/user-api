<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LabelAllowance
 * @package App\Models
 *
 * @property int $id
 * @property string $accessor_hash
 * @property string $label
 * @property int $mode
 * @property bool $is_active
 */
class LabelAllowance extends Model
{
    public const READ_MODE = 1;
    public const WRITE_MODE = 2;

    protected $fillable = ['accessor_hash', 'label', 'mode', 'is_active'];
}
