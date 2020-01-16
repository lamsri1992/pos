<?php

Class pos {
    
    public function getUser($id){
        $sql = "SELECT * FROM tb_employee
                WHERE tb_employee.emp_id = '{$id}'";
        global $mysqli;
        $res = $mysqli->query($sql);
        $data = $res->fetch_assoc();
    return $data;
    }
}

?>