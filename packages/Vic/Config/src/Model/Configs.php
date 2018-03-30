<?php

namespace BrainySoft\Config\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\SettingName;

/**
 * Class Configs
 * @package App
 *
 * @property int $id
 * @property int $mfo_id
 * @property string $key
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method \Illuminate\Database\Eloquent\Builder filtered
 *
 */
class Configs extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', ];

    protected $casts = [
        'value' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mfo(): BelongsTo
    {
        return $this->belongsTo(Mfo::class, 'mfo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(SettingName::class, 'key', 'name');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $keyList
     * @return Builder
     */
    public function scopeFiltered($query, $keyList = []): Builder
    {
        return $query->whereIn('key', $keyList);
    }

}
