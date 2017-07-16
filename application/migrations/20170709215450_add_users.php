<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

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
              'email' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '50',
                 'unique' => true
              ),
              'first_name' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '50',
              ),
              'last_name' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '50',
              ),
              'role' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '5',
              )
            )
        );

        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('users');
    }

}

/* End of file 20170709215450_add_users.php */
/* Location: ./application/migrations/20170709215450_add_users.php */