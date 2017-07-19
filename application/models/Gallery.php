<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Model {

    public function insert_new_gallery($data)
    {
        $this->db->insert('galleries', $data);
    }

    public function get_latest_galleries()
    {
        $this->db->order_by('created_at', 'desc');
        return $this->db->get('galleries', 1)->result()[0];
    }

    public function get_all_active_galleries()
    {
        $base_url = $this->input->server('HOST_URL').'uploads/galleries/';
        $this->db->select("galleries.id, galleries.name as gallery_name, FORMAT(galleries.base_price, 0,'de_DE') as base_price, FORMAT(galleries.sell_price, 0,'de_DE') as sell_price, categories.name as category_name, CONCAT('".$base_url."', images.file_name) as file_url");
        $this->db->from('galleries');
        $this->db->join('images', 'images.gallery_id = galleries.id', 'inner');
        $this->db->join('categories', 'categories.id = galleries.category_id', 'inner');
        $this->db->where('galleries.is_active', 1);
        $this->db->where('galleries.is_deleted', 0);
        return $this->db->get()->result();
    }

    public function get_all_active_galleris_with_limit()
    {
        $base_url = $this->input->server('HOST_URL').'uploads/galleries/';
        $this->db->select("galleries.id, galleries.name as gallery_name, FORMAT(galleries.base_price, 0,'de_DE') as base_price, FORMAT(galleries.sell_price, 0,'de_DE') as sell_price, categories.name as category_name, CONCAT('".$base_url."', images.file_name) as file_url");
        $this->db->from('galleries');
        $this->db->join('images', 'images.gallery_id = galleries.id', 'inner');
        $this->db->join('categories', 'categories.id = galleries.category_id', 'inner');
        $this->db->where('galleries.is_active', 1);
        $this->db->where('galleries.is_deleted', 0);
        $this->db->order_by('galleries.created_at', 'asc');
        $this->db->limit(4);
        return $this->db->get()->result();
    }

    public function get_all_active_galleries_where($condition)
    {
        $base_url = $this->input->server('HOST_URL').'uploads/galleries/';
        $this->db->select("galleries.id, galleries.name as gallery_name, FORMAT(galleries.base_price, 0,'de_DE') as base_price, FORMAT(galleries.sell_price, 0,'de_DE') as sell_price, categories.name as category_name, CONCAT('".$base_url."', images.file_name) as file_url");
        $this->db->from('galleries');
        $this->db->join('images', 'images.gallery_id = galleries.id', 'inner');
        $this->db->join('categories', 'categories.id = galleries.category_id', 'inner');
        $this->db->where('galleries.is_active', 1);
        $this->db->where('galleries.is_deleted', 0);
        $this->db->where('categories.id', $condition);
        return $this->db->get()->result();
    }

}

/* End of file Gallery.php */
/* Location: ./application/models/Gallery.php */