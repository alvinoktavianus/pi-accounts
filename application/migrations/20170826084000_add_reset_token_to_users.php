<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_reset_token_to_users extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $fields = array(
            'reset_token' => array(
                'type' => 'VARCHAR',
                'constraint' => 25
            ),
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'reset_token');
    }

}

/* End of file 20170826084000_add_reset_token_to_users.php */
/* Location: ./application/migrations/20170826084000_add_reset_token_to_users.php */