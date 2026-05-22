<?php
require_once "db/connect.php";
//ถ้าไม่มีการส่งไอดีมาให้วิ่งกลับไปหน้าเเรก อัตโนมัติ
if(!isset($_GET["id"])){
    header("Location:index.php");
}else{
    $id=$_GET["id"];
    $result = $controller->delete($id);
    if($result){
        header("Location:index.php");
    }
}

?>