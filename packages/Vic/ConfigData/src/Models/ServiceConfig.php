<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20.02.2018
 * Time: 14:34
 */

namespace BrainySoft\ConfigData\Models;

use BrainySoft\ConfigData\Models\BaseServiceConfig;

/**
 * Class ServiceConfig
 * @package BrainySoft\ConfigData\Models
 *
 * @property string $title
 * @property string $settlement_account_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $IP
 * @property string $port
 * @property string $gate
 * @property string $lk
 * @property string $pf
 * @property string $fs
 * @property string $tokens
 * @property string $manager_id
 * @property string $bsauth
 * @property string $schema
 * @property string $integration_api_url
 * @property string $integration_token
 * @property string $integration_ip_list
 * @property string $integration_user
 * @property string $integration_user_text
 * @property string $leadDelete
 * @property string $is_online
 *
 */

class ServiceConfig extends BaseServiceConfig
{

    /** @var array $names */
    protected $names = [
        'title',
        'settlement_account_id',
        'created_at',
        'updated_at',
        'IP',
        'port',
        'gate',
        'lk',
        'pf',
        'fs',
        'tokens',
        'manager_id',
        'bsauth',
        'schema',
        'integration_api_url',
        'integration_token',
        'integration_ip_list',
        'integration_user',
        'integration_user_text',
        'leadDelete',
        'is_online',
    ];

    /** @var string $prefix */
    protected $prefix = 'core_';

    /**
     *
     * ServicesConfig constructor.
     * @param string $customerKey
     *
     */
    public function __construct($customerKey = '')
    {
        parent::__construct($customerKey, $this->names, $this->prefix);
    }

}