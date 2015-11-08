<?php
/**
 * BaseModel
 * Basic Model from which all other Models extends
 */

namespace BasicMVC\Models;

use BasicMVC\Database as Database;

abstract class BaseModel {
    protected $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }
}
