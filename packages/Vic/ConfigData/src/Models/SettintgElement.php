<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20.02.2018
 * Time: 11:52
 */

namespace BrainySoft\ConfigData\Models;


class SettintgElement
{
    private $key = '';

    private $defaultValue = '';

    private $title = '';

    /**
     * SettintgElement constructor.
     * @param string $key
     * @param mixed $defaultValue
     * @param string $title
     */
    public function __construct($key, $defaultValue, $title)
    {
        $this->key = $key;
        $this->defaultValue = $defaultValue;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return SettintgElement
     */
    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $defaultValue
     * @return SettintgElement
     */
    public function setDefaultValue($defaultValue): self
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return SettintgElement
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

}