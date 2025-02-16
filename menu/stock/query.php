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
    $group = substr($_REQUEST['group'],0,3);
    $now = date('Y-m-d H:i:s');
    $data = array(
        "item_name"=>$name,
        "item_price"=>$price,
        "item_unit"=>$unit,
        "item_group"=>$group,
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

if($op == 'addGroup'){
    $name = mysqli_real_escape_string($mysqli,$_REQUEST['name']);
    $data = array(
        "group_name"=>$name
    );
    insertSQL("tb_item_group",$data);
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
    $group = mysqli_real_escape_string($mysqli,$_REQUEST['group']);
    $now = date('Y-m-d H:i:s');
    $data = array(
        "item_name"=>$name,
        "item_price"=>$price,
        "item_unit"=>$unit,
        "item_group"=>$group,
        "item_stock"=>$stock,
        "item_orderpoint"=>$point,
        "item_balance"=>$balance,
        "item_barcode"=>$barcode,
        "item_update"=>$now
    );
    updateSQL("tb_item",$data,"item_id=$id");
}

if($op == 'updateItem'){
    $emp = mysqli_real_escape_string($mysqli,$_REQUEST['empID']);
    $bill = mysqli_real_escape_string($mysqli,$_REQUEST['bill']);
    $item = mysqli_real_escape_string($mysqli,$_REQUEST['autoID']);
    $amount = mysqli_real_escape_string($mysqli,$_REQUEST['get_instock']);
    $price = mysqli_real_escape_string($mysqli,$_REQUEST['get_price']);
    $data = array(
        "receive_item"=>$item,
        "receive_bill"=>$bill,
        "receive_price"=>$price,
        "receive_amount"=>$amount,
        "receive_emp"=>$emp
    );
    insertSQL("tb_item_receive",$data);
    // Update Stock Balance
    $box = $fnc->editItem($item);
    $total = $amount + $box['item_balance'];
    $now = date('Y-m-d H:i:s');
    $data = array(
        "item_balance"=>$total,
        "item_update"=>$now
    );
    updateSQL("tb_item",$data,"item_id=$item");
}

if($op == 'sharedItem'){
    $emp = mysqli_real_escape_string($mysqli,$_REQUEST['empID']);
    $item1 = mysqli_real_escape_string($mysqli,$_REQUEST['itemID']);
    $item2 = mysqli_real_escape_string($mysqli,$_REQUEST['itemID2']);
    $item_num1 = mysqli_real_escape_string($mysqli,$_REQUEST['item_num1']);
    $item_num2 = mysqli_real_escape_string($mysqli,$_REQUEST['item_num2']);
    $data = array(
        "shared_item_main"=>$item1,
        "shared_item_sub"=>$item2,
        "shared_item_main_num"=>$item_num1,
        "shared_item_sub_num"=>$item_num2,
        "shared_emp"=>$emp
    );
    insertSQL("tb_item_shared",$data);
    // Update Stock Balance
    $box = $fnc->editItem($item1);
    $total = $box['item_balance'] - $item_num1;
    $now = date('Y-m-d H:i:s');
    $data = array(
        "item_balance"=>$total,
        "item_update"=>$now
    );
    updateSQL("tb_item",$data,"item_id=$item1");
    // Update Stock Balance
    $box2 = $fnc->editItem($item2);
    $total2 = $box2['item_balance'] + $item_num2;
    $now2 = date('Y-m-d H:i:s');
    $data = array(
        "item_balance"=>$total2,
        "item_update"=>$now2
    );
    updateSQL("tb_item",$data,"item_id=$item2");
}
?>