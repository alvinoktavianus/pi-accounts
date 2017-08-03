<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_detail extends CI_Model {

    public function insert_transaction_detail($data)
    {
        $this->db->insert('transaction_details', $data);
    }

    public function get_detail($transaction_id)
    {
        return $this->db->get_where('transaction_details', array('transaction_id' => $transaction_id))->result_array();
    }

    public function update_trans_details($updateData, $trans_id)
    {
        $this->db->where('transaction_id', $trans_id);
        $this->db->update('transaction_details', $updateData);
    }

}

/* End of file Transaction_detail.php */
/* Location: ./application/models/Transaction_detail.php */