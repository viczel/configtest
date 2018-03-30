<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08.02.2018
 * Time: 13:40
 */

namespace BrainySoft\ConfigData\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class BaseServiceConfig
 * @package BrainySoft\Coredata\Models
 *
 * @property string $customer_key
 *
 */
class BaseServiceConfig
{
    /** @var string $customerKeyfieldName */
    protected $customerKeyfieldName = 'customer-key';

    /** @var string $customerKey */
    protected $customerKey;

    /** @var array $values */
    protected $values = null;

    /** @var array $names */
    protected $names = [];

    /** @var string $prefix */
    protected $prefix = '';

    /** @var string $tableName */
    protected $tableName = 'settings';

    /**
     * ConfigData constructor.
     * @param string $customerKey
     * @param string $prefix
     * @param array $names
     */
    public function __construct($customerKey = '', $names = [], $prefix = '')
    {
        $this->customerKey = $customerKey;
        if( !empty($names) ) {
            $this->names = $names;
        }
        $this->prefix = $prefix;
    }

    /**
     * Получение одного параметра
     *
     * @param string $paramName
     * @return mixed
     */
    public function getParameter($paramName = '', $defaultValue = null)
    {
        $aVal = $this->getAllSettings();
        return array_key_exists($paramName, $aVal) ? $aVal[$paramName] : $defaultValue;
    }

    /**
     * Получение значения настройки
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if( in_array($name, ['customerKey', 'customer_key', ]) ) {
            return $this->customerKey;
        }

        $aVal = $this->getAllSettings();
        if (array_key_exists($name, $aVal)) {
            return $aVal[$name];
        }
        throw new \InvalidArgumentException('Property ["' . $this->prefix . $name . '"] is undefined in ' . self::class . ' [' . $this->customerKey . ']');
    }

    /**
     * Обновление настроек по одной
     *
     * @param string $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if( in_array($name, ['customerKey', 'customer_key', ]) ) {
            $this->customerKey = $value;
            $this->refresh();
        }

        $settings = $this->getAllSettings();
        if (!array_key_exists($name, $settings)) {
            throw new \DomainException("Error set undefined setting {$name} with value {$value}");
        }

        $this->updateTableData($name, $value);

        $this->refresh();
    }

    /**
     * Обновление настроек пачкой
     *
     * @param array $aval key - config key, value - new config value
     */
    public function updateValues($aVal = [])
    {
        if (count($aVal) > 0) {
            $aSettings = $this->getAllSettings();
            foreach ($aVal As $fld => $val) {
                if (array_key_exists($fld, $aSettings)) {
                    $this->updateTableData($fld, $val);
                }
            }
            $this->refresh();
        }
    }

    /**
     * Преобразование имен переменных в реальные ключи в таблице
     *
     * @return array
     */
    public function getRealKeyNames()
    {
        $prefix = $this->prefix;
        return array_map(
            function ($el) use ($prefix) {
                return $prefix . $el;
            },
            $this->names
        );
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
        foreach ($data As $el) {
            $sKey = substr($el->key, strlen($this->prefix));
            $values[$sKey] = $el->value;
            $val = trim(strtolower($values[$sKey]));
            if ($val === 'true') {
                $values[$sKey] = true;
            } else if ($val === 'false') {
                $values[$sKey] = false;
            }
        }

        foreach ($this->names As $field) {
            if( !array_key_exists($field, $values) ) {
                $values[$field] = null;
            }
        }
        return $values;
    }

    /**
     * Обновление настроек
     */
    public function refresh()
    {
        $this->values = null;
        $this->getAllSettings();
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
     * Получение значений из базы
     *
     * @return array
     */
    public function selectTableData()
    {
        $realKeys = $this->getRealKeyNames();
        $data = DB::table($this->tableName)
            ->where($this->customerKeyfieldName, $this->customerKey)
            ->whereIn('key', $realKeys)
            ->get();

        return $data;
    }

    /**
     * Изменение одной настройки в базе
     *
     * @param string $key
     * @param string $value
     */
    public function updateTableData($name = '', $value = '') {
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }

        $count = DB::table($this->tableName)
            ->where($this->customerKeyfieldName, $this->customerKey)
            ->where('key', $this->prefix . $name)
            ->update(['value' => $value]);

        if( $count == 0 ) {
            DB::table($this->tableName)
                ->insert([$this->customerKeyfieldName => $this->customerKey, 'key' => $this->prefix . $name, 'value' => $value]);
        }
    }

    /**
     * Подсчет количества настроек в таблице
     *
     * @return int
     */
    public function countTableSettings() {
        return DB::table($this->tableName)
            ->where($this->customerKeyfieldName, $this->customerKey)
            ->whereIn('key', $this->getRealKeyNames())
            ->count();
    }

}
