<?php
class Controller {
    private $db;

    function __construct($con){
        $this->db=$con;
        //echo "มีการเรียกใช้งาน Controller";
    }


    function getDepartments(){
        try{
            $sql ="select * from departments";
            $result = $this->db->query($sql);
            return $result;
        }catch(PDOException $e){
        echo $e->getMessage();
        return false;
        }
    }

    function getEmployees(){
        try{
            $sql ="select *
            from employees e
            inner join departments d on e.department_id = d.department_id
            order by e.salary ASC"; //เลือกการเชื่อมตาราง
            $result = $this->db->query($sql);
            return $result;
        }catch(PDOException $e){
        echo $e->getMessage();
        return false;
        }
    }
    function insert($fname,$lname,$salary,$department_id){
        try{
        $sql = "INSERT INTO employees(fname,lname,salary,department_id)
                VALUES(:fname,:lname,:salary,:department_id)
                ";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(":fname",$fname);
                $stmt->bindParam(":lname",$lname);
                $stmt->bindParam(":salary",$salary);
                $stmt->bindParam(":department_id",$department_id);
                $stmt->execute();
                return true;

        }catch(PDOException $e){
        //echo $e->getMessage();
        return false;
        }
    } 
        function delete($id){
            try{
            $sql="DELETE FROM employees
                WHERE emp_id=:id"; //เอารหัสพนงมาเป็นตัวอ้างอิง โดยรหัสพนงที่ส่งมาจะให้parametor :id เป็นคนรับค่าที่ส่งมา
                $stmt=$this->db->prepare($sql); //this-> attribute เรียกใช้ method prepare เพื่อทำการผูกค่า พารามิเตอร์ลงไปในคำสั่ง sql ส่งค่ากลับไปstmt 
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                 return true;

            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
        function getEmployeeDetail($id){
            try{
                $sql="SELECT * FROM employees e 
                    INNER JOIN departments d on d.department_id = e.department_id
                    WHERE emp_id = :id";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;

            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
        function update($fname,$lname,$salary,$department_id,$emp_id){
            try{
                $sql="UPDATE employees
                        SET fname=:fname , lname =:lname , salary=:salary, department_id = :department_id 
                        WHERE emp_id = :emp_id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":fname",$fname);
                $stmt->bindParam(":lname",$lname);
                $stmt->bindParam(":salary",$salary);
                $stmt->bindParam(":department_id",$department_id);
                $stmt->bindParam(":emp_id",$emp_id);
                $stmt->execute();
                return true;

            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
    }


?>