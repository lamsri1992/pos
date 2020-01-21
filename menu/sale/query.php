<?php
session_start();
include ('../../config/database.php');
include ('../../class/sql.class.php');
include ('../../class/data.class.php');

$fnc = new pos();
$mysqli = connect();
$op = $_REQUEST['op'];

if($op == 'addCart'){
    $id = mysqli_real_escape_string($mysqli,$_REQUEST['empID']);
    $qty = mysqli_real_escape_string($mysqli,$_REQUEST['qty']);
    $item = mysqli_real_escape_string($mysqli,$_REQUEST['barcode']);
    $getItem = $fnc->getItem($item);
    if (isset($getItem['item_barcode'])){
        $data = array(
            "list_qty"=>$qty,
            "list_barcode"=>$item
        );
        insertSQL("tb_order_list",$data);
        // Update Stock
        $balance = $getItem['item_balance']-$qty;
        $data = array(
            "item_balance"=>$balance
        );
        updateSQL("tb_item",$data,"item_barcode=$item");
    }
}

if($op == 'delCart'){
    $id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
    $qty = mysqli_real_escape_string($mysqli,$_REQUEST['qty']);
    $item = mysqli_real_escape_string($mysqli,$_REQUEST['barcode']);
    // Delete List Order
    deleteSQL("tb_order_list","list_id=$id");
    // Update Stock When Delete Order List
    $getItem = $fnc->getItem($item);
    $balance = $getItem['item_balance']+$qty;
    $data = array(
        "item_balance"=>$balance
    );
    updateSQL("tb_item",$data,"item_barcode=$item");
    header('Location: ../../?menu=sale');
}

if($op == 'endCart'){
    $id = mysqli_real_escape_string($mysqli,$_REQUEST['empID']);
    $total = mysqli_real_escape_string($mysqli,$_REQUEST['total']);
    $data = array(
        "emp_id"=>$id,
        "order_income"=>$total
    );
    insertSQL("tb_order",$data);
    // Get Last OrderID
    $last_id = $fnc->getLastOrder();
    // Update OrderListID
    $data = array(
        "order_id"=>$last_id['last_id']
    );
    updateSQL("tb_order_list",$data,"order_id IS NULL");
}

?>