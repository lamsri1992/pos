<?php
session_start();
include ('../config/database.php');
$mysqli = connect();

$user = mysqli_real_escape_string($mysqli,$_POST['username']);
$pass = mysqli_real_escape_string($mysqli,$_POST['password']);
$hash = $pass;

    $sql = "SELECT * 
            FROM tb_employee
            WHERE emp_name = '{$user}'";

    global $mysqli;
        $res = $mysqli->query($sql);
        $obj = $res->fetch_assoc();

    if (password_verify($hash,$obj['emp_pass'])){
        $_SESSION['user'] = $obj['emp_id'];
        header('Location: ../?');
    }else{
        $_SESSION['authen'] = 'fail';
        header('Location: ../login.php');
        exit();
    }
?>