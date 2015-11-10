<?php
/**
 * Load
 * Based on: https://www.youtube.com/watch?v=3QAZSo96_ow&list=PL8931096D81D44C4E&index=4
 */

namespace BasicMVC;

use BasicMVC\Registry as Registry;
use BasicMVC\Models\BaseModel as BaseModel;
use BasicMVC\Models\PostModel as PostModel;

class Load
{
    public function view($name, array $vars = null)
    {
        $file = SITE_PATH . 'views/' . $name . 'View.php';

        if ( is_readable($file) ) {
            if (isset($vars)) {
                extract($vars);
            }
            require($file);
            return true;
        }

        throw new \Exception('Cannot find view');
    }

    public function model($name)
    {
        $model = ucfirst($name) . 'Model';
        $modelPath = SITE_PATH . 'Models/' . $model . '.php';
        $modelName = '\BasicMVC\Models\\' . $model;

        if ( is_readable($modelPath) ) {
            require_once($modelPath);
            if (class_exists($modelName)) {
                $registry = Registry::getInstance();
                $registry->$name = new $modelName;
                return true;
            }
        }
        throw new \Exception('Model ' . $model . ' could not be loaded.');
    }
}
