<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_transactions extends CI_Migration {

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
                'invoice_no' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                    'unique' => true
                ),
                'status_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ),
                'shipping_fee' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ),
                'total' => array(
                    'type' => 'BIGINT',
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
        $this->dbforge->create_table('transactions', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('transactions');
    }

}

/* End of file 20170720215920_add_transactions.php */
/* Location: ./application/migrations/20170720215920_add_transactions.php */