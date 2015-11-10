<?php
/**
 *
 */

namespace BasicMVC\Controllers;

use BasicMVC\Controllers\BaseController as BaseController;

class TestController extends BaseController
{
    public function index()
    {
        //echo '<pre>' . print_r(__METHOD__, 1) . '</pre>';
    }

    public function peas()
    {
        echo '<pre>' . print_r(__METHOD__, 1) . '</pre>';
        echo '<pre>' . print_r(func_get_args(), 1) . '</pre>';
    }
}
