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
                WHERE item_balance <= item_orderpoint";
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

    public function getItem($barcode){
        $sql = "SELECT *
                FROM tb_item
                WHERE item_barcode = '{$barcode}'";
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
                LEFT JOIN tb_item ON tb_item.item_barcode = tb_order_list.list_barcode
                WHERE tb_order_list.order_id IS NULL";
        global $mysqli; $obj = array();
        $res = $mysqli->query($sql);
        while($data = $res->fetch_assoc()) {
            $obj[] = $data;
        }
    return $obj;
    }

    public function getStock(){
        $sql = "SELECT * 
                FROM tb_item
                LEFT JOIN tb_item_unit ON tb_item_unit.unit_id = tb_item.item_unit";
        global $mysqli; $obj = array();
        $res = $mysqli->query($sql);
        while($data = $res->fetch_assoc()) {
            $obj[] = $data;
        }
    return $obj;
    }

    public function getUnit(){
        $sql = "SELECT * 
                FROM tb_item_unit";
        global $mysqli; $obj = array();
        $res = $mysqli->query($sql);
        while($data = $res->fetch_assoc()) {
            $obj[] = $data;
        }
    return $obj;
    }

    public function getDaily($dateNow){
        $sql = "SELECT * 
                FROM tb_order
                LEFT JOIN tb_order_list ON tb_order_list.order_id = tb_order.order_id 
                LEFT JOIN tb_item ON tb_item.item_barcode = tb_order_list.list_barcode 
                LEFT JOIN tb_item_unit ON tb_item_unit.unit_id = tb_item.item_unit
                WHERE SUBSTRING(tb_order.order_date,1,10) = '{$dateNow}'";
        global $mysqli; $obj = array();
        $res = $mysqli->query($sql);
        while($data = $res->fetch_assoc()) {
            $obj[] = $data;
        }
    return $obj;
    }
}

?>