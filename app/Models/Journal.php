<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\DataTimeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Journal
 * @package App\Models
 */
class Journal extends Model
{
    use DataTimeTrait;

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
