<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Company
 * @property UploadedFile $logo
 * @package App
 */
class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'web_site', 'logo',
    ];

    /**
     * @return HasMany|Collection|User[]
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
