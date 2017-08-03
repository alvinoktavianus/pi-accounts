<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_address_to_users extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $fields = array(
            'address' => array(
                'type' => 'TEXT'
            )
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'address');
    }

}

/* End of file 20170718232210_add_address_to_users.php */
/* Location: ./application/migrations/20170718232210_add_address_to_users.php */