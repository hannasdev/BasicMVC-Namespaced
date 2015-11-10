<?php

use BasicMVC;

define('SITE_PATH', realpath(dirname(__FILE__)) . '/');

try {
    Router::route(new Request);
} catch (\Exception $e) {
    $controller = new ErrorController;
    $controller->error($e->getMessage());
}
