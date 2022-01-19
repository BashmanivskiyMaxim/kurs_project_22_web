<?php

class Controller_resume extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->model = new model_resume();
        $this->view = new View();
        $this->user = $this->model->GetCurrentUser();

    }
    function action_index(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $data = $this->model->search($search);
            $this->view->generate('resume/resSearch_view.php', 'template_view.php', $data);
        }
        else {
            $page = $_GET['page'];
            $data = $this->model->makePages($page);
            $data1 =  $this->model->PagesCount();
            $this->view->generate('resume/resumes_view.php', 'template_view.php', $data, $data1);
        }

    }
    function action_add(){
        if(empty($this->user)){
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
        else{
            $this->model->addresume();
            $this->view->generate('resume/add_view.php', 'template_view.php');
        }
    }
    function action_edit(){
        $id = $_GET['id'];
        $data = $this->model->getresumeID($id);
        $us = $this->user;
        if($us == 11){
            $this->model->editresume($id);
            $this->view->generate('resume/edit_view.php', 'template_view.php', $data);
        }
        else if($data[0]['user_id'] == $us){
            $this->model->editresume($id);
            $this->view->generate('resume/edit_view.php', 'template_view.php', $data);
        }
        else {
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
    }
    function action_view(){
        $id = $_GET['id'];
        $data = $this->model->getresumeID($id);
        $this->view->generate('resume/detail_view.php', 'template_view.php', $data);
    }
    function action_delete(){
        $id = $_GET['id'];
        $data = $this->model->getresumeID($id);
        $us = $this->user;
        if($us == 11){
            $this->model->deleteresume($id);
            $this->view->generate('user/account_view.php', 'template_view.php');
        }
        if($data[0]['user_id'] == $us){
            $this->model->deleteresume($id);
            $this->view->generate('user/account_view.php', 'template_view.php');
        }
        else {
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
    }


}