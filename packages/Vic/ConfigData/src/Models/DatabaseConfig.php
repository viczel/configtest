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
 * @property string $host
 * @property string $database
 * @property string $username
 * @property string $password
 *
 */

class DatabaseConfig extends BaseServiceConfig
{

    /** @var array $names */
    protected $names = [
        'host',
        'database',
        'username',
        'password',
    ];

    /** @var string $prefix */
    protected $prefix = '';

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