<?php
include ('../../config/database.php');
include ('../../class/data.class.php');
include ('../../class/date.class.php');

$mysqli = connect();
$fnc = new pos();
$id = $_REQUEST['id'];
$data = $fnc->editItem($id);
$unit = $fnc->getUnit();
?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขข้อมูลสินค้า : <i class="fa fa-barcode"></i>
            <?=$data['item_barcode']." / ".$data['item_name']?>
        </h5>
    </div>
    <div class="modal-body">
        <form id="frmEdit">
            <div class="modal-body">
                <table class="table table-bordered table-sm table-valign-middle" width="100%">
                    <tr>
                        <td width="20%">รายการ</td>
                        <td>
                            <input type="text" name="name" class="form-control" placeholder="ชื่อสินค้า"
                                value="<?=$data['item_name']?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>ราคาขาย/หน่วย</td>
                        <td>
                            <input type="number" name="price" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                value="<?=$data['item_price']?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>หน่วยนับ</td>
                        <td>
                            <select name="unit" class="form-control input-md" required>
                                <?php foreach ($unit AS $ds){ ?>
                                <option value="<?=$ds['unit_id']?>" <?php
                                    if ($data['item_unit']==$ds['unit_id']){ echo 'SELECTED'; } ?>>
                                    <?=$ds['unit_name']?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>จำนวนคงคลัง</td>
                        <td>
                            <input type="number" name="stock" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                value="<?=$data['item_stock']?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>จุดสั่งซื้อ</td>
                        <td>
                            <input type="number" name="point" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                value="<?=$data['item_orderpoint']?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>จำนวนคงเหลือ</td>
                        <td>
                            <input type="number" name="balance" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                value="<?=$data['item_balance']?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Barcode</td>
                        <td>
                            <input type="text" name="barcode" class="form-control" placeholder="สแกนบาร์โค้ดจากสินค้า"
                                value="<?=$data['item_barcode']?>" required>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-success btn-sm"><i class="fa fa-save"></i>
                    บันทึกรายการ
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </form>
    </div>
</div>

<script>
// Edit Employee Data
$('#frmEdit').on("submit", function(event) {
    event.preventDefault();
    swal({
            title: "แก้ไขข้อมูล ?",
            text: "ยืนยันแก้ไขข้อมูลของ <?=$data['item_barcode'].": ".$data['item_name']?>",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((createCnf) => {
            if (createCnf) {
                $.ajax({
                    url: "menu/stock/query.php?op=editItem&id=<?=$data['item_id']?>",
                    method: "POST",
                    data: $('#frmEdit').serialize(),
                    success: function(data) {
                        swal('แก้ไขข้อมูลแล้ว',
                            'Item has been save',
                            'success', {
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                                buttons: false,
                                timer: 1000,
                            });
                        window.setTimeout(function() {
                            location.replace('?menu=stock')
                        }, 1500);
                    }
                });
            }
        });
});
</script>