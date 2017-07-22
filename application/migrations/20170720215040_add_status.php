<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_status extends CI_Migration {

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
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                ),
                'description' => array(
                    'type' => 'TEXT'
                )
            )
        );
        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('status', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('status');
    }

}

/* End of file 20170720215040_add_status.php */
/* Location: ./application/migrations/20170720215040_add_status.php */