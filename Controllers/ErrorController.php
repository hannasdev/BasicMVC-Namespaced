<?php
/**
 * Error Controller
 */

namespace BasicMVC\Controllers;

use BasicMVC\Controllers\BaseController as BaseController;

class ErrorController extends BaseController
{
    public function index() {}

    public function error($message = 'Unknown error.')
    {
        echo '<pre>' . print_r($message, 1) . '</pre>';
    }
}
