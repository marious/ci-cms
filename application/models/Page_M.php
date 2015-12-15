<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_M extends MY_Model {

    protected $_table_name = 'pages';
    protected $_order_by = 'parent_id, order';
    public $rules = [
        'parent_id' => [
            'field' => 'parent_id',
            'label' => 'Parent Id',
            'rules' => 'trim|intval'
        ],
        'template' => [
            'field' => 'template',
            'label' => 'Template',
            'rules' => 'trim|required'
        ],
        'title' => [
            'field' => 'title',
            'label' => 'Tilte',
            'rules' => 'trim|required|max_length[100]'
        ],
        'slug' => [
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug'
        ],
         'body' => [
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|required'
        ],
    ];


 public function get_archive_link()
 {
    $page = parent::get_by(array('template' => 'news_archive'), true);
    return isset($page->slug) ? $page->slug : '';
 }

 //==========================================================================================================

    public function get_new()
    {
        $page = new stdClass();
        $page->title = '';
        $page->slug = '';
        $page->order = '';
        $page->parent_id = '';
        $page->body = '';
        $page->template = 'page';

        return $page;
    }

 //==========================================================================================================
    public function delete($id)
    {
        // Delete a page
        parent::delete($id);

        // Reset Parent ID for its children
        $this->db->set(array('parent_id' => 0))->where('parent_id', $id)->update($this->_table_name);
    }

 //==========================================================================================================

    public function get_nested()
    {
          $this->db->order_by($this->_order_by);
          $pages = $this->db->get('pages')->result_array();

          $array = array();
          foreach ($pages as $page) {
              if (!$page['parent_id']) {
                  // This page has not parent
                  $array[$page['id']] = $page;
              }
              else {
                  // This is child page
                  $array[$page['parent_id']]['children'][] = $page;
              }
          }

          return $array;
    }


    //==========================================================================================================

    public function get_with_parent($id = NULL, $single = false)
    {
        $this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
        $this->db->join('pages as p', 'pages.parent_id=p.id', 'left');
        return parent::get($id, $single);
    }

//==========================================================================================================
    public function save_order($pages)
    {
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                if ($page['item_id'] != '') {
                    $data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
                }
            }
        }
    }


 //==========================================================================================================
 //
    public function get_no_parents()
    {
        // fetch pages without parents
        $this->db->select('id, title');
        $this->db->where('parent_id', 0);
        $pages = Parent::get();

        // Return key => value pair array
        $array = array(0 => 'No Parent');

        if (count($pages)) {
            foreach($pages as $page) {
                $array[$page->id] = $page->title;
            }
        }

        return $array;
    }

}
