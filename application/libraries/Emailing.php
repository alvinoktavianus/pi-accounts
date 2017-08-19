<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailing
{
    private $ci;
    private $config;

    public function __construct()
    {
        $this->ci =& get_instance();
        
        // initialize email configuration
        $this->config = array(
            'protocol' => 'smtp',
            'smtp_host' => $_SERVER['SMTP_HOST'],
            'smtp_user' => $_SERVER['SMTP_USER'],
            'smtp_pass' => $_SERVER['SMTP_PASS'],
            'mailtype' => 'html',
            'smtp_port' => $_SERVER['SMTP_PORT'],
        );

        $this->ci->load->library('email', $this->config);
    }

    public function send_email($emailTo, $subject, $msg)
    {   
        $this->ci->email->from($_SERVER['EMAIL_FROM'], $_SERVER['EMAIL_ALIAS']);
        $this->ci->email->to($emailTo);
        
        $this->ci->email->subject($subject);
        $this->ci->email->message($msg);
        
        $this->ci->email->send();

        // TODO: create log table to log all outgoing email
    }    

}

/* End of file Emailing.php */
/* Location: ./application/libraries/Emailing.php */
