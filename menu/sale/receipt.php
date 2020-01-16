<?php
include ('../../config/database.php');
include ('../../class/data.class.php');
include ('../../class/date.class.php');

$mysqli = connect();
$fnc = new pos();
$cart = $fnc->getCart();
?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">CheckOut Cart : ยืนยันการขายสินค้า</h5>
    </div>
    <div class="modal-body">
        <table class="table table-valign-middle table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>รายการสินค้า</th>
                    <th class="text-center">ราคา</th>
                    <th class="text-center">จำนวน</th>
                    <th class="text-center">ยอดรวม</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $ct){ @$total += $ct['item_price']*$ct['list_qty'];?>
                <tr>
                    <td><?=$ct['item_name']?></td>
                    <td class="text-center">
                        <span style="font-weight:bold;">
                            <?=number_format($ct['item_price'],2)?>
                        </span>
                    </td>
                    <td class="text-center">
                        <span style="font-weight:bold;">
                            <?=$ct['list_qty']?>
                        </span>
                    </td>
                    <td width="15%" class="text-center">
                        <input type="text" class="form-control text-center"
                            value="<?=number_format($ct['item_price']*$ct['list_qty'],2)?>"
                            style="color:blue;font-weight:bold;" readonly>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="text-right" colspan="2">
                        <span span style="color:black;font-size:30px;font-weight:bold;">
                            รวมทั้งหมด
                        </span>
                    </td>
                    <td colspan="2">
                        <input type="number" id="total" class="form-control text-center" value="<?=$total?>"
                            style="color:red;font-size:40px;font-weight:bold;" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" colspan="2">
                        <span style="color:black;font-size:30px;font-weight:bold;">
                            จำนวนเงินที่รับมา
                        </span>
                    </td>
                    <td colspan="2">
                        <input type="number" id="receive" onfocus="sum()" onblur="sum()" onchange="sum()" onkeyup="sum()" class="form-control text-center"
                            style="color:blue;font-size:40px;font-weight:bold;">
                    </td>
                </tr>
                <tr>
                    <td class="text-right" colspan="2">
                        <span style="color:black;font-size:30px;font-weight:bold;">
                            เงินทอน
                        </span>
                    </td>
                    <td colspan="2">
                        <input type="number" id="change" onfocus="sum()" onblur="sum()" onchange="sum()" onkeyup="sum()" class="form-control text-center"
                            style="color:green;font-size:40px;font-weight:bold;" readonly>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success"><i class="fa fa-save"></i> บันทึกรายการขาย</button>
    </div>
</div>

<script>
var obj= document.all;
function sum(){
	obj.change.value=parseInt(obj.receive.value)-parseInt(obj.total.value);
}
</script>