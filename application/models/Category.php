<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model {

    public function find_all_if_active()
    {
        $this->db->trans_start();
        $category = $this->db->get_where('categories', array('is_active' => 1, 'is_deleted' => 0))->result();
        $this->db->trans_complete();
        return $category;
    }

}

/* End of file Category.php */
/* Location: ./application/models/Category.php */