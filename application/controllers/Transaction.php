<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $s = substr(str_shuffle(str_repeat("04BGHCFSQ1UAEVYDNR5OILPZ673928WTJKXM", 3)), 0, 3);
            $varnota = strtoupper(date('ymNBs')) . $s;
            $data = array(
                'pageKey' => 'transaction',
                'title' => 'Transaction | Pro Importir',
                'viewData' => array(
                    'varnota' => 'INVC/'.$varnota,
                )
            );
            $this->load->view('main', $data);
        } else {
            redirect('home','refresh');
        }
	}

}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */