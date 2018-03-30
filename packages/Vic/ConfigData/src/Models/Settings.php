<?php

namespace BrainySoft\ConfigData\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use BrainySoft\ConfigData\Models\Customer;

class Settings extends Model
{
    /**
     *
     * @property string customer_key
     * @property string key
     * @property string value
     * @property string created_at
     * @property string updated_at
     * @property \BrainySoft\ConfigData\Models\Customer @customer
     *
     */

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_key', 'customer_key');
    }

}
