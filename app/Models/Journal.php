<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Journal
 *
 * @package App\Models
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Journal query()
 * @mixin Eloquent
 */
class Journal extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
