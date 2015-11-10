<?php
/**
 * An example of what a Model could look like
 */

namespace BasicMVC\Models;

class PostsModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();    
    }

    public function index()
    {
        return true;
    }

    public function getEntries()
    {
        $return = [];
        $return[0] = ['title' => 'Hello world'];
        $return[1] = ['title' => 'Hello universe'];
        return $return;
    }
}
