<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailing
{
    protected $config;

    public function __construct()
    {
        // initialize email configuration
        $this->config = array(
            'protocol' => 'smtp',
            'smtp_host' => $this->input->server('SMTP_HOST'),
            'smtp_user' => $this->input->server('SMTP_USER'),
            'smtp_pass' => $this->input->server('SMTP_PASS'),
            'mailtype' => 'html',
            'smtp_port' => $this->input->server('SetEnv SMTP_PORT'),
        );

        $this->load->library('email', $config);
    }

    public function send_email($emailTo, $subject, $msg)
    {   
        $this->email->from($this->input->server('EMAIL_FROM'), $this->input->server('EMAIL_ALIAS'));
        $this->email->to($emailTo);
        
        $this->email->subject($subject);
        $this->email->message($msg);
        
        $this->email->send();

        // TODO: create log table to log all outgoing email
    }    

}

/* End of file Emailing.php */
/* Location: ./application/libraries/Emailing.php */
