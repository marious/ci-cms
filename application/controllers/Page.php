<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Page_M');
    }

    public function index()
    {
        // Fetch the page data
        $this->data['page'] = $this->Page_M->get_by(array('slug' => (string) $this->uri->segment(1)), true);

        count($this->data['page']) OR show_404(current_url());


        add_meta_title($this->data['page']->title);

        // Fetch the page data
        $method = '_' . $this->data['page']->template;
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            log_message('error', 'Could not load template ' . $method . ' in file ' . __FILE__ . ' at line ' . __LINE__);
            show_error('Could not load template', $method);
        }

        // Load view
        $this->data['subview'] = $this->data['page']->template;
        $this->load->view('site/_main_layout', $this->data);
    }



   private function _page()
   {

   }

   private function _homepage()
   {
        $this->Article_M->set_published();
        $this->data['articles'] = $this->Article_M->get_with_user('pubdate');
   }

   private function _posts_archive()
   {

        $this->data['recent_news'] = $this->Article_M->get_recent();

        // Count all articles
        $this->Article_M->set_published();
        $count = $this->db->count_all_results('articles');

        // set up pagination
        $perpage = 4;
        if ($count > $perpage) {

          $this->load->library('pagination');

          $config['base_url'] = site_url($this->uri->segment(1)) . '/';
          $config['total_rows'] = $count;
          $config['per_page'] = $perpage;
          $config['uri_segment'] = 2;

          $this->pagination->initialize($config);

          $this->data['pagination'] = $this->pagination->create_links();
          $offset = $this->uri->segment(2);

        } else {
            $this->data['pagination'] = '';
            $offset = 0;
        }


       // Fetch articles
       $this->Article_M->set_published();
       $this->data['articles'] = $this->Article_M->get_with_user('pubdate', 'desc', $perpage, $offset);
   }

}
