<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 * @property int $id
 * @property string $name
 * @package App
 */
class UserRole extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
