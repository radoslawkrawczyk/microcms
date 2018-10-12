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
        $this->load->model('admindb');
        if ($this->admin->install()) {
            echo 'Already installed!';
        }
    }

    public function login()
    {
        $this->load->view('admin/login');

    }

    public function logged()
    {
        $this->load->helper('url');
        $this->load->model('admindb');
        if ($this->admindb->getUser()) {
            $this->load->library('session');
            if ($this->session->logged_in) {

                redirect('/admin/dashboard');
            }
        }
    }

    public function dashboard()
    {
        $this->load->library('session');
        if ($this->session->logged_in) {
            $data = ['user' => $this->session->user];
            $this->load->view('admin/dashboard', $data);
        } else {
            $this->load->helper('url');
            redirect('/admin/login');
        }
    }

    public function text()
    {
        $this->load->library('session');
        $this->load->model('apidb');
        $query = $this->apidb->getText(null);

        if ($this->session->logged_in) {
            $data = ['user' => $this->session->user,
            'content' => 'text',
            'list' => $query];
            
            $this->load->view('admin/dashboard', $data);
        } else {
            $this->load->helper('url');
            redirect('/admin/login');
        }
    }

    public function textAdd()
    {
        $this->load->model('admindb');
        $this->load->helper('url');

        if ($this->admindb->addText()) {
            redirect('/admin/text');
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
