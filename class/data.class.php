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

    public function editItem($id){
        $sql = "SELECT *
                FROM tb_item
                LEFT JOIN tb_item_unit ON tb_item_unit.unit_id = tb_item.item_unit 
                WHERE item_id = '{$id}'";
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
                LEFT JOIN tb_employee ON tb_employee.emp_id = tb_order.emp_id
                WHERE SUBSTRING(tb_order.order_date,1,10) = '{$dateNow}'";
        global $mysqli; $obj = array();
        $res = $mysqli->query($sql);
        while($data = $res->fetch_assoc()) {
            $obj[] = $data;
        }
    return $obj;
    }
    
    public function getChartOrder(){
        $sql = "SELECT
                YEAR(`order_date`) AS `year`,
                SUM(IF(MONTH(`order_date`)=1,`order_income`,NULL)) AS `1`,
                SUM(IF(MONTH(`order_date`)=2,`order_income`,NULL)) AS `2`,
                SUM(IF(MONTH(`order_date`)=3,`order_income`,NULL)) AS `3`,
                SUM(IF(MONTH(`order_date`)=4,`order_income`,NULL)) AS `4`,
                SUM(IF(MONTH(`order_date`)=5,`order_income`,NULL)) AS `5`,
                SUM(IF(MONTH(`order_date`)=6,`order_income`,NULL)) AS `6`,
                SUM(IF(MONTH(`order_date`)=7,`order_income`,NULL)) AS `7`,
                SUM(IF(MONTH(`order_date`)=8,`order_income`,NULL)) AS `8`,
                SUM(IF(MONTH(`order_date`)=9,`order_income`,NULL)) AS `9`,
                SUM(IF(MONTH(`order_date`)=10,`order_income`,NULL)) AS `10`,
                SUM(IF(MONTH(`order_date`)=11,`order_income`,NULL)) AS `11`,
                SUM(IF(MONTH(`order_date`)=12,`order_income`,NULL)) AS `12`
                FROM `tb_order`
                GROUP BY `year`";
        global $mysqli;
        $res = $mysqli->query($sql);
        $data = $res->fetch_assoc();
    return $data;
    }

}

?>