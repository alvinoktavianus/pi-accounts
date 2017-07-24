<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_updated_by_to_categories extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $fields = array(
            'updated_by' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
        );
        $this->dbforge->add_column('categories', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('categories', 'updated_by');
    }

}

/* End of file 20170725_add_updated_by_to_categories.php */
/* Location: ./application/migrations/20170725_add_updated_by_to_categories.php */