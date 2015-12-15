<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('directory');
    }

    public function index()
    {
        $this->data['files'] = directory_map(FCPATH . 'assets/img/');

        $this->load->view('admin/_partials/header', $this->data);
        $this->load->view('admin/file/file', $this->data);
        $this->load->view('admin/_partials/footer');
    }


    public function upload()
    {
        $config['upload_path'] = FCPATH . 'assets/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']  = '2000';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
        }
        else{
            $data = array('upload_data' => $this->upload->data());
           // echo json_encode($this->upload->data());

        }

         // get assets folder content
            $this->load->helper('file');
            $this->load->helper('directory');

            $files = directory_map(FCPATH . 'assets/img/');

            echo json_encode($files);
    }

}
