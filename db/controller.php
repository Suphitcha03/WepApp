<?php
class Controller {
    private $db;

    function __construct( $con){
        $this->db=$con;
        //echo "มีการเรียกใช้งาน Controller";
    }


    function getDepartments(){
        try{
            $sql ="SELECT department_id, department_name 
                   FROM departments
                   ORDER BY department_name ASC";
            $stmt = $this->db->query($sql);
            return $stmt;
        }catch(PDOException $e){
        return false;
        }
    }

    function getEmployees() {
        try{
            $sql ="SELECT *
            FROM employees e
            INNER JOIN departments d ON e.department_id = d.department_id
            ORDER BY e.salary ASC"; 
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        }catch(PDOException $e){
        return false;
        }
    }
    function insert(string $fname, string $lname, float $salary, int $department_id): bool {
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
        function delete(int $id) : bool{
            try{
            $sql="DELETE FROM employees
                WHERE emp_id=:id"; //เอารหัสพนงมาเป็นตัวอ้างอิง โดยรหัสพนงที่ส่งมาจะให้parametor :id เป็นคนรับค่าที่ส่งมา
                $stmt=$this->db->prepare($sql); //this-> attribute เรียกใช้ method prepare เพื่อทำการผูกค่า พารามิเตอร์ลงไปในคำสั่ง sql ส่งค่ากลับไปstmt 
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                 return true;

            }catch(PDOException $e){
                return false;
            }
        }
        function getEmployeeDetail(int $id) {
            try{
                $sql="SELECT * FROM employees e 
                    INNER JOIN departments d on d.department_id = e.department_id
                    WHERE emp_id = :id
                    LIMIT 1";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;

            }catch(PDOException $e){
                return false;
            }
        }
        function update($fname,$lname,$salary,$department_id,$emp_id): bool{
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
                return false;
            }
        }
    }


?>