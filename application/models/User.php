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

    public function find_by_id($id)
    {
        $this->db->trans_start();
        $user = $this->db->get_where('users', array('id' => $id))->result();
        $this->db->trans_complete();
        return $user;
    }

    public function insert_new_user($data)
    {
        $this->db->insert('users', $data);
    }

    public function insert_new_alamat($data, $id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        $this->db->trans_complete();
    }

    public function get_all_users()
    {
        $this->db->trans_start();
        $user = $this->db->get_where('users', array('role' => 'user'))->result();
        $this->db->trans_complete();
        return $user;
    }

    public function get_all()
    {
        $this->db->not_like('role', 'su');
        return $this->db->get('users')->result();
    }

}

/* End of file User.php */
/* Location: ./application/models/User.php */