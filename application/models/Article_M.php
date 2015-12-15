<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_M extends MY_Model {

    protected $_table_name = 'articles';
    protected $_order_by = 'pubdate';
    protected $_timestamps = true;

    public $rules = [
        'pubdate' => [
            'field' => 'pubdate',
            'label' => 'Publication date',
            'rules' => 'trim|required|exact_length[10]|date'
        ],
        'title' => [
            'field' => 'title',
            'label' => 'Tilte',
            'rules' => 'trim|required|max_length[100]'
        ],
        'slug' => [
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required|max_length[100]|url_title'
        ],
         'body' => [
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|required'
        ],
    ];

 //==========================================================================================================

    public function get_with_user($order_by = null, $sort = 'DESC', $limit = null, $offset = 0)
    {
        $this->db->select('articles.*, users.name');
        // $this->db->from('articles');
        $this->db->join('users', 'articles.user_id = users.id', 'left');
        $this->set_published();

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }

        if ($order_by != null) {
            $this->db->order_by($order_by, $sort);
        }
        // $q = $this->db->get();
        // return $q->result();
        return parent::get();
    }


    /**
     * get single article joined with users table
     * @param  intger $id article id
     * @return stdClass object of propertie
     */
    public function get_single_article($id)
    {
        $this->db->select('articles.*, users.name');
        $this->db->join('users', 'articles.user_id = users.id', 'left');
        $this->set_published();
        $this->db->where('articles.id', $id);

        return $this->Article_M->get(null, true);
    }

    public function set_published()
    {
        $this->db->where('pubdate <=', date('Y-m-d'));
    }

    public function get_recent($limit = 3)
    {
        $limit = (int) $limit;
        $this->set_published();
        $this->db->limit($limit);
        $this->db->order_by($this->_order_by, 'desc');
        return parent::get();
    }

 //==========================================================================================================

    public function get_new()
    {
        $article = new stdClass();
        $article->title = '';
        $article->slug = '';
        $article->pubdate = date('Y-m-d');
        $article->body = '';
        $article->image = '';

        return $article;
    }
	
	//===============================================================================================================
	
	public function get_searched($keywords, $order_by = NULL, $sort = 'DESC', $limit = NULL, $offset = 0)
	{
		$this->db->select('a.*, u.name');
			$this->db->from('articles as a');
			$this->db->join('users as u', 'a.user_id = u.id', 'left');
			$this->db->like('title', $keywords);
			$this->db->or_like('body', $keywords);

			if ($order_by != NULL) {
					$this->db->order_by($order_by, $sort);
			}

			if ($limit != NULL) {
					$this->db->limit($limit, $offset);
			}

			$query = $this->db->get();
			return $query->result();
	}
}
