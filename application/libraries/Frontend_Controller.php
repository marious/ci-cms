<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // load stuff
        $this->load->model('Page_M');
        $this->load->model('Article_M');


        // Fetch navigation
        $this->data['menu'] = $this->Page_M->get_nested();
        $this->data['posts_archive_link'] = $this->Page_M->get_archive_link();
        $this->data['meta_title'] = config_item('site_name');
    }
}
