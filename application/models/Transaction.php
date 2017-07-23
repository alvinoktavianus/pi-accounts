<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Model {

    public function insert_new_transaction($data)
    {
        $this->db->insert('transactions', $data);
    }

    public function get_latest_transaction_id()
    {
        $this->db->order_by('created_at', 'desc');
        return $this->db->get('transactions', 1)->result()[0]->id;
    }

}

/* End of file Transaction.php */
/* Location: ./application/models/Transaction.php */