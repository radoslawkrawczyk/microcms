<?php

class admindb extends CI_Model
{

    public function checkIfInstalled()
    {
        $this->load->database();
        $this->db->from('user_admin');
        $query = $this->db->get();
        if (empty($query->result_array())) {
            return false;
        } else {
            return true;
        }
    }

    public function install()
    {
        $this->load->database();
        $user = $this->input->post('username');
        $pass = hash("sha256", $this->input->post('password'));
        $this->db->from('user_admin');
        $query = $this->db->get();
        if (empty($query->result_array())) {
            $this->db->insert('user_admin', array('username' => $user, 'password' => $pass));
        }
        return true;
    }

    public function getUser()
    {
        $this->load->database();
        $user = $this->input->post('username');
        $pass = hash("sha256", $this->input->post('password'));

        $query = $this->db->query('SELECT * FROM user_admin WHERE `username` ="'.$user.'" AND `password`='.'"'.$pass.'"');
        $this->load->library('session');
   
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $this->session->set_userdata([
                    'logged_in' => true,
                    'user' => $user
                ]);

                return true;
        }
    }

    public function addText()
    {
        $this->load->database();
        $this->db->insert('user_data', array('text' => $this->input->post('content'), 'desc' => $this->input->post('desc'), 'date'=>time()));
        return true;
    }


}
