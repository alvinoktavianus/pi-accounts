<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $data = array(
                'pageKey' => 'transaction',
                'title' => 'Transaction | Pro Importir'
            );
            $this->load->view('main', $data);
        } else {
            redirect('home','refresh');
        }
	}

}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */