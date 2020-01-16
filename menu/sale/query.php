<?php
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
    $data = array(
        "list_qty"=>$qty,
        "list_barcode"=>$item
    );
    insertSQL("tb_order_list",$data);
}

if($op == 'delCart'){
    $id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
    deleteSQL("tb_order_list","list_id=$id");
    header('Location: ../../?menu=sale');
}
?>