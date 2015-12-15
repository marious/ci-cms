<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_M');
    }


    public function index()
    {
        // Fetch all articles
        $this->data['articles'] = $this->Article_M->get();

        // Load view
        $this->data['subview'] = 'admin/article/index';
        $this->load->view('admin/_layout_main', $this->data);
    }


    public function edit($id = null)
    {
        // Fetch a article or set new one
        if ($id) {
            $this->data['article'] = $this->Article_M->get($id);
            count($this->data['article']) OR $this->data['errors'] = 'article Could not be found';
        } else {
            $this->data['article'] = $this->Article_M->get_new();
        }

        // Set up the form
        $rules = $this->Article_M->rules;

        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == true) {
            $data = $this->Article_M->array_from_post(['title', 'slug', 'body', 'pubdate', 'image']);
            $data['user_id'] = $this->session->userdata('id');
            $this->Article_M->save($data, $id);
            $message = isset($id) ? 'article Updated Successfully' : 'article added Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('admin/article');
        }

        // get assets folder content
            $this->load->helper('file');
            $this->load->helper('directory');

            $this->data['files'] = directory_map(FCPATH . 'assets/img/');

        // Load the view
        $this->data['subview'] = 'admin/article/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }


    public function delete($id)
    {
        if ($id) {
            $this->Article_M->delete($id);
            $this->session->set_flashdata('success', 'article Deleted Successfully');
            redirect('admin/article');
        }
    }

}
