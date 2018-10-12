<?php

class apidb extends CI_Model {
    public function getText($id) {
        $this->load->database();
        $query = $this->db->query('SELECT * FROM user_data WHERE `id` ="'.$id.'"');
  
        $query = $query->result();
        if (empty($id)) {
            $query = $this->db->query('SELECT * FROM user_data');
            $query = $query->result();
            return (array) $query;
        }
        if (!empty($query)) {
        return (array) $query[0];
        }
        else {
            return array([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }

    }
}