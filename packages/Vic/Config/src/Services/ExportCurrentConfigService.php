<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30.03.2018
 * Time: 14:19
 */

class ExportCurrentConfigService
{

    public function export() {
        set_time_limit(0);
        Mfo::query()->truncate();
        Configs::query()->truncate();
        SettingName::query()->truncate();

        $mfos = CurrentMfos::with(['settings'])
            ->get();

        $mfoListFields = [
            'IP' => 'string',
            'port' => 'int',
            'gate' => 'string',
            'lk' => 'string',
            'pf' => 'string',
            'fs' => 'string',
            'tokens' => 'string',
            'manager_id' => 'arraylist',
            'bsauth' => 'string',
            'schema' => 'string',
            'integration_api_url' => 'string',
            'integration_token' => 'string',
            'integration_ip_list' => 'arraynewline',
            'integration_user' => 'int',
            'integration_user_text' => 'string',
            'leadDelete' => 'date',
            'ui_url' => 'string',
        ];
        $appended = [];
        foreach ($mfos As $mfo) {
            /** @var \App\CurrentMfos $mfo */
            $appended[] = $mfo->customer_key;
            $newMfo = new Mfo([
                'name' => $mfo->customer_key,
                'title' => $mfo->title,
                'online' => $mfo->is_online,
            ]);
            $newMfo->save();

            foreach ($mfoListFields As $oldMfoField => $cast) {
                $val = $this->castValue($mfo->{$oldMfoField}, $cast);

                $newMfo->settings()->create([
                    'key' => $oldMfoField,
                    'value' => $val,
                ]);
                $this->appendSettingName($oldMfoField, $val);
            }

            foreach ($mfo->settings As $setting){
                /** @var \App\CurrentSettings $setting */
                $newMfo->settings()->create([
                    'key' => $setting->key,
                    'value' => $setting->value,
                ]);
                $this->appendSettingName($setting->key, $setting->value);
            }
        }

        return $appended;
    }

    /**
     * @param string $name
     * @param string $cast
     * @param mixed $default
     * @return int
     */
    public function appendSettingName($name, $value) {
        $name = trim($name);
        $settingCount = SettingName::query()->where('name', $name)->count();
        if( $settingCount > 0 ) {
            return 0;
        }
        $labels = cpFunctions::getLabels();
        $label = isset($labels[$name]) ? $labels[$name] : $name;
        $description = '';
        $p1 = strpos($label, ',');
        $p2 = strpos($label, ':');
        if( $p1 === false ) {
            if( $p2 !== false ) {
                $description = substr($label, $p2 + 1);
                $label = substr($label, 0, $p2);
            }
        }
        else {
            if( $p2 !== false ) {
                $p = min($p1, $p2);
                $description = substr($label, $p + 1);
                $label = substr($label, 0, $p);
            }
            else {
                $description = substr($label, $p1 + 1);
                $label = substr($label, 0, $p1);
            }

        }
        $description = trim($description, " ().,\n\r-");
        $setting = new SettingName(
            [
                'name' => $name,
                'title' => $label,
                'description' => $description,
                'initial' => $this->getDefaultValue($value),
                'cast' => $this->getCastValue($value),
            ]
        );


        $setting->save();
        return $setting->id;
    }

    /**
     * @param $value
     * @return array|bool|float|int|string
     */
    public function getDefaultValue($value) {
        $default = $value;
        if( is_array($value) ) {
            $default = [];
        }
        else if( is_integer($value) ) {
            $default = 0;
        }
        else if( is_double($value) ) {
            $default = 0.0;
        }
        else if( is_bool($value) ) {
            $default = false;
        }
        else if( is_string($value) ) {
            $default = '';
        }
        return $default;
    }

    /**
     * @param $value
     * @return string
     */
    public function getCastValue($value) {
        $cast = '';
        if( is_array($value) ) {
            $cast = 'array';
        }
        else if( is_integer($value) ) {
            $cast = 'int';
        }
        else if( is_double($value) ) {
            $cast = 'double';
        }
        else if( is_bool($value) ) {
            $cast = 'bool';
        }
        else if( is_string($value) ) {
            $cast = 'string';
        }
        return $cast;
    }


    /**
     * @param string $value
     * @param string $cast
     * @return bool|Carbon|float|int|mixed|null|string
     */
    public function castValue($value, $cast) {
        $cast = trim(strtolower($cast));
        $value = trim($value);

        if( in_array($cast, ['int', 'integer',]) ) {
            return intval($value);
        }

        if( in_array($cast, ['double', 'float',]) ) {
            return floatval($value);
        }

        if( in_array($cast, ['date', 'time', 'datetime', 'timestamp', ]) ) {
            if( empty($value) ) {
                return null;
            }

            if( strpos($value, '0000-00-00') === 0 ) {
                return null;
            }
            return Carbon::parse($value, date_default_timezone_get());
        }

        if( in_array($cast, ['bool', 'boolean', ]) ) {
            $value = strtolower(trim($value));
            if( $value == 'true' ) {
                return true;
            }
            if( $value == 'false' ) {
                return false;
            }

            return intval($value) ? true : false;
        }

        if( in_array($cast, ['arraylist', ]) ) {
            if( empty($value) ) {
                return [];
            }

            return array_reduce(
                explode(',', $value),
                function ($carry, $el) {
                    $v = intval(trim($el));
                    $carry[] = $v;
                    return $carry;
                },
                []
            );
        }

        if( in_array($cast, ['arraynewline', ]) ) {
            if( empty($value) ) {
                return [];
            }

            return array_reduce(
                explode("\n", $value),
                function ($carry, $el) {
                    $v = trim($el);
                    $carry[] = $v;
                    return $carry;
                },
                []
            );
        }

        return trim($value);
    }

}