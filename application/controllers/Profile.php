<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

	public function index()
	{
		if ($this->session->userdata('user_session')) {
            $users = $this->user->find_by_id($this->session->userdata('user_session')['userId']);
            $viewData = array(
                'users' => $users
            );
            $data = array(
                'pageKey' => 'profile',
                'title' => 'Profile | Pro Importir',
                'viewData' => $viewData
            );
            $this->load->view('main', $data);
        } else {
            redirect('home','refresh');
        }
	}

    public function add_address()
    {
        if ($this->session->userdata('user_session')) {
            $this->form_validation->set_rules('alamat', 'Address', 'required|min_length[5]');
            if (!$this->form_validation->run()) {
                $errors = validation_errors();
                $this->session->set_flashdata('errors', $errors);
                redirect('profile','refresh');
            } else {
                $alamat = $this->input->post('alamat');
                $data = array(
                    'address' => $alamat
                );
                $this->user->insert_new_alamat($data, $this->session->userdata('user_session')['userId']);
                $this->session->set_flashdata('success', "Successfully insert new address");
                redirect('profile','refresh');
            }
        } else {
            redirect('home','refresh');
        }
    }
}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */