<?php
class User{
    private $db; //สร้างแอคทิบิ้ว 1 ตัวชื่อ private db
    function __construct($con)
    {
        $this->db=$con;
    }
    function insertUser(string $username,string $password) {
        try{
           $result= $this->userExists($username); //เคยถูกเก็บบันทึกในฐานข้อมูลไหม ถ้ามีค่า มากกว่า 0 ไม่เกิดกระบวนการบันทึกข้อมูล
            if($result && (int)$result["num"]>0){
                return false;
            } else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            //$new_password = md5($password.$username); //12345admin->md5
            $sql = "INSERT INTO
            users(username,password)
            VALUES (:username,:password)";
            $stmt =$this->db->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":password",$hash);
            return $stmt->execute();
            ; //บันทึกผู้ใช้เเล้ว

            }
        }catch(PDOException $e){
            return false;
        }
    }
    function userExists(string $username) {
        try{
            $sql = "SELECT EXISTS(SELECT 1 FROM users 
                    WHERE username = :username) AS num";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->execute();
            $row = $stmt->fetch(); //นับชื่อผู้ใช้ซ้ำกี่แถว
            return ['num' => $row ? (int)$row['exists_user'] : 0];

        }catch(PDOException $e){
            return false;
        }
    }
    //ใช้เชื่อมกับระบบ login
    function getUser(string $username, string $password){
    try{
            $sql = "SELECT * FROM users
                    WHERE username=:username LIMIT 1;";
            
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->execute();
            $row = $stmt->fetch();
            if(!$row){
                return false; //ไม่พบผู้ใช้
            }
            if (password_verify($password,$row['password'])){
                unset($row['password']); //ไม่ส่งแอชขึ้นไปชั้นบน
                return $row; //ล็อกอินสำเร็จ
            }
            return false;            
        }catch(PDOException $e){
            return false;
        }
    }
}




?>