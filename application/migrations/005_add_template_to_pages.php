<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_template_to_pages extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $fields =   (array(
                        'template' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),


                ));
                $this->dbforge->add_column('pages', $fields) ;
    }

    public function down() {
        $this->dbforge->drop_column('pages', 'template');
    }

}

/* End of file 005_add_template_to_pages.php */
/* Location: ./application/migrations/005_add_template_to_pages.php */