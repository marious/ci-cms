<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['recent_news'] = $this->Article_M->get_recent();
    }

    public function index($id, $slug)
    {
        // Fetch the article
        $this->data['article'] = $this->Article_M->get_single_article($id);

        // Retrun 404 if not found
        count($this->data['article']) OR show_404(uri_string());

        // Redirect if slug was incorrect
        $request_slug = $this->uri->segment(3);
        $set_slug = $this->data['article']->slug;
        if ($request_slug != $set_slug) {
            redirect('articles/' . $this->data['article']->id . '/' . $this->data['article']->slug, 'location', '301');
        }

        // Load view
        add_meta_title(e($this->data['article']->title));
        $this->data['subview'] = 'article';
        $this->load->view('site/_main_layout', $this->data);
    }
	
	public function search()
	{
		$searched = $this->input->post('search');
		$this->data['articles'] = $this->Article_M->get_searched($searched);
		$this->data['subview'] = 'searched';
		$this->load->view('site/_main_layout', $this->data);
	}
}
