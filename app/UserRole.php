<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 * @property int $id
 * @package App
 */
class UserRole extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
