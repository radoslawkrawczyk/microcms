<?php

class admindb extends CI_Model
{

    public function checkIfInstalled()
    {
        $this->load->database();
        if (!$this->db->table_exists('user_admin') || !$this->db->table_exists('user_data') || !$this->db->table_exists('user_files')) {
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
        $pass = hash("sha256", $this->input->post('pass'));
        if (!$this->db->table_exists('user_admin')) {

            $query = ($this->db->query('CREATE TABLE "user_admin" ( `username` TEXT NOT NULL DEFAULT \'admin\', `password` TEXT )'));

        }
        if (!$this->db->table_exists('user_data')) {
            $this->db->query('CREATE TABLE "user_data" ( `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, `text` TEXT, `date` TEXT NOT NULL, `desc` TEXT )');
        }
        if (!$this->db->table_exists('user_files')) {
            $this->db->query('CREATE TABLE `user_files` (
                `id`	INTEGER PRIMARY KEY AUTOINCREMENT,
                `path`	TEXT NOT NULL UNIQUE,
                `date`	INTEGER NOT NULL,
                `filename`	TEXT NOT NULL,
                `filesize`	REAL
            );');
        }
        $this->db->from('user_admin');
        $query = $this->db->get();
        if (empty($query->result_array())) {
            $this->db->insert('user_admin', array('username' => $user, 'password' => $pass));
        }
        return true;
    }



    public function getUser($user, $pass)
    {
        $this->load->database();
        
        $pass = hash("sha256", $pass);
        $query = $this->db->query('SELECT * FROM user_admin WHERE `username` ="'.$user.'"');
        $this->load->library('session');
        $query = $query->result_array();

        if (empty($query[0]['password'])) {
             return false;
        }
        if ($query[0]['password'] != $pass) {
            return false;
        }

        if ($query[0]['password'] === $pass) {
            $this->session->set_userdata([
                'logged_in' => true,
                'user' => $user,
            ]);

            return true;
        }

        return false;
    }

    public function addText()
    {
        $this->load->database();
        $this->db->insert('user_data', array('text' => $this->input->post('content'), 'desc' => $this->input->post('desc'), 'date' => time()));
        return true;
    }

    public function checkPass($newpass)
    {
        $this->load->database();
        $query = $this->db->query('SELECT password FROM `user_admin`');
        $query = $query->result_array();
        $newpass = hash("sha256", $newpass);

        if ($query[0]['password'] !== $newpass) {
            return $query[0]['password'];
        }
        return false;

    }

    public function updateText($id, $desc, $content)
    {
        $this->load->database();
        $query = $this->db->query('UPDATE `user_data` SET text = "' . $content . '", desc = "' . $desc . '" WHERE id=' . $id);
        return $query;
    }

    public function deleteText($textId)
    {
        $this->load->database();
        $query = $this->db->query('DELETE FROM `user_data` WHERE id = ' . $textId);
        return $query;
    }

    public function addFile($path, $filename, $filesize)
    {
        $this->load->database();
        $query = $this->db->insert('user_files', [
            'path' => $path,
            'date' => time(),
            'filename' => $filename,
            'filesize' => $filesize
        ]);
        return true;
    }

    public function getFiles()
    {
        $this->load->database();
        $query = $this->db->query('SELECT * FROM user_files');
        $query = $query->result_array();

        return $query;
    }

    public function removeFile($id) {
        
        $this->load->database();
        $query = $this->db->query('DELETE FROM `user_files` WHERE `id` = '.$id);
        return true;
    }
}
