<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_articles extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

     public function up()
    {
        $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'slug' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'body' => array(
                                'type' => 'TEXT',
                        ),
                        'pubdate' => array(
                                'type' => 'INT',
                                'constraint' => '11',
                        ),
                        'created' => array(
                                 'type' => 'DATETIME',
                        ),
                        'modified' => array(
                                 'type' => 'DATETIME',
                        ),

                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('articles') ;
    }

    public function down()
    {
         $this->dbforge->drop_table('articles');
    }
}

/* End of file 004_create_articles.php */
/* Location: ./application/migrations/004_create_articles.php */