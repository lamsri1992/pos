<?php

Class pos {
    
    public function getUser($id){
        $sql = "SELECT * 
                FROM tb_employee
                WHERE tb_employee.emp_id = '{$id}'";
        global $mysqli;
        $res = $mysqli->query($sql);
        $data = $res->fetch_assoc();
    return $data;
    }

    public function countItem(){
        $sql = "SELECT COUNT(*) AS num
                FROM tb_item";
        global $mysqli;
        $res = $mysqli->query($sql);
        $data = $res->fetch_assoc();
    return $data;
    }

    public function countOrderPoint(){
        $sql = "SELECT COUNT(*) AS num
                FROM tb_item
                WHERE item_balance = item_orderpoint";
        global $mysqli;
        $res = $mysqli->query($sql);
        $data = $res->fetch_assoc();
    return $data;
    }

    public function countLowOrderPoint(){
        $sql = "SELECT COUNT(*) AS num
                FROM tb_item
                WHERE item_balance < item_orderpoint";
        global $mysqli;
        $res = $mysqli->query($sql);
        $data = $res->fetch_assoc();
    return $data;
    }

    public function getLastOrder(){
        $sql = "SELECT MAX(order_id) AS last_id FROM tb_order";
        global $mysqli;
        $res = $mysqli->query($sql);
        $data = $res->fetch_assoc();
    return $data;
    }

    public function getCart(){
        $sql = "SELECT * 
                FROM tb_order_list
                LEFT JOIN tb_item ON tb_item.item_barcode = tb_order_list.list_barcode";
        global $mysqli; $obj = array();
        $res = $mysqli->query($sql);
        while($data = $res->fetch_assoc()) {
            $obj[] = $data;
        }
    return $obj;
    }
}

?>