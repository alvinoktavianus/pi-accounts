<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_detail extends CI_Model {

    public function insert_transaction_detail($data)
    {
        $this->db->insert('transaction_details', $data);
    }

}

/* End of file Transaction_detail.php */
/* Location: ./application/models/Transaction_detail.php */