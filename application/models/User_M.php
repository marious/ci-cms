<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_M extends MY_Model {

        protected $_table_name = 'users';
        protected $_order_by = 'name';
        public $rules = [
            'email' => [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
            ],
            'password' => [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required',
            ],
        ];

        public $admin_rules = [
        'name' => [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required',
            ],
            'email' => [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|callback__unique_email',
            ],
            'password' => [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim',
            ],
            'password_confirm' => [
                'field' => 'password_confirm',
                'label' => 'Confirm Password',
                'rules' => 'trim|matches[password]'
            ],
        ];



    public function login()
    {
        $okay = true;
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // lookup the user
        $user = $this->get_by(['email' => $email], true);

        if (count($user)) {
            if (!password_verify($password, $user->password)) {
                $okay = false;
            }
        } else {
            $okay = false;
        }

        if ($okay) {
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'loggedin' => true,
            ];

            $this->session->set_userdata($data);
        }

        return $okay;

    }


    public function logout()
    {
        $this->session->sess_destroy();
    }



    public function loggedin()
    {
        return (bool) $this->session->userdata('loggedin');
    }


    public function get_new()
    {
        $user = new stdClass();
        $user->name = '';
        $user->email = '';
        $user->password = '';
        return $user;
    }
}
