<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_categories_table extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 5,
                 'unsigned' => true,
                 'auto_increment' => true
              ),
              'name' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '50'
              ),
              'is_active' => array(
                 'type' => 'BOOLEAN',
                 'default' => true
              ),
              'is_deleted' => array(
                 'type' => 'BOOLEAN',
                 'default' => false
              ),
              'created_by' => array(
                 'type' => 'INT',
                 'constraint' => 5,
                 'unsigned' => true
              ),
            )
        );

        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('categories', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('categories');
    }

}

/* End of file 20170712004328_add_categories_table.php */
/* Location: ./application/migrations/20170712004328_add_categories_table.php */