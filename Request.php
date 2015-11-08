<?php
/**
 * Request
 * Turns the URI into Controller, Method and Arguments
 */

namespace BasicMVC;

class Request
{
    private $_controller;
    private $_method;
    private $_args;

    public function __construct()
    {
        $parts = array_filter($this->parseUrl()); // remove any empty elements

        $this->_controller = ($controller = array_shift($parts)) ? $controller: 'index';
        $this->_method     = ($method = array_shift($parts)) ? $method: 'index';
        $this->_args       = (isset($parts[0])) ? $parts: [];
    }

    protected function parseUrl()
    {
        return $url = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
    }

    public function getController()
    {
        return ucfirst($this->_controller);
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getArguments()
    {
        return $this->_args;
    }
}
