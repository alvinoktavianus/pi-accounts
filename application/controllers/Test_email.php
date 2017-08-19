<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_email extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('emailing');
    }

    public function index()
    {
        $msg = $this->load->view('email_templates/verify_email', array('verifyEmailUrl' => base_url('Verify_email').'?verify_token=123456'), FALSE);
        $this->emailing->send_email('anthony9a2@gmail.com', 'Verify email', $msg);
        $msg = $this->load->view('email_templates/verify_email', array('verifyEmailUrl' => base_url('Verify_email').'?verify_token=123456'), FALSE);
        $this->emailing->send_email('agentsam1995@gmail.com', 'Verify email', $msg);
    }

}

/* End of file Test_email.php */
/* Location: ./application/controllers/Test_email.php */