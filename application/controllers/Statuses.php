<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statuses extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('status');
    }

    public function all()
    {
        if ($this->session->userdata('user_session')) {
            $results = $this->status->get_all_status();
            $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($results, JSON_NUMERIC_CHECK));
        } else {
            $error = array(
                'code' => 403,
                'message' => 'Go, Away!'
            );
            $this->output->set_status_header(403)->set_content_type('application/json')->set_output(json_encode($error));
        }
    }

}

/* End of file Statuses.php */
/* Location: ./application/controllers/Statuses.php */