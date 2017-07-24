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

    public function create_category_dropdown_with_placeholder()
    {
        $this->db->trans_start();
        $categories = $this->db->get_where('categories', array('is_active' => 1, 'is_deleted' => 0))->result();
        $this->db->trans_complete();
        $result = [];
        $result[''] = '';
        foreach ($categories as $category) {
            $result[$category->id] = $category->name;
        }
        return $result;
    }

    public function update_by_id($id, $updateData)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $updateData);
    }

}

/* End of file Category.php */
/* Location: ./application/models/Category.php */