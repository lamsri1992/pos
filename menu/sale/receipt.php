<?php
session_start();
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
        <small>กดปุ่ม ESC เพื่อปิดหน้าต่าง</small>
    </div>
    <form id="saveBill">
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
                            <span style="font-weight:bold;">
                                <?=number_format($ct['item_price']*$ct['list_qty'],2)?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4">
                            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="cash-pill" data-toggle="pill" href="#cash" role="tab"
                                        aria-controls="pills-home" aria-selected="true">
                                        ลูกค้าเงินสด (F1)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="credit-pill" data-toggle="pill" href="#credit" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">
                                        ลูกค้าสินเชื่อ (F2)
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="cash" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table table-valign-middle table-sm">
                        <tr>
                            <td class="text-right" colspan="2">
                                <span span style="color:black;font-size:20px;font-weight:bold;">
                                    ส่วนลด
                                </span>
                            </td>
                            <td colspan="2">
                                <input type="number" id="discount" name="discount" onchange="dsum()"
                                    class="form-control text-center"
                                    style="color:purple;font-size:20px;font-weight:bold;" value="0" max="<?=$total?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="2">
                                <span span style="color:black;font-size:20px;font-weight:bold;">
                                    รวมทั้งหมด
                                </span>
                            </td>
                            <td colspan="2">
                                <input type="number" id="total" name="total" class="form-control text-center"
                                    value="<?=$total?>" style="color:red;font-size:20px;font-weight:bold;" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="2">
                                <span style="color:black;font-size:20px;font-weight:bold;">
                                    จำนวนเงินที่รับมา
                                </span>
                            </td>
                            <td colspan="2">
                                <input type="number" id="receive" onfocus="sum()" onblur="sum()" onchange="sum()"
                                    onkeyup="sum()" class="form-control text-center"
                                    style="color:blue;font-size:20px;font-weight:bold;">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="2">
                                <span style="color:black;font-size:20px;font-weight:bold;">
                                    เงินทอน
                                </span>
                            </td>
                            <td colspan="2">
                                <input type="number" id="change" onchange="sum()" class="form-control text-center"
                                    style="color:green;font-size:20px;font-weight:bold;" value="0" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <!-- radio -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="payment" id="radioSuccess1" value="cash">
                                            <label for="radioSuccess1" style="font-size:20px;">
                                                ชำระเงินสด
                                            </label>
                                        </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="payment" id="radioSuccess2" value="qrcode">
                                            <label for="radioSuccess2" style="font-size:20px;">
                                                ชำระผ่าน QR CODE
                                            </label>
                                        </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="payment" id="radioSuccess3" value="owner">
                                            <label for="radioSuccess3" style="font-size:20px;">
                                                จำหน่ายเอง
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="table table-valign-middle table-sm">
                        <tr>
                            <td class="text-right" colspan="2">
                                <span span style="color:black;font-size:20px;font-weight:bold;">
                                    รวมทั้งหมด
                                </span>
                            </td>
                            <td colspan="2">
                                <input type="number" id="cretotal" name="cretotal" class="form-control text-center"
                                    value="<?=$total?>" style="color:red;font-size:20px;font-weight:bold;" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="2">
                                <span style="color:black;font-size:20px;font-weight:bold;">
                                    ลูกค้าสินเชื่อ
                                </span>
                            </td>
                            <td colspan="2">
                                <input type="text" id="credit" name="credit" class="form-control text-center"
                                    placeholder="ระบุชื่อลูกค้าสินเชื่อ"
                                    style="color:black;font-size:20px;font-weight:bold;">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input hidden type="text" name="empID" value="<?=$_SESSION['user']?>">
            <button id="btnSave" type="submit" class="btn btn-success btn-block btn-lg"><i class="fa fa-save"></i>
                บันทึกรายการขาย (Press ENTER)
            </button>
        </div>
    </form>
</div>


<script>
// Calculate
var obj = document.all;

function dsum() {
    obj.total.value = parseInt(obj.total.value) - parseInt(obj.discount.value);
}

function sum() {
    obj.change.value = parseInt(obj.receive.value) - parseInt(obj.total.value);
}

$('#saveBill').on("submit", function(event) {
    event.preventDefault();
    document.getElementById("btnSave").disabled = true;
    $.ajax({
        url: "menu/sale/query.php?op=endCart",
        method: "POST",
        data: $('#saveBill').serialize(),
        success: function(data) {
            swal('บันทึกการขายแล้ว',
                'Order Save Success',
                'success', {
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    buttons: false,
                    timer: 1900,
                });
            window.setTimeout(function() {
                location.replace('?menu=sale')
            }, 2000);
        }
    });
});
</script>