<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\DataTimeTrait;
use App\Models\Traits\UserScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Project
 * @package App\Models
 */
class Project extends Model
{
    use DataTimeTrait, UserScopeTrait;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'array'
    ];


    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
