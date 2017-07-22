<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction');
        $this->load->model('transactiondetail');
    }

	public function index()
	{
		if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $data = array(
                'pageKey' => 'transaction',
                'title' => 'Transaction | Pro Importir',
                'viewData' => array(),
            );
            $this->load->view('main', $data);
        } else {
            redirect('home','refresh');
        }
	}

    public function insert_new_transaction()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $json = file_get_contents('php://input');
            $obj = json_decode($json, TRUE);
            $this->db->trans_start();
            $s = substr(str_shuffle(str_repeat("04BGHCFSQ1UAEVYDNR5OILPZ673928WTJKXM", 3)), 0, 3);
            $varnota = 'INVC/'.strtoupper(date('ymNBs')) . $s;
            $transHeader = array(
                'invoice_no' => $varnota,
                'user_id' => (int)$obj['user_id'],
                'shipping_fee' => $obj['shipping_fee'],
                'total' => $obj['total'],
                'created_by' => $this->session->userdata('user_session')['userId'],
                'updated_by' => $this->session->userdata('user_session')['userId'],
            );
            $this->transaction->insert_new_transaction($transHeader);
            $id = $this->transaction->get_latest_transaction_id();
            foreach ($obj['items'] as $item) {
                $transDetail = array(
                    'transaction_id' => $id,
                    'item_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['qty'],
                    'created_by' => $this->session->userdata('user_session')['userId'],
                    'updated_by' => $this->session->userdata('user_session')['userId'],
                );
                $this->transactiondetail->insert_transaction_detail($transDetail);
            }
            $this->db->trans_complete();
            $this->output->set_status_header(201);
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Transactions.php */
/* Location: ./application/controllers/Transactions.php */