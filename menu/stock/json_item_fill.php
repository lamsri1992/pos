<?php 
header("Content-type:application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);     

include ('../../config/database.php');
$mysqli = connect();
    $sql = "SELECT *
    FROM tb_item
    LEFT JOIN tb_item_unit ON tb_item_unit.unit_id = tb_item.item_unit 
    WHERE item_id = '".$_POST['id']."'";
    global $mysqli; 
    $result = $mysqli->query($sql);
    
if($result && $result->num_rows > 0){
    $row = $result->fetch_assoc();
    $data_json[] = array(
        "barcode" => $row['item_barcode'],
        "unit" => $row['unit_name'],
        "stock" => $row['item_stock'],
        "balance" => $row['item_balance'],
        "orderpoint" => $row['item_orderpoint']);
}

if(isset($data_json)){  
    $json= json_encode($data_json);    
    if(isset($_GET['callback']) && $_GET['callback']!=""){    
    echo $_GET['callback']."(".$json.");";        
    }else{    
    echo $json;    
    }    
}
?>