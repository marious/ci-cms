<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {

   public function __construct()
   {
       parent::__construct();
       $this->data['status'] = 'admin';
       $this->data['meta_title'] = 'Alpha CMS';

       $this->load->library('form_validation');
       $this->load->model('User_M');

       // Login check
       $exception_uris = [
                        'admin/user/login',
                        'admin/user/logout',
                    ];

        if (in_array(uri_string(), $exception_uris) == false) {
            if ($this->User_M->loggedin() == false) {
                 redirect('admin/user/login');
            }
        }
   }

}

