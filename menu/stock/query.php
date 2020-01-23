<?php
date_default_timezone_set("Asia/Bangkok");
include ('../../config/database.php');
include ('../../class/sql.class.php');
include ('../../class/data.class.php');

$fnc = new pos();
$mysqli = connect();
$op = $_REQUEST['op'];

if($op == 'addItem'){
    $name = mysqli_real_escape_string($mysqli,$_REQUEST['name']);
    $price = mysqli_real_escape_string($mysqli,$_REQUEST['price']);
    $stock = mysqli_real_escape_string($mysqli,$_REQUEST['stock']);
    $point = mysqli_real_escape_string($mysqli,$_REQUEST['point']);
    $balance = mysqli_real_escape_string($mysqli,$_REQUEST['balance']);
    $barcode = mysqli_real_escape_string($mysqli,$_REQUEST['barcode']);
    $unit = substr($_REQUEST['unit'],0,3);
    $now = date('Y-m-d H:i:s');
    $data = array(
        "item_name"=>$name,
        "item_price"=>$price,
        "item_unit"=>$unit,
        "item_stock"=>$stock,
        "item_orderpoint"=>$point,
        "item_balance"=>$balance,
        "item_barcode"=>$barcode,
        "item_date"=>$now,
        "item_update"=>$now
    );
    insertSQL("tb_item",$data);
}

if($op == 'addUnit'){
    $name = mysqli_real_escape_string($mysqli,$_REQUEST['name']);
    $data = array(
        "unit_name"=>$name
    );
    insertSQL("tb_item_unit",$data);
}

if($op == 'delUnit'){
    $id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
    deleteSQL("tb_item_unit","unit_id=$id");
    $sql = "ALTER TABLE tb_item_unit AUTO_INCREMENT = 1";
    $mysqli->query($sql);
    header('Location: ../../?menu=setUnit');
}

if($op == 'editItem'){
    $id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
    $name = mysqli_real_escape_string($mysqli,$_REQUEST['name']);
    $price = mysqli_real_escape_string($mysqli,$_REQUEST['price']);
    $stock = mysqli_real_escape_string($mysqli,$_REQUEST['stock']);
    $point = mysqli_real_escape_string($mysqli,$_REQUEST['point']);
    $balance = mysqli_real_escape_string($mysqli,$_REQUEST['balance']);
    $barcode = mysqli_real_escape_string($mysqli,$_REQUEST['barcode']);
    $unit = mysqli_real_escape_string($mysqli,$_REQUEST['unit']);
    $now = date('Y-m-d H:i:s');
    $data = array(
        "item_name"=>$name,
        "item_price"=>$price,
        "item_unit"=>$unit,
        "item_stock"=>$stock,
        "item_orderpoint"=>$point,
        "item_balance"=>$balance,
        "item_barcode"=>$barcode,
        "item_update"=>$now
    );
    updateSQL("tb_item",$data,"item_id=$id");
}

if($op == 'updateItem'){
    $bill = mysqli_real_escape_string($mysqli,$_REQUEST['bill']);
    $item = mysqli_real_escape_string($mysqli,$_REQUEST['autoID']);
    $amount = mysqli_real_escape_string($mysqli,$_REQUEST['get_instock']);
    $data = array(
        "receive_item"=>$item,
        "receive_bill"=>$bill,
        "receive_amount"=>$amount
    );
    insertSQL("tb_item_receive",$data);
    // Update Stock Balance
    $now = date('Y-m-d H:i:s');
    $data = array(
        "item_balance"=>$amount,
        "item_update"=>$now
    );
    updateSQL("tb_item",$data,"item_id=$item");
}
?>