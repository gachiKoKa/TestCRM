<?php

namespace App;

use App\Services\CompanyLogoHandler;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $web_site
 * @property string $logo
 * @property HasMany|Collection|User[] $users
 * @property string $logoUrl
 * @package App
 */
class Company extends Model
{
    /**
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

    public function setLogoUrl()
    {
        if ($this->logo != '') {
            $this->logo = asset(CompanyLogoHandler::LOGOS_DIR . '/' . $this->logo);
        }
    }
}
