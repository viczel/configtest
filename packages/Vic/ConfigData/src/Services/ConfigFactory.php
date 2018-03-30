<?php

namespace BrainySoft\ConfigData\Services;

use BrainySoft\ConfigData\Interfaces\CustomerKeyInterface;
use BrainySoft\ConfigData\Models\DatabaseConfig;
use BrainySoft\ConfigData\Models\ServiceConfig;

/**
 * @author Vik
 *
 * Created at 05.03.2018
 */
class ConfigFactory
{
    /** @var string $customer_key  */
    protected $customer_key = null;

    /**
     * ConfigFactory constructor.
     */
    public function __construct(CustomerKeyInterface $customerKeyInterface)
    {
        $this->customer_key = $customerKeyInterface->getCustomerKey();
    }

    /**
     * @return \BrainySoft\ConfigData\Models\DatabaseConfig
     */
    public function getDatabaseConfig(): DatabaseConfig
    {
        return new DatabaseConfig($this->customer_key);
    }

    /**
     * @return \BrainySoft\ConfigData\Models\ServiceConfig
     */
    public function getCoreConfig(): ServiceConfig
    {
        return new ServiceConfig($this->customer_key);
    }



}