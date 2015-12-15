<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public  function index()
    {
        // Fetch all users
        $this->data['users'] = $this->User_M->get_by(['id != ' => $this->session->userdata('id')]);
        // Load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main', $this->data);
    }


    public function edit($id = null)
    {
        // Fetch a user or set new one
        if ($id) {
            $this->data['user'] = $this->User_M->get($id);
            count($this->data['user']) OR $this->data['errors'] = 'User Could not be found';
        } else {
            $this->data['user'] = $this->User_M->get_new();
        }

        // Set up the form
        $rules = $this->User_M->admin_rules;

        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == true) {
            $data = $this->User_M->array_from_post(['name', 'email', 'password']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->User_M->save($data, $id);
            $message = isset($id) ? 'User Updated Successfully' : 'User added Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('admin/user');
        }

        // Load the view
        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    /**
     * delete the user
     * @param  int $id primary user id
     * @return response
     */
    public function delete($id)
    {
        if ($id) {
            $this->User_M->delete($id);
            redirect('admin/user');
        }
    }


     public function login()
    {
        // Redirect a user if he's already is loggedin
        $dashboard = 'admin/dashboard';

        $this->User_M->loggedin() == false OR redirect($dashboard);  // if user is loggedin redirect it ot dashboard

        // Set form
        $rules = $this->User_M->rules;

        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == true) {
            // login the user and redirect
            if ($this->User_M->login() == true) {
                redirect($dashboard);
            } else {
                $this->session->set_flashdata('error', 'The email/password condition does not exist');
                redirect('admin/user/login');
            }
        }

        // Load the view
        $this->load->view('admin/user/login', $this->data);

    }


    /**
     * logout the user
     * @return response
     */
    public function logout()
    {
        $this->User_M->logout();
        redirect('admin/user/login');
    }



    public function _unique_email($str)
    {
        // Do Not validate if email already exists
        // Unless it's the email for the current user

        $id = $this->uri->segment(4);

        $this->db->where('email', $this->input->post('email'));

        !$id OR $this->db->where('id !=', $id);

        $user = $this->User_M->get();

        if (count($user)) {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return false;
        }

        return true;
    }

}
