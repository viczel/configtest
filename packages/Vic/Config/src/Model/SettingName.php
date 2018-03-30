<?php

namespace BrainySoft\Config\Models;

use Illuminate\Database\Eloquent\Model;
use App\Configs;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class SettingName
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $cast
 * @property mixed $initial
 *
 */
class SettingName extends Model
{
    //
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', ];

    protected $casts = [
        'initial' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings(): HasMany
    {
        return $this->hasMany(Configs::class, 'key', 'name');
    }
}
