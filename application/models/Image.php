<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Model {

    public function insert_new_image($data)
    {
        $this->db->insert('images', $data);
    }

}

/* End of file Image.php */
/* Location: ./application/models/Image.php */