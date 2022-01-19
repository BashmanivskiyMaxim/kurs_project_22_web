<?php

class model_user extends Model {


    public function get_reg()
    {
        session_start();
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        require_once('application/controllers/config.php');

        if(isset($_POST['submit']))
        {
            if(isset($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['password']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']))
            {
                $firstName = trim($_POST['first_name']);
                $lastName = trim($_POST['last_name']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $resume = trim($_POST['resume']);

                $options = array("cost"=>4);
                $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
                $date = date('Y-m-d H:i:s');

                if(filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $sql = 'select * from users where email = :email';
                    $stmt = $pdo->prepare($sql);
                    $p = ['email'=>$email];
                    $stmt->execute($p);

                    if($stmt->rowCount() == 0)
                    {
                        $sql = "insert into users (first_name, last_name, email, password, created_at,updated_at, resume) values(:fname,:lname,:email,:pass,:created_at,:updated_at, :resume)";

                        try{
                            $handle = $pdo->prepare($sql);
                            $params = [
                                ':fname'=>$firstName,
                                ':lname'=>$lastName,
                                ':email'=>$email,
                                ':pass'=>$hashPassword,
                                ':created_at'=>$date,
                                ':updated_at'=>$date,
                                ':resume' => $resume
                            ];

                            $handle->execute($params);



                        }
                        catch(PDOException $e){
                            $errors[] = $e->getMessage();
                        }
                        header('Location:/user/login');
                        exit();
                    }
                    else {
                        echo "<script> alert('Дану email адресу вже зареєстровали!!!') </script>";
                    }

                }

            }
        }

    }
    public function get_login()
    {
        session_start();
        require_once('application/controllers/config.php');

        if(isset($_POST['submit']))
        {
            if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
            {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                if(filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $sql = "select * from users where email = :email ";
                    $handle = $pdo->prepare($sql);
                    $params = ['email'=>$email];
                    $handle->execute($params);
                    if($handle->rowCount() > 0)
                    {
                        $getRow = $handle->fetch(PDO::FETCH_ASSOC);
                        if(password_verify($password, $getRow['password']))
                        {
                            unset($getRow['password']);
                            $_SESSION = $getRow;
                            header('Location:/main/');
                            exit();
                        }
                        else
                        {
                            echo "<script> alert('Невірний емейл або пароль!!!') </script>";
                        }
                    }
                    else
                    {
                        echo "<script> alert('Невірний емейл або пароль!!!') </script>";
                    }

                }
                else
                {
                    $errors[] = "Email address is not valid";
                }

            }
            else
            {
                $errors[] = "Email and Password are required";
            }

        }
    }
    public function log_out(){
        session_start();
        if (isset($_SESSION)) {
            session_destroy();
            header('location:/main/');
            exit();
        }
    }

    public function delete_acc(){
        session_start();
        require_once('application/controllers/config.php');

        $id = $_SESSION["id"];
        $sql = "DELETE FROM users WHERE id ={$id}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        session_destroy();
        header('location:/user/login');
        exit();
    }

    public function get_changes(){
        session_start();
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        require_once('application/controllers/config.php');
        if(isset($_POST['submit1']))
        {
            if(isset($_POST['first_name'],$_POST['last_name'],$_POST['email']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email'])) {

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $resume = $_POST['resume'];
                $email = $_POST['email'];
                $updated_at = date('Y-m-d H:i:s');

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $sql = "select * from users where email = :email ";
                    $handle = $pdo->prepare($sql);
                    $params = ['email' => $email];
                    $handle->execute($params);

                    if ($handle->rowCount() != 0) {
                        $getRow = $handle->fetch(PDO::FETCH_ASSOC);


                        if ($first_name != $getRow['first_name']) {
                            $sql_pass2 = "UPDATE users SET first_name=:first_name, updated_at=:updated_at WHERE id={$getRow["id"]}";
                            $ch2 = $pdo -> prepare($sql_pass2);
                            $ch2 -> execute(["first_name"=> $first_name,
                                "updated_at"=> $updated_at]);
                            $_SESSION = $getRow['first_name'];
                        } else {
                            $errors[] = "Error2";
                        }

                        if ($last_name != $getRow['last_name']) {
                            $sql_pass3 = "UPDATE users SET last_name=:last_name, updated_at=:updated_at WHERE id = {$getRow["id"]}";
                            $ch3 = $pdo -> prepare($sql_pass3);
                            $ch3 -> execute(["last_name"=> $last_name, "updated_at"=> $updated_at]);
                            $_SESSION = $getRow['last_name'];
                        } else {
                            $errors[] = "Error3";
                        }

                        if ($resume != $getRow['resume']) {
                            $sql_pass3 = "UPDATE users SET resume=:resume, updated_at=:updated_at WHERE id = {$getRow["id"]}";
                            $ch3 = $pdo -> prepare($sql_pass3);
                            $ch3 -> execute(["resume"=> $resume, "updated_at"=> $updated_at]);
                            $_SESSION = $getRow['resume'];
                        } else {
                            $errors[] = "Error3";
                        }
                    }
                }
            }
            session_destroy();
            header('location:/user/login/');
            exit();
        }
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

    public function getresumebyUSERID($id)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=course_work', 'root', 'Doogee1203');
        //require_once('application/controllers/config.php');
        $sql = "select * from resume where user_id = :id ";
        $handle = $pdo->prepare($sql);
        $params = ['id' => $id];
        $handle->execute($params);
        if ($handle->rowCount() > 0) {
            $getRow = $handle->fetchAll();
            return $getRow;

        }
    }
}
