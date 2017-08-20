<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_verify_email_to_users extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $fields = array(
            'verify_token' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'is_confirmed' => array(
                'type' => 'BOOLEAN',
                'default' => false
            ),
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'verify_token');
        $this->dbforge->drop_column('users', 'is_confirmed');
    }

}

/* End of file 20170820123030_add_verify_email_to_users.php */
/* Location: ./application/migrations/20170820123030_add_verify_email_to_users.php */