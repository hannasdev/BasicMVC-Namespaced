<?php
/**
 * Registry
 * Singleton
 * Based on: https://www.youtube.com/watch?v=-Vkl3spgDUM&list=PL8931096D81D44C4E&index=3
 */

namespace BasicMVC;

class Registry
{
    private static $_instance;

    private $_storage;

    private function __construct() {}

    public static function getInstance()
    {
        if ( ! self::$_instance instanceof self) {
            self::$_instance = new Registry;
        }
        return self::$_instance;
    }

    // Magic methods

    public function __set($key, $val)
    {
        $this->_storage[$key] = $val;
    }

    public function __get($key)
    {
        if (isset($this->_storage[$key])) {
            return $this->_storage[$key];
        }
        return false;
    }
}
