<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Usermodel');
        $this->load->model('Commentsmodel');
    }

    public function index() {
        if (isset($_SESSION['id']))
            redirect(base_url('main/profile/'.$_SESSION['id']), 'refresh');
        else
            redirect(base_url('main/login'), 'refresh');
    }

    public function profile($id) {
        $pageData['tabTitle'] = 'Мой профиль';
        $pageData['id'] = $id;
        $profileData = $this->Usermodel->getProfileData($id);
        $pageData['comments'] = $this->Commentsmodel->getCommentsList($id, "recipients", 5);
        if (isset($_SESSION['id'])) $pageData['loggedIn'] = TRUE;
        $pageData['profiles'] = $this->Usermodel->getProfilesList();
        if ($profileData != FALSE) {
            $pageData['first_name'] = $profileData->first_name;
            $pageData['last_name'] = $profileData->last_name;
            $this->render('profile', $pageData);
        } else {
            $this->error();
        }
    }

    public function register($dataNotCorrect = FALSE) {
        $pageData['tabTitle'] = 'Регистрация';
        $pageData['profiles'] = $this->Usermodel->getProfilesList();
        if ($dataNotCorrect)
            switch($dataNotCorrect) {
                case 2:
                    $pageData['message'] = "Длина пароля от 8 до 20 символов";
                    break;
                case 3:
                    $pageData['message'] = "Длина логина от 4 до 20 символов";
                    break;
                case 4:
                    $pageData['message'] = "Проверьте правильность ввода почтового адреса";
                    break;
                case 5:
                    $pageData['message'] = "Логин занят";
                    break;
                default:
                    break;
            }
        $this->render('register', $pageData);
    }

    public function comments() {
        $pageData['tabTitle'] = 'Мои комментарии';
        if (isset($_SESSION['id'])) {
            $pageData['loggedIn'] = TRUE;
            $pageData['id'] = $_SESSION['id'];
            $pageData['comments'] = $this->Commentsmodel->getCommentsList($pageData['id'], "senders");
            $pageData['allCommentsLoaded'] = $this->Commentsmodel->getCommentsList($pageData['id'], "senders");
        }
        else {
            redirect(base_url('main/login'), 'refresh');
            return;
        }
        $pageData['profiles'] = $this->Usermodel->getProfilesList();
        $this->render('comments', $pageData);
    }

    public function login($dataNotCorrect = FALSE)
    {
        $pageData['tabTitle'] = 'Аутентификация';
        $pageData['profiles'] = $this->Usermodel->getProfilesList();
        if ($dataNotCorrect)
            $pageData['message'] = 'Неверный логин или пароль';
        $this->render('login', $pageData);
    }

    public function error($errDesc = '404') {
        $pageData['tabTitle'] = 'Что-то не так';
        if ($errDesc == '404') $errDesc = 'К сожалению, такой страницы не существует.';
        $pageData['title'] = $errDesc;
        $this->render('errors/notfound', $pageData);
    }
}