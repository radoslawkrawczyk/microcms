<?php

class apidb extends CI_Model
{
    public function getText($id)
    {
        $this->load->database();
        $query = $this->db->query('SELECT * FROM user_data WHERE `id` ="' . $id . '"');

        $query = $query->result();
        if (empty($id)) {
            $query = $this->db->query('SELECT * FROM user_data');
            $query = $query->result();
            return (array) $query;
        }
        if (!empty($query)) {
            return (array) $query[0];
        } else {
            return array(
                'status' => 404,
                'message' => 'Not found',
            );
        }

    }

    public function getFile($id)
    {
        $this->load->database();
        if (empty($id)) {
            return new stdClass();
        }
        $query = $this->db->query('SELECT `path`, `filename` FROM `user_files` WHERE `id` = "'.$id.'"');
        $query = $query->result();

        if (!empty($query[0])) {
            return $query[0];
        }
        return [];
    }

}
