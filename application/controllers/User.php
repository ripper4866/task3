<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Usermodel');
    }

    public function auth($username = '', $password = '') {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
        }
            $answer = $this->Usermodel->checkAuthentication($username, $password);
            if($answer != FALSE) {
                $data = array(
                    'id'        => $answer->id,
                    'first_name'=> $answer->first_name,
                    'last_name' => $answer->last_name,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($data);
                redirect(base_url('main/profile/'.$_SESSION['id']), 'refresh');
                return;
            }
            redirect(base_url('main/login/error'), 'refresh');
    }

    public function reg() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $username = $_POST['username'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $data = array(
                'username'  => $username,
                'password'  => $password,
                'email'     => $email,
                'first_name'=> $first_name,
                'last_name' => $last_name,
            );
            $checkRegData = $this->Usermodel->checkRegData($data);
            if ($checkRegData != FALSE) {
                redirect(base_url('main/register/' . $checkRegData), 'refresh');
                return;
            }
            $this->Usermodel->createUser($data);
            $this->auth($username, $password);
        }
    }

    public function getProfilesList() {
        return $this->Usermodel->getProfilesList();
    }

    public function logout() {
        $newdata = array(
            'id'        => '',
            'first_name'=> '',
            'last_name' => '',
            'logged_in' => FALSE
        );
        $this->session->unset_userdata($newdata );
        $this->session->sess_destroy();
        redirect(base_url('main/login'), 'refresh');
    }
}