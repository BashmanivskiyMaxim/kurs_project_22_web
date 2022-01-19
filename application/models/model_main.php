<?php

class model_main extends Model{

    public function getcards(){
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        require_once('application/controllers/config.php');
        $sql = "select * from main";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;
    }

    public function GetAdmin(){
        session_start();
        if($this->IsUserAuthen()){
            if($_SESSION['id'] == 11){
                return $_SESSION['id'];
            }
            else{
                return 'admin';
            }
        }
        else{
            return 'admin';
        }
    }
    public function IsUserAuthen(){
        session_start();
        return isset($_SESSION['id']);
    }

    public function GetCurrentUser(){
        session_start();
        if($this->IsUserAuthen()){
            return $_SESSION['id'];
        }
        else{
            return null;
        }
    }

    public function addcard(){
        if(isset($_POST['submit'])) {
        session_start();
        require_once('application/controllers/config.php');
        $title = trim($_POST['title']);
        $card_text = trim($_POST['card_text']);
                $sql = "insert into main (title, card_text) 
                     values(:title, :card_text)";
                try {
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':title' => $title,
                        ':card_text' => $card_text
                    ];
                    $handle->execute($params);

                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                }
                header('Location:/main/index');
                exit();
            }
    }

    public function editcard($id){
        if(isset($_POST['submit'])) {
        session_start();
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        require_once('application/controllers/config.php');
        $title = $_POST['title'];
        $card_text = $_POST['card_text'];
            $sql = "UPDATE main SET title=:title, card_text=:card_text WHERE id = {$id} ";
            try {
                $handle = $pdo->prepare($sql);
                $params = [
                    ':title' => $title,
                    ':card_text' => $card_text
                ];
                $handle->execute($params);

            } catch (PDOException $e) {
                $errors[] = $e->getMessage();
            }
            header('Location:/main/index');
            exit();
        }

    }

    public function deletecard($id){
        require_once('application/controllers/config.php');
        //$pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "DELETE FROM main where id = {$id}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header('Location:/main/index');
        exit();
    }

    public function getcardID($id){
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "select * from main where id = :id ";
        $handle = $pdo->prepare($sql);
        $params = ['id' => $id];
        $handle->execute($params);
        if ($handle->rowCount() > 0) {
            $getRow = $handle->fetchAll();
            return $getRow;
        }
    }





}
