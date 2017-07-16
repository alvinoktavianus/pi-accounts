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

    public function insert_new_data($data)
    {
        $this->db->trans_start();
        $this->db->insert('categories', $data);
        $this->db->trans_complete();
    }

    public function create_category_dropdown()
    {
        $this->db->trans_start();
        $categories = $this->db->get_where('categories', array('is_active' => 1, 'is_deleted' => 0))->result();
        $this->db->trans_complete();
        $result = [];
        foreach ($categories as $category) {
            $result[$category->id] = $category->name;
        }
        return $result;
    }

}

/* End of file Category.php */
/* Location: ./application/models/Category.php */