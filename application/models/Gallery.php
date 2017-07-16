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

}

/* End of file Gallery.php */
/* Location: ./application/models/Gallery.php */