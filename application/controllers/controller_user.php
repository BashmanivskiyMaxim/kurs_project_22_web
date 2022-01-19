<?php

class Controller_user extends Controller
{
    function __construct()
    {
        $this->model = new model_user();
        $this->view = new View();
    }
    function action_register()
    {
        $this->model->get_reg();
        $this->view->generate('user/register_view.php', 'template_view.php');
    }
    function action_login()
    {
        $this->model->get_login();
        $this->view->generate('user/login_view.php', 'template_view.php');
    }
    function action_logout()
    {
        $this->model->log_out();
        $this->view->generate('main_view.php', 'template_view.php');
    }
    function action_account()
    {
        session_start();
        if(isset($_SESSION['id'])){
            $data1 = $this->model->getvacancybyUSERID($_SESSION['id']);
            $data2 = $this->model->getresumebyUSERID($_SESSION['id']);
            $this->model->get_changes();
            $this->view->generate('user/account_view.php', 'template_view.php', $data1, $data2);
        }
        else{
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
    }
    function action_deleteAc()
    {
        $this->model->delete_acc();
        $this->view->generate('user/login_view.php', 'template_view.php');
    }

}
