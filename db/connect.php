<?php

$host="localhost";
$username = "root";
$password = "";
$db="employeesdb";
$dsn="mysql:host=$host;dbname=$db;charset=utf8"; // charset=utf8 คือยากให้ฐานข้อมูลรองรับการใช้ภาษาไทยด้วย

Try{
    $pdo = new PDO($dsn,$username,$password);
    //echo "เชื่อมสำเร็จ";
}catch(PDOException $e){
    echo $e->getMessage();
}
require_once "db/Controller.php";
require_once "db/user.php";
$controller = new Controller($pdo); //จัดการข้อมูลพนักงาน
$user = new User($pdo); // จัดการผู้ใช้ระบบ

$user->insertUser('admin','12345');


?>