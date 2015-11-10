<?php
/**
 * BaseController
 * The default Controller from which all other Controllers extends
 */

namespace BasicMVC\Controllers;

use BasicMVC\Registry as Registry;
use BasicMVC\Load as Load;

abstract class BaseController {
    protected $_registry;
    protected $load;

    public function __construct()
    {
        $this->_registry = Registry::getInstance();
        $this->load = new Load;
    }

    // Abstract means every extension of this class must implement this method.
    abstract public function index();

    // Magic method
    // Final means it cannot be overridden
    final public function __get($key)
    {
        if ( $return = $this->_registry->$key) {
            return $return;
        }
        return false;
    }
}
