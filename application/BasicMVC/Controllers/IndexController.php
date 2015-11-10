<?php
/*
 * Default index controller
 */
namespace BasicMVC\Controllers;

use BasicMVC\Controllers\BaseController as BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('posts');

        $vars['title'] = 'Dynamic Title';
        $vars['posts'] = $this->posts->getEntries();

        $this->load->view('index', $vars);
    }


}
