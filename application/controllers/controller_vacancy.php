<?php

class Controller_vacancy extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->model = new model_vacancy();
        $this->view = new View();
        $this->user = $this->model->GetCurrentUser();
    }

    function action_index(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $data = $this->model->search($search);
            $this->view->generate('vacancy/resSearch_view.php', 'template_view.php', $data);
        }
        else {
            $page = $_GET['page'];
            $data = $this->model->makePages($page);
            $data1 =  $this->model->PagesCount();
            $this->view->generate('vacancy/vacancys_view.php', 'template_view.php', $data, $data1);
        }

    }

    function action_add(){
        if(empty($this->user)){
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
        else{
            $this->model->addvacancy();
            $this->view->generate('vacancy/add_view.php', 'template_view.php');
        }
    }
    function action_edit(){
        $id = $_GET['id'];
        $data = $this->model->getvacancyID($id);
        $us = $this->user;
        if($us == 11){
            $this->model->editvacancy($id);
            $this->view->generate('vacancy/edit_view.php', 'template_view.php', $data);
        }
        else if($data[0]['user_id'] == $us){
            $this->model->editvacancy($id);
            $this->view->generate('vacancy/edit_view.php', 'template_view.php', $data);
        }
        else {
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
    }
    function action_view(){
        $id = $_GET['id'];
        $data = $this->model->getvacancyID($id);
        $this->view->generate('vacancy/detail_view.php', 'template_view.php', $data);
        }
    function action_delete(){
        $id = $_GET['id'];
        $data = $this->model->getvacancyID($id);
        $us = $this->user;

        if($us == 11){
            $this->model->deletevacancy($id);
            $this->view->generate('main_view.php', 'template_view.php');
        }
        else if($data[0]['user_id'] == $us){
            $this->model->deletevacancy($id);
            $this->view->generate('main_view.php', 'template_view.php');
        }
        else {
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
    }
}
