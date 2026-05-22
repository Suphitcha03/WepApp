<?php
class User{
    private $db; //สร้างแอคทิบิ้ว 1 ตัวชื่อ private db
    function __construct($con)
    {
        $this->db=$con;
    }
    function insertUser($username,$password){
        try{
           $result= $this->getUserByUsername($username); //เคยถูกเก็บบันทึกในฐานข้อมูลไหม ถ้ามีค่า มากกว่า 0 ไม่เกิดกระบวนการบันทึกข้อมูล
            if($result["num"]>0){
                return false;
            } else{
                $new_password = md5($password.$username); //12345admin->md5
            $sql = "INSERT INTO
            users(username,password)
            VALUES (:username,:password)";
            $stmt =$this->db->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":password",$new_password);
            $stmt->execute();
            return true; //บันทึกผู้ใช้เเล้ว

            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    function getUserByUserName($username){
        try{
            $sql = "SELECT COUNT(*) as num
                    FROM users
                    WHERE username =:username";
            $stmt=$this->db->prepare($sql);
            $stmt->bindPAram(":username",$username);
            $stmt->execute();
            $result = $stmt->fetch(); //นับชื่อผู้ใช้ซ้ำกี่แถว
            return $result;

        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    //ใช้เชื่อมกับระบบ login
    function getUser($username,$password){
    try{
            $sql = "SELECT * FROM users
                    WHERE username=:username
                    AND password = :password ";
            $stmt=$this->db->prepare($sql);
            $stmt->bindPAram(":username",$username);
            $stmt->bindPAram(":password",$password);
            $stmt->execute();
            $result = $stmt->fetch(PDO :: FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}




?>