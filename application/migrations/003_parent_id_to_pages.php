<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Parent_id_to_pages extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $fields = (array(
                   'parent_id' => array(
                            'type' => 'INT',
                            'constraint' => 11,
                            'unsigned' => true,
                            'default' => 0,
                        )
                   ));
        $this->dbforge->add_column('pages', $fields);
    }

    public function down() {
         $this->dbforge->drop_column('pages', 'parent_id');
    }
}
