<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.02.2018
 * Time: 15:25
 */

namespace BrainySoft\ConfigData\Services;

use BrainySoft\ConfigData\Interfaces\CustomerKeyInterface;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;


class RequestCustomerKey implements CustomerKeyInterface
{
    // имя параметра в URL, которое обозначает customer_key
    const ROUTER_CUSTOMER_KEY_PATH_VAR_NAME = 'customer_key';

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
        $customer_key = App('router')->input(self::ROUTER_CUSTOMER_KEY_PATH_VAR_NAME, '');
        $customer_key2 = Request::header('customer-key');

        if( empty($customer_key) ) {
            $customerKey = $customer_key2;
        }
        else {
            $customerKey = $customer_key;
            if( $customer_key != $customer_key2 ) {
                $sError = print_r(
                    [
                        'customer_key' => $customer_key,
                        'customer_key2' => $customer_key2,
                        'url' => Request::fullUrl(),
                    ],
                    true);
                Storage::disk('local')->append('customerkey.error', $sError);
            }
        }

        return $customerKey;
    }


}