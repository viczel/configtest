<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.02.2018
 * Time: 15:25
 */

namespace BrainySoft\ConfigData\Services;

use BrainySoft\ConfigData\Interfaces\CustomerKeyInterface;
use Illuminate\Support\Facades\Storage;


class CliCustomerKey implements CustomerKeyInterface
{
    // имя параметра в CLI, которое обозначает customer_key
    const CLI_CUSTOMER_KEY_OPTION_NAME = 'customer-key';

    /**
     * @var string
     */
    protected $customerKey = null;

    /**
     * @return string
     */
    public function getCustomerKey(): string
    {
        if( $this->customerKey === null ) {
            $this->customerKey = $this->calculateCustomerKey();
        }
        return $this->customerKey;
    }

    /**
     * @return string
     */
    public function calculateCustomerKey(): string
    {
        $customerKey = '';

        $sFind = '--' . self::CLI_CUSTOMER_KEY_OPTION_NAME . '=';
        if( isset($_SERVER['argv']) ) {
            foreach ($_SERVER['argv'] As $k=>$v) {
                if( strpos($v, $sFind) === 0 ) {
                    $customerKey = substr($v, strlen($sFind));
                }
            }
        }

        return $customerKey;
    }

}