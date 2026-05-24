<?php

$host="localhost"; //sql311.infinityfree.com
$username = "root"; //if0_41984370
$password = ""; //
$db="employeesdb"; //if0_41984370_mydb
$dsn="mysql:host=$host;dbname=$db;charset=utf8"; // charset=utf8 คือยากให้ฐานข้อมูลรองรับการใช้ภาษาไทยด้วย

try{
    $pdo = new PDO($dsn,$username,$password,[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, //throw Exception when It has error
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, //fetch like as array write column name
    PDO::ATTR_EMULATE_PREPARES=>false]); // use native prepared statements
    //echo "เชื่อมสำเร็จ";
}catch(PDOException $e){
    //echo $e->getMessage();
    exit('Database connection failed.');
}
require_once "db/controller.php";
require_once "db/user.php";
$controller = new Controller($pdo); //จัดการข้อมูลพนักงาน
$user = new User($pdo); // จัดการผู้ใช้ระบบ

//$user->insertUser('admin','12345');


?>