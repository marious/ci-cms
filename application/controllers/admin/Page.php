<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Page_M');
    }


    public function index()
    {
        // Fetch all pages
        $this->data['pages'] = $this->Page_M->get_with_parent();

        // Load view
        $this->data['subview'] = 'admin/page/index';
        $this->load->view('admin/_layout_main', $this->data);
    }


    public function order()
    {
        $this->data['sortable'] = true;

        // Load view
        $this->data['subview'] = 'admin/page/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->Page_M->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['pages'] = $this->Page_M->get_nested();

        // load view
        $this->load->view('admin/page/order_ajax', $this->data);
    }


    public function edit($id = null)
    {
        // Fetch a page or set new one
        if ($id) {
            $this->data['page'] = $this->Page_M->get($id);
            count($this->data['page']) OR $this->data['errors'] = 'page Could not be found';
        } else {
            $this->data['page'] = $this->Page_M->get_new();
        }

        // Pages for dropdown
        $this->data['pages_no_parents'] = $this->Page_M->get_no_parents();

        // Set up the form
        $rules = $this->Page_M->rules;

        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == true) {
            $data = $this->Page_M->array_from_post(['title', 'slug', 'body', 'parent_id', 'template']);
            $this->Page_M->save($data, $id);
            $message = isset($id) ? 'page Updated Successfully' : 'page added Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('admin/page');
        }

        // Load the view
        $this->data['subview'] = 'admin/page/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }


    public function delete($id)
    {
        if ($id) {
            $this->Page_M->delete($id);
            $this->session->set_flashdata('success', 'Page Deleted Successfully');
            redirect('admin/page');
        }
    }

    public function _unique_slug($str)
    {
        // Do Not validate if slug already exists
        // Unless it's slug for the current page
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        $page = $this->Page_M->get();

        if (count($page)) {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return false;
        }

        return true;
    }
}
