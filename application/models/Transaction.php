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

    public function get_all_active_transaction($adminId)
    {
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where('is_deleted', 0);
        $this->db->where('created_by', $adminId);
        return $this->db->get()->result_array();
    }

    public function update_transaction($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('transactions', $data);
    }

    public function get_all_user_transaction($userId)
    {
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where('is_deleted', 0);
        $this->db->where('user_id', $userId);
        return $this->db->get()->result_array();
    }

    public function find_by_invoice_no($invoiceNo)
    {
        $this->db->where('invoice_no', $invoiceNo);
        return $this->db->get('transactions')->result_array()[0];
    }

}

/* End of file Transaction.php */
/* Location: ./application/models/Transaction.php */