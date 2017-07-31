<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Model {

    public function get_all_status()
    {
        return $this->db->get('status')->result();
    }

}

/* End of file Status.php */
/* Location: ./application/models/Status.php */