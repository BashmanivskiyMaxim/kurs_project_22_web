<?php

class Controller_Main extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->model = new model_main();
        $this->view = new View();
        $this->user = $this->model->GetCurrentUser();
    }

    function action_index()
    {
        $data = $this->model->getcards();
        $this->view->generate('main/main_view.php', 'template_view.php', $data);
    }

    function action_add(){
        $us = $this->user;
        if($us != 11){
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
        else{
            $this->model->addcard();
            $this->view->generate('main/add_view.php', 'template_view.php');
        }
    }
    function action_edit(){
        $id = $_GET['id'];
        $data = $this->model->getcardID($id);
        $us = $this->user;
        if($us == 11){
            $this->model->editcard($id);
            $this->view->generate('main/edit_view.php', 'template_view.php', $data);
        }
        else {
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
    }
    function action_delete(){
        $id = $_GET['id'];
        $data = $this->model->getcardID($id);
        $us = $this->user;
        if($us == 11){
            $this->model->deletecard($id);
            $this->view->generate('main/main_view.php', 'template_view.php');
        }
        else {
            $this->view->generate('forbidden_view.php', 'template_view.php');
        }
    }

    function action_employment(){
        $this->view->generate('main/employment_view.php', 'template_view.php');
    }
    function action_searchjob(){
        $this->view->generate('main/searchjob_view.php', 'template_view.php');
    }

}

