<?php

class admindb extends CI_Model
{

    public function checkIfInstalled()
    {
        $this->load->database();
        if (!$this->db->table_exists('user_admin') || !$this->db->table_exists('user_data') || !$this->db->table_exists('user_menu')) {
            return false;
        }
        $this->db->from('user_admin');
        $query = $this->db->get();
        if (empty($query->result_array())) {
            return false;
        }
        return true; 
    }

    public function install()
    {
        $this->load->database();
        $user = $this->input->post('username');
        $pass = hash("sha256", $this->input->post('password'));
        if (!$this->db->table_exists('user_admin')) {
           
           $query = ($this->db->query('CREATE TABLE "user_admin" ( `username` TEXT NOT NULL DEFAULT \'admin\', `password` TEXT )'));

        }
        if (!$this->db->table_exists('user_data')) {
            $this->db->query('CREATE TABLE "user_data" ( `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, `text` TEXT, `date` TEXT NOT NULL, `desc` TEXT )');
        }
        if (!$this->db->table_exists('user_menu')) {
            $this->db->query('CREATE TABLE `user_menu` ( `user_menu_id` INTEGER PRIMARY KEY AUTOINCREMENT, `link-name` TEXT NOT NULL, `link-short` INTEGER NOT NULL )');
        }
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

    public function updateText($id, $desc, $content)
    {
        $this->load->database();
        $query = $this->db->query('UPDATE `user_data` SET text = "'.$content.'", desc = "'.$desc.'" WHERE id='.$id);
        return $query;
    }

    public function deleteText($textId) {
        $this->load->database();
        $query = $this->db->query('DELETE FROM `user_data` WHERE id = '.$textId);
        return $query;
    }
}
