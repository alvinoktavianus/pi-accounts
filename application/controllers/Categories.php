<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category');
    }

    public function index()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $data = array(
                'pageKey' => 'category',
                'title' => 'Categories | Pro Importir',
            );
            $this->load->view('main', $data);
        } else {
            redirect('home','refresh');
        }
    }

    public function get_all_categories()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $categories = $this->category->find_all_if_active();
            $this->output->set_content_type('application/json')->set_output(json_encode($categories, JSON_NUMERIC_CHECK));
        } else {
            $error = array(
                'code' => 403,
                'message' => 'Go, Away!'
            );
            $this->output->set_status_header(403)->set_content_type('application/json')->set_output(json_encode($error));
        }
    }

    public function new()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $this->db->trans_start();
            $obj = json_decode(file_get_contents('php://input'), TRUE);
            $data = array(
                'name' => $obj['name'],
                'created_by' => $this->session->userdata('user_session')['userId'],
                'updated_by' => $this->session->userdata('user_session')['userId']
            );
            $this->category->insert_new_data($data);
            $this->db->trans_complete();

            $categories = $this->category->find_all_if_active();
            $this->output->set_status_header(201)->set_content_type('application/json')->set_output(json_encode($categories, JSON_NUMERIC_CHECK));
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
            $data = array(
                'is_deleted' => 1,
                'updated_by' => $this->session->userdata('user_session')['userId']
            );
            $this->category->update_by_id($obj['category_id'], $data);
            $this->db->trans_complete();
            $categories = $this->category->find_all_if_active();
            $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($categories, JSON_NUMERIC_CHECK));
        } else {
            $error = array(
                'code' => 403,
                'message' => 'Go, Away!'
            );
            $this->output->set_status_header(403)->set_content_type('application/json')->set_output(json_encode($error));
        }
    }

}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */