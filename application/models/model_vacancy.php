<?php

class model_vacancy extends Model {


    public function IsUserAuthen(){
        session_start();
        return isset($_SESSION['id']);
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

    public function GetCurrentUser(){
        session_start();
        if($this->IsUserAuthen()){
            return $_SESSION['id'];
        }
        else{
            return null;
        }
    }

    public function makepages($page){
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $limit = 3;
        $offset = ($limit * $page) - $limit;
        $sql = "select * from vacancy ORDER BY id DESC LIMIT {$offset}, {$limit}";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;
    }

    public function PagesCount(){
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "SELECT COUNT(*) FROM vacancy";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;

    }

    public function addvacancy(){

        session_start();
        require_once('application/controllers/config.php');
        if(isset($_POST['submit'])) {
                $title = trim($_POST['title']);
                $company = trim($_POST['company']);
                $city = trim($_POST['city']);
                $date = date('Y-m-d H:i:s');
                $salary = trim($_POST['salary']);
                $contacts = trim($_POST['contacts']);
                $descriptions = $_POST['descriptions'];
                $photo = '0';
                $rubric = $_POST['rubric'];
                $employment = $_POST['employment'];

                $user = $_SESSION['id'];
                if (isset($_SESSION['email'])) {
                    $sql = "insert into vacancy (title, company, city, created, salary,contacts, descriptions, photo, user_id, rubric, employment) 
                     values(:tit,:com,:cit,:dat,:sal,:cont, :desc, :photo, :user, :rubric, :employment)";

                    try {
                        $handle = $pdo->prepare($sql);
                        $params = [
                            ':tit' => $title,
                            ':com' => $company,
                            ':cit' => $city,
                            ':dat' => $date,
                            ':sal' => $salary,
                            ':cont' => $contacts,
                            ':desc' => $descriptions,
                            ':photo' => $photo,
                            ':user' => $user,
                            ':rubric' => $rubric,
                            ':employment' => $employment,
                        ];
                        $handle->execute($params);


                    } catch (PDOException $e) {
                        $errors[] = $e->getMessage();
                    }
                    $id_vac = $this->getvacancyIDlast();
                    if(is_file($_FILES['photo']['tmp_name']) && in_array($_FILES['photo']['type'], ['image/png', 'image/jpeg'])) {
                        $extension = match ($_FILES['photo']['type']) {
                            'image/png' => 'png',
                            default => 'jpeg',
                        };
                        $name = $id_vac[0]['id'].'_'.uniqid().'.'.$extension;
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/vacancys/' . $name);
                        $this->ChangePhoto($id_vac[0]['id'], $name);
                    }
                    header('Location:/user/account');
                    exit();
                }
            }

    }
    public function deletevacancy($id){
        //require_once('application/controllers/config.php');
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "DELETE FROM vacancy where id = {$id}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header('Location:/user/account');
        exit();
    }

    public function editvacancy($id){
        session_start();
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        //require_once('application/controllers/config.php');
        if(isset($_POST['submit'])) {
            $title = trim($_POST['title']);
            $company = trim($_POST['company']);
            $city = trim($_POST['city']);
            $date = date('Y-m-d H:i:s');
            $salary = trim($_POST['salary']);
            $contacts = trim($_POST['contacts']);
            $descriptions = $_POST['descriptions'];
            $photo = '0';
            $rubric = $_POST['rubric'];
            $employment = $_POST['employment'];

            if (isset($_SESSION['email'])) {
                $sql = "UPDATE vacancy SET title=:tit, company=:com, city=:cit, created=:dat, salary=:sal,contacts=:cont, descriptions=:desc, rubric=:rubric, employment=:employment
                    WHERE id={$id}";
                try {
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':tit' => $title,
                        ':com' => $company,
                        ':cit' => $city,
                        ':dat' => $date,
                        ':sal' => $salary,
                        ':cont' => $contacts,
                        ':desc' => $descriptions,
                        //':photo' => $photo,
                        ':rubric' => $rubric,
                        ':employment' => $employment,
                    ];
                    $handle->execute($params);


                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                }
                if(is_file($_FILES['photo']['tmp_name']) && in_array($_FILES['photo']['type'], ['image/png', 'image/jpeg'])) {
                    $extension = match ($_FILES['photo']['type']) {
                        'image/png' => 'png',
                        default => 'jpeg',
                    };
                    $name = $id.'_'.uniqid().'.'.$extension;
                    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/vacancys/' . $name);
                    $this->ChangePhoto($id, $name);
                }
                header('Location:/user/account');
                exit();
            }


        }


    }
    public function getvacancyID($id)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "select * from vacancy where id = :id ";
        $handle = $pdo->prepare($sql);
        $params = ['id' => $id];
        $handle->execute($params);
        if ($handle->rowCount() > 0) {
            $getRow = $handle->fetchAll();
            return $getRow;
        }
    }

    public function ChangePhoto($id, $file)
    {
        $folder = 'images/vacancy/';
        $vac = $this->getvacancyID($id);
        if (is_file($folder . $vac[0]['photo']) && is_file($folder . $file)) {
            unlink($folder . $vac[0]['photo']);
        }
        $vac[0]['photo'] = $file;
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "UPDATE vacancy SET photo=:photo WHERE id={$id}";
        try {
            $handle = $pdo->prepare($sql);
            $params = [
                ':photo' => $file,
            ];
            $handle->execute($params);
        } catch (PDOException $e) {
            $errors[] = $e->getMessage();
        }
    }
    public function getvacancyIDlast()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "SELECT * FROM vacancy ORDER BY id DESC LIMIT 1;";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;

    }

    public function getvacancybyUSERID($id)
    {
        require_once('application/controllers/config.php');
        $sql = "select * from vacancy where user_id = :id ";
        $handle = $pdo->prepare($sql);
        $params = ['id' => $id];
        $handle->execute($params);
        if ($handle->rowCount() > 0) {
            $getRow = $handle->fetchAll();
            return $getRow;

        }
    }

    public function search($search){
        //require_once('application/controllers/config.php');
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "SELECT * FROM vacancy WHERE title LIKE '%$search%' LIMIT 5";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;

    }
}

