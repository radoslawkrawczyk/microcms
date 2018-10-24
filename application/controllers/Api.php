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

        http_response_code(200);
        echo json_encode($this->apidb->getText($id));

    }

    public function file()
    {
        $this->load->model('apidb');
        $this->load->helper('download');

        $id = $this->uri->segment(3);

        $file = $this->apidb->getFile($id);
        if (!empty($file->path))
            force_download($file->path.$file->filename, NULL, TRUE);
        else
            print_r($file);
    }
}
