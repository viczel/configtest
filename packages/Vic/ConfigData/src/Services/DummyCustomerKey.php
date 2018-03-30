<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.02.2018
 * Time: 15:25
 */

namespace BrainySoft\ConfigData\Services;

use BrainySoft\ConfigData\Interfaces\CustomerKeyInterface;


class DummyCustomerKey implements CustomerKeyInterface
{

    /**
     * @var string
     */
    protected $customerKey = null;

    /**
     * DummyCustomerKey constructor.
     *
     * @param string $customerKey
     */
    public function __construct(string $customerKey = '')
    {
        $this->customerKey = $customerKey;
    }


    /**
     * @return string
     */
    public function getCustomerKey(): string
    {
        return $this->customerKey;
    }

}