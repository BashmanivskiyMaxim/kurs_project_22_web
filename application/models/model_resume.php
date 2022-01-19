<?php

class model_resume extends Model {

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

    public function getresumes(){
        require_once('application/controllers/config.php');
        $sql = "select * from resume";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;
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
    public function getresumeID($id){
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "select * from resume where id = :id ";
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
        $folder = 'images/resumes/';
        $vac = $this->getresumeID($id);
        if (is_file($folder . $vac[0]['photo']) && is_file($folder . $file)) {
            unlink($folder . $vac[0]['photo']);
        }
        $vac[0]['photo'] = $file;
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "UPDATE resume SET photo=:photo WHERE id={$id}";
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
    public function getresumeIDlast()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "SELECT * FROM resume ORDER BY id DESC LIMIT 1;";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;
    }

    public function addresume(){
        session_start();
        require_once('application/controllers/config.php');
        if(isset($_POST['submit'])) {
            //var_dump($_FILES);
            //move_uploaded_file($_FILES['photo']['tmp_name'], 'images/vacancy/'.$_FILES['photo']['name']);
            $last_name = trim($_POST['last_name']);
            $first_name = trim($_POST['first_name']);
            $email = trim($_POST['email']);
            $city = trim($_POST['city']);
            $date = date('Y-m-d H:i:s');
            $salary = trim($_POST['salary_exp']);
            $contacts = trim($_POST['contacts']);
            $descriptions = $_POST['descriptions'];
            //$photo = '0';
            $job_exp_rubric = $_POST['job_exp_rubric'];
            $employment = $_POST['employment'];
            $user = $_SESSION['id'];
            $job_pos = $_POST['job_pos'];
            $age = $_POST['age'];

            if (isset($_SESSION['email'])) {
                $sql = "insert into resume (age, last_name, first_name, email, created_at, updated_at, job_pos, contacts, salary_exp, city, job_exp_rubric, employment, descriptions, user_id) 
                     values(:age, :ln,:fn,:email,:created_at, :updated_at, :job_pos,:cont, :salary_exp, :city, :job_exp_rubric, :employment, :desc, :user_id)";

                try {
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':age' => $age,
                        ':ln' => $last_name,
                        ':fn' => $first_name,
                        'email' => $email,
                        ':created_at' => $date,
                        ':updated_at' => $date,
                        'job_pos' => $job_pos,
                        ':cont' => $contacts,
                        ':salary_exp' => $salary,
                        ':city' => $city,
                        'job_exp_rubric' => $job_exp_rubric,
                        ':employment' => $employment,
                        ':desc' => $descriptions,
                        ':user_id' => $user,
                    ];
                    $handle->execute($params);

                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                }
                $id_res = $this->getresumeIDlast();
                if(is_file($_FILES['photo']['tmp_name']) && in_array($_FILES['photo']['type'], ['image/png', 'image/jpeg'])) {
                    $extension = match ($_FILES['photo']['type']) {
                        'image/png' => 'png',
                        default => 'jpeg',
                    };
                    $name = $id_res[0]['id'].'_'.uniqid().'.'.$extension;
                    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/resumes/' . $name);
                    $this->ChangePhoto($id_res[0]['id'], $name);
                }
                header('Location:/user/account');
                exit();
            }
        }
    }

    public function editresume($id){
        session_start();
        require_once('application/controllers/config.php');
        if(isset($_POST['submit'])) {
            $last_name = trim($_POST['last_name']);
            $first_name = trim($_POST['first_name']);
            $email = trim($_POST['email']);
            $city = trim($_POST['city']);
            $date = date('Y-m-d H:i:s');
            $salary = trim($_POST['salary_exp']);
            $contacts = trim($_POST['contacts']);
            $descriptions = $_POST['descriptions'];
            $job_exp_rubric = $_POST['job_exp_rubric'];
            $employment = $_POST['employment'];
            $job_pos = $_POST['job_pos'];
            $age = $_POST['age'];

            if (isset($_SESSION['email'])) {
                $sql = "UPDATE resume SET age=:age, last_name=:ln, first_name=:fn, email=:email, updated_at=:updated_at, job_pos=:job_pos, contacts=:cont, salary_exp=:salary_exp, city=:city, job_exp_rubric=:job_exp_rubric, employment=:employment, descriptions=:desc 
                     WHERE id={$id}";

                try {
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':age' => $age,
                        ':ln' => $last_name,
                        ':fn' => $first_name,
                        'email' => $email,
                        ':updated_at' => $date,
                        'job_pos' => $job_pos,
                        ':cont' => $contacts,
                        ':salary_exp' => $salary,
                        ':city' => $city,
                        'job_exp_rubric' => $job_exp_rubric,
                        ':employment' => $employment,
                        ':desc' => $descriptions
                    ];
                    $handle->execute($params);

                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                    echo var_dump($errors);
                }
                if(is_file($_FILES['photo']['tmp_name']) && in_array($_FILES['photo']['type'], ['image/png', 'image/jpeg'])) {
                    $extension = match ($_FILES['photo']['type']) {
                        'image/png' => 'png',
                        default => 'jpeg',
                    };
                    $name = $id.'_'.uniqid().'.'.$extension;
                    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/resumes/' . $name);
                    $this->ChangePhoto($id, $name);
                }
                header('Location:/user/account');
                exit();
            }
        }
    }
    public function deleteresume($id){
        require_once('application/controllers/config.php');
        //$pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "DELETE FROM resume where id = {$id}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header('Location:/user/account');
        exit();
    }

    public function search($search){
        //require_once('application/controllers/config.php');
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "SELECT * FROM resume WHERE job_pos LIKE '%$search%' LIMIT 5";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;

    }

    public function makepages($page){
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $limit = 3;
        $offset = ($limit * $page) - $limit;
        $sql = "select * from resume ORDER BY id DESC LIMIT {$offset}, {$limit}";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;
    }

    public function PagesCount(){
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        $sql = "SELECT COUNT(*) FROM resume";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $getRow = $handle->fetchAll();
        return $getRow;

    }
}

