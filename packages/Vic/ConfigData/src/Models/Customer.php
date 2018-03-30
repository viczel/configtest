<?php

namespace BrainySoft\ConfigData\Models;

use Illuminate\Database\Eloquent\Model;
use BrainySoft\ConfigData\Models\Settings;

class Customer extends Model
{
    /**
     * Class Customer
     * @package BrainySoft\ConfigData\Models
     *
     * @property string $customer_key
     * @property string $title
     *
     */

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings() {
        return $this->hasMany(
            Settings::class,
            'customer_key',
            'customer_key'
        );
    }

}
