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
?>