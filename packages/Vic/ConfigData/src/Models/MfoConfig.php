<?php

namespace BrainySoft\Coredata\Models;

use DB;


/**
 * Class MfoConfig
 * @package BrainySoft\Coredata\Models
 *
 * @property string $customer_key
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
class MfoConfig
{

    /** @var string $customerKey */
    protected $customerKey;

    /** @var array $values */
    protected $values = null;

    /** @var string $tableName */
    protected $tableName = 'mfo_list';

    /**
     * MfoConfig constructor.
     * @param string $customerKey
     * @param string $tableName
     */
    public function __construct($customerKey, $tableName = '')
    {
        $this->customerKey = $customerKey;
        if( !empty($tableName) ) {
            $this->tableName = $tableName;
        }
    }

    /**
     * Получение значения настройки
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $aVal = $this->getAllSettings();
        if (array_key_exists($name, $aVal)) {
            return $aVal[$name];
        }
        throw new \InvalidArgumentException('Property ["' . $name . '"] is undefined in ' . self::class . ' [' . $this->customerKey . ']');
    }

    /**
     * Получение всех настроек
     *
     * @return array
     */
    public function getAllSettings()
    {
        if ($this->values === null) {
            $data = $this->selectTableData();

            $this->values = $this->prepareKeyValueMap($data);
        }
        return $this->values;
    }

    /**
     * Преобразование выбранных их базу записей в массив ключ - значение
     *
     * @param array $data
     * @return array
     */
    public function prepareKeyValueMap($data)
    {
        $values = [];
        if( $data ) {
            $data = json_decode(json_encode($data), true);
            unset($data['id']);
            $values = $data;
        }
        return $values;
    }

    /**
     * Получение значений из базы
     *
     * @return array
     */
    public function selectTableData()
    {
        $data = DB::table($this->tableName)
            ->where('customer_key', $this->customerKey)
            ->first();

        return $data;
    }


}