<?php

namespace BrainySoft\Config\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/*
 * Class CurrentSettings
 * @package App

 * @property string $id
 * @property string $customer-key
 * @property string $key
 * @property string $value
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 *
 * @property \App\CurrentMfos mfo
 *
 */
class CurrentSettings extends Model
{
    protected $table = 'settings';

    protected $guarded = [];

    protected $appends = [
        'settingName',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mfo(): BelongsTo
    {
        return $this->belongsTo(CurrentMfos::class, 'customer-key', 'customer_key');
    }

    /**
     * @return string
     */
    public function getSettingNameAttribute(): string
    {
        $labels = cpFunctions::getLabels();
        return isset($labels[$this->key]) ? $labels[$this->key] : $this->key;
    }

}
