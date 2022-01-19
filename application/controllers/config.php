<?php
$dsn = 'mysql:dbname=course_work;host=localhost';
$user = 'root';
$password = 'Doogee1203';
try
{
    $pdo = new PDO($dsn,$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "PDO error".$e->getMessage();
    die();
}
?>