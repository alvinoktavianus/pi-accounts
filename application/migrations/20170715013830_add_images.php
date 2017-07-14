<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_images extends CI_Migration {

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
                'file_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200'
                ),
                'gallery_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                ),
                'is_primary' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
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
                    'unsigned' => true,
                ),
                'updated_by' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                )
            )
        );
        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('images', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('images');
    }

}

/* End of file 20170715013830_add_images.php */
/* Location: ./application/migrations/20170715013830_add_images.php */