<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    public function find_by_email($email)
    {
        $this->db->trans_start();
        $user = $this->db->get_where('users', array('email' => $email))->result();
        $this->db->trans_complete();
        return $user;
    }

}

/* End of file User.php */
/* Location: ./application/models/User.php */