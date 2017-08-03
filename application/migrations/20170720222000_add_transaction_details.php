<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_transaction_details extends CI_Migration {

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
                'transaction_id' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'unsigned' => true,
                ),
                'item_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'price' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ),
                'quantity' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ),
                'is_deleted' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_by' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ),
                'updated_by' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                )
            )
        );
        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('transaction_details', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('transaction_details');
    }

}

/* End of file 20170720222000_add_transaction_details.php */
/* Location: ./application/migrations/20170720222000_add_transaction_details.php */