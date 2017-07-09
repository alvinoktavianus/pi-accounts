<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_password_to_users extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $fields = array(
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 60
            )
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'password');
    }

}

/* End of file 20170709225715_add_password_to_users.php */
/* Location: ./application/migrations/20170709225715_add_password_to_users.php */