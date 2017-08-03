<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction');
        $this->load->model('transaction_detail');
    }

	public function index()
	{
        if ($this->session->userdata('user_session')) {
            $data = array(
                'pageKey' => 'transaction',
                'title' => 'Transaction | Pro Importir',
                'viewData' => array(),
            );
            switch ($this->session->userdata('user_session')['role']) {
                case 'admin':
                    break;
                case 'user':
                    if (!empty($this->input->get('invoice_no'))) {
                        $result = $this->transaction->find_by_invoice_no($this->input->get('invoice_no'));
                        $result['details'] = $this->transaction_detail->get_detail($result['id']);
                        $data['viewData'] = array(
                            'transaction' => $result,
                        );
                    }
                    break;
            }
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
                $this->transaction_detail->insert_transaction_detail($transDetail);
            }
            $this->db->trans_complete();
            $this->output->set_status_header(201);
        } else {
            redirect('home','refresh');
        }
    }

    public function all()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $results = $this->transaction->get_all_active_transaction($this->session->userdata('user_session')['userId']);
            foreach ($results as $index => $trans) {
                $detail = $this->transaction_detail->get_detail($trans['id']);
                $results[$index]['details'] = $detail;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($results, JSON_NUMERIC_CHECK));
        } else if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'user') {
            $results = $this->transaction->get_all_user_transaction($this->session->userdata('user_session')['userId']);
            foreach ($results as $index => $trans) {
                $detail = $this->transaction_detail->get_detail($trans['id']);
                $results[$index]['details'] = $detail;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($results, JSON_NUMERIC_CHECK));
        } else {
            $error = array(
                'code' => 403,
                'message' => 'Go, Away!'
            );
            $this->output->set_status_header(403)->set_content_type('application/json')->set_output(json_encode($error));
        }
    }

    public function delete()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $this->db->trans_start();
            $obj = json_decode(file_get_contents('php://input'), TRUE);
            $updatedData = array(
                'is_deleted' => 1,
                'updated_by' => $this->session->userdata('user_session')['userId']
            );
            $this->transaction->update_transaction($updatedData, $obj['transaction_id']);
            $this->transaction_detail->update_trans_details($updatedData, $obj['transaction_id']);
            $this->db->trans_complete();

            // after updating data, fetch data back
            $results = $this->transaction->get_all_active_transaction($this->session->userdata('user_session')['userId']);
            foreach ($results as $index => $trans) {
                $detail = $this->transaction_detail->get_detail($trans['id']);
                $results[$index]['details'] = $detail;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($results, JSON_NUMERIC_CHECK));
        } else {
            $error = array(
                'code' => 403,
                'message' => 'Go, Away!'
            );
            $this->output->set_status_header(403)->set_content_type('application/json')->set_output(json_encode($error));
        }
    }

    public function update()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $this->db->trans_start();
            $obj = json_decode(file_get_contents('php://input'), TRUE);
            $updatedData = array(
                'status_id' => $obj['status_id'],
                'updated_by' => $this->session->userdata('user_session')['userId']
            );
            $this->transaction->update_transaction($updatedData, $obj['transaction_id']);
            $this->db->trans_complete();

            // after updating data, fetch data back
            $results = $this->transaction->get_all_active_transaction($this->session->userdata('user_session')['userId']);
            foreach ($results as $index => $trans) {
                $detail = $this->transaction_detail->get_detail($trans['id']);
                $results[$index]['details'] = $detail;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($results, JSON_NUMERIC_CHECK));
        } else {
            $error = array(
                'code' => 403,
                'message' => 'Go, Away!'
            );
            $this->output->set_status_header(403)->set_content_type('application/json')->set_output(json_encode($error));
        }
    }

}

/* End of file Transactions.php */
/* Location: ./application/controllers/Transactions.php */