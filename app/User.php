<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string password
 * @property int $role_id
 * @property int|null $company_id
 * @property BelongsTo|Company|null $company
 * @property BelongsTo|UserRole|null $role
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'company_id',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return BelongsTo|Company|null
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsTo|UserRole|null
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }
}
