<?php

namespace BrainySoft\Config\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

/*
 * Class CurrentMfos
 * @package App
 *
 * @property integer $id
 * @property string $customer_key
 * @property string $title
 * @property string $settlement_account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $IP
 * @property integer $port
 * @property string $gate
 * @property string $lk
 * @property string $pf
 * @property string $fs
 * @property string $tokens
 * @property integer $manager_id
 * @property string $bsauth
 * @property string $schema
 * @property string $integration_api_url
 * @property string $integration_token
 * @property string $integration_ip_list
 * @property string $integration_user
 * @property string $integration_user_text
 * @property \Carbon\Carbon $leadDelete
 * @property integer $is_online
 * @property string $ui_url
 * @property \Illuminate\Database\Eloquent\Collection $settings
 *
 */

class CurrentMfos extends Model
{
    protected $table = 'mfo_list';

    protected $guarded = [];

    protected $dates = ['leadDelete'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings(): HasMany
    {
        return $this->hasMany(CurrentSettings::class, 'customer-key', 'customer_key');
    }

}
