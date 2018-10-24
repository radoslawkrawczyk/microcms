<?php

class Admin extends CI_Controller
{
    public function adminCtrl()
    {
        $this->load->model('admindb');
        $this->load->helper('url');

        if ($this->admindb->checkIfInstalled()) {
            $this->load->library('session');
            if ($this->session->logged_in) {

                redirect('/admin/dashboard');
            } else {
                redirect('/admin/login');
            }

        } else {
            $this->load->view('installation/install');

        }

    }

    public function install()
    {
        $this->load->helper('url');

        $this->load->model('admindb');
        if ($this->admindb->install()) {
            redirect('/admin/login');
        }
    }

    public function login()
    {
        $this->load->library('session');
        if ($this->session->logged_in) {
            $this->load->helper('url');
            redirect('admin/dashboard');
        }
        $this->load->view('admin/login');

    }

    public function logged()
    {
        $user = $this->input->post('username');
        $pass = hash("sha256", $this->input->post('password'));

        $this->load->helper('url');
        $this->load->model('admindb');
        $user = $this->input->post('username');
        $pass = $this->input->post('pass');

        if ($this->admindb->getUser($user, $pass)) {
            $this->load->library('session');
            if ($this->session->logged_in) {

                redirect('/admin/dashboard');
            }

        } else {
            redirect('/admin/login');
        }

    }

    public function dashboard()
    {

        $this->load->library('session');

        if ($this->session->logged_in === true) {
            $data = ['user' => $this->session->user];
            $this->load->view('admin/dashboard', $data);
        } else {
            $this->load->helper('url');
            redirect('/admin/login');
        }
    }

    public function password()
    {
        $this->load->model('admindb');
        $currentPassword = $this->input->post('currentPassword');
        $newPassword = $this->input->post('newPassword');

        echo hash("sha256", 'qwerty');
        echo "<br>";
        echo ($this->admindb->checkPass('qwerty'));

    }

    public function text()
    {
        $this->load->library('session');
        $this->load->model('apidb');
        $query = $this->apidb->getText(null);

        if ($this->session->logged_in) {
            $data = [
                'user' => $this->session->user,
                'content' => 'text',
                'list' => $query,
            ];

            $this->load->view('admin/dashboard', $data);
        } else {
            $this->load->helper('url');
            redirect('/admin/login');
        }
    }

    public function textAdd()
    {
        $this->load->library('session');

        $this->load->model('admindb');
        $this->load->helper('url');
        if ($this->session->logged_in) {
            if ($this->admindb->addText()) {
                redirect('/admin/text');
            }
        }

    }

    public function edit()
    {
        $this->load->library('session');
        $this->load->model('apidb');
        $query = $this->apidb->getText(null); //calls null to get all the items

        if ($this->session->logged_in) {
            $data = ['user' => $this->session->user,
                'content' => 'edit',
                'list' => $query];

            $this->load->view('admin/dashboard', $data);
        } else {
            $this->load->helper('url');
            redirect('/admin/login');
        }
    }

    public function editPost()
    {
        $this->load->library('session');
        $this->load->model('admindb');
        $this->load->helper('url');

        if ($this->session->logged_in) {
            $id = $this->input->post('text_id');
            $desc = $this->input->post('text_desc');
            $content = $this->input->post('text_content');

            if ($this->admindb->updateText($id, $desc, $content)) {

                redirect('admin/text/edit');
            }

        } else {

            redirect('/admin/login');
        }
    }

    public function remove()
    {
        $textId = ($this->input->post('text_id_del'));
        $this->load->model('admindb');
        $this->admindb->deleteText($textId);

        $this->load->helper('url');

        redirect('/admin/text/edit');
    }

    public function upload()
    {
        $this->load->library('session');
        if ($this->session->logged_in) {
            $this->load->model('admindb');
            $files = $this->admindb->getFiles();
            $data = [
                'user' => $this->session->user,
                'content' => 'upload',
                'files' => $files
            ];


            $this->load->view('admin/dashboard', $data);
        } else {
            $this->load->helper('url');
            redirect('/admin/login');
        }
    }

    public function uploadPost()
    {
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->logged_in) {
            
            redirect('/admin/login');
        }
        if (empty($_FILES['userfile']['name']))
        {
            redirect('/admin/upload');
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 51200;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $files = $this->admindb->getFiles();

            $data = [
                'user' => $this->session->user,
                'content' => 'upload',
                'error' => $error,
                'files' => $files
            ];
            $this->load->view('admin/dashboard', $data);
        }
        else {
            $upload = $this->upload->data();
            $this->load->model('admindb');
            if ($this->admindb->addFile($upload['file_path'], $upload['file_name'], $upload['file_size'])) {
                $this->load->helper('url');

                redirect('/admin/upload');
            }
            print_r($upload);
        }
    }

    public function uploadDelete()
    {
        $this->load->model('admindb');
        $id = $this->input->post('upload_id');
        if ($this->admindb->removeFile($id))
        {
            $this->load->helper('url');
            redirect('/admin/upload');
        }
    }

    public function logout()
    {
        $this->load->library('session');
        $this->load->helper('url');

        $this->session->unset_userdata('logged_in');
        redirect('/');
    }
}
