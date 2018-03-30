<?php

namespace BrainySoft\Config\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Mfo
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property int $online
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Illuminate\Database\Eloquent\Collection $settings
 *
 */
class Mfo extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings(): HasMany // $list = []
    {
        $query = $this->hasMany(Configs::class, 'mfo_id');
        if( !empty($list) ) {
            $query->filtered($list);
        }
        return $query;
    }

}
