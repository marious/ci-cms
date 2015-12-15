<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // index page for admin dashboard
    public  function index()
    {
        // Fetch recently modified articles
        $this->load->model('Article_M');
        $this->db->order_by('modified', 'desc');
        $this->db->limit(5);;
        $this->data['recent_articles'] = $this->Article_M->get();

        $this->data['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/_layout_main', $this->data);
    }
}
