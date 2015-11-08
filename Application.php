<?php
/**
 *
 */

namespace BasicMVC;

use BasicMVC\Router as Router;
use BasicMVC\Request as Request;
use BasicMVC\Controllers\ErrorController as ErrorController;

class Application
{
    function __construct()
    {
        define('SITE_PATH', realpath(dirname(__FILE__)) . '/');

        try {
            Router::route(new Request);
        } catch (\Exception $e) {
            $controller = new ErrorController;
            $controller->error($e->getMessage());
        }
    }
}
