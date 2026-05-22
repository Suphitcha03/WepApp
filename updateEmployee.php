<?php

require_once "db/connect.php";
//ถ้ามีการส่งข้อมูลมาในรูปแบบPOSTเมธอด ค่าที่ส่งมาเกิดจากกดปุ่ม submit จะให้ทำการรับค่าจากฟร์อมแก้ไข fname,lname,salary,department
if(isset($_POST["submit"])){
    //ส่งข้อมูลให้กับพนง เลขไอดีอะไร มาจาก รหัสพนงที่อยากอัพเดท
    $emp_id = $_POST["emp_id"];
//คำสั่งรับค่าที่ส่งมาจากแบบฟอร์มเเก้ไข
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $salary=$_POST["salary"];
    $department_id=$_POST["department_id"];

   $result = $controller->update($fname,$lname,$salary,$department_id,$emp_id);
    if($result){
        header("Location:index.php");
    }

    
}


?>