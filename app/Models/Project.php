<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\DataTimeTrait;
use App\Models\Traits\UserScopeTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Project
 *
 * @package App\Models
 * @property int $id
 * @property string $name Имя проекта
 * @property string $user_id Владелец
 * @property string|null $note Описание. Замечаение.
 * @property string|null $url Сайт проекта
 * @property array|null $data Доп.данные. Резерв
 * @property string $created_at
 * @property string $updated_at
 * @property-read User $user
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereData($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereName($value)
 * @method static Builder|Project whereNote($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @method static Builder|Project whereUrl($value)
 * @method static Builder|Project whereUserId($value)
 * @mixin Eloquent
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
