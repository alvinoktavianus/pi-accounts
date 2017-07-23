<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionDetail extends CI_Model {

    public function insert_transaction_detail($data)
    {
        $this->db->insert('transaction_details', $data);
    }

}

/* End of file TransactionDetail.php */
/* Location: ./application/models/TransactionDetail.php */