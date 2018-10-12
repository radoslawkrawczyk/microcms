<?php

class Api extends CI_Controller
{
    public function test()
    {
        $arr = [
            'status' => 200,
            'message' => 'Webservice works!',
        ];

        $arr = json_encode($arr);

        echo $arr;
    }

    public function text()
    {
        $this->load->model('apidb');
        $id =  $this->uri->segment(3);

        echo json_encode($this->apidb->getText($id));
    }
}
