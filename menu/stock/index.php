<?php $item = $fnc->getStock(); $unit = $fnc->getUnit();?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-box-open"></i> ระบบบริหารคลังสินค้า</h3>
        </div>
        <div class="card-body">
            <table id="itemData" class="table table-sm table-hover compact" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class=""><i class="fa fa-barcode"></i> Barcode</th>
                        <th class="">รายการ</th>
                        <th class="text-center">คงเหลือ</th>
                        <th class="text-center">หน่วยนับ</th>
                        <th class="text-right">ราคา</th>
                        <th class="text-center">อัพเดตล่าสุด</th>
                        <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($item as $it){ 
                        if($it['item_balance']<=$it['item_orderpoint']){ 
                            $orderpoint="<span class='badge badge-danger'><i class='fa fa-exclamation-circle'></i> ใกล้หมด</span>";
                        }else{$orderpoint="";} ?>
                    <tr>
                        <td class="text-center"><?=$it['item_id']?></td>
                        <td class=""><?=$it['item_barcode']?></td>
                        <td class=""><?=$it['item_name']." ".$orderpoint?></td>
                        <td class="text-center"><?=$it['item_balance']?></td>
                        <td class="text-center"><?=$it['unit_name']?></td>
                        <td class="text-right"><?=number_format($it['item_price'],2)?></td>
                        <td class="text-center"><?=DateTimeThai($it['item_date'])?></td>
                        <td class="text-center">
                            <a href="#" class="ajaxItem badge badge-success" data-target="#editItem" data-toggle="modal"
                                data-id="<?=$it['item_id']?>">
                                <i class="fa fa-edit"></i> แก้ไข
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-right">
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addItem">
                <i class="fa fa-cart-plus"></i> เพิ่มสินค้าใหม่
            </button>
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateItem">
                <i class="fa fa-cart-arrow-down"></i> รับเข้าสินค้า
            </button>
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#">
                <i class="fa fa-tasks"></i> จัดการหน่วยนับ
            </button>
        </div>
    </div>
</section>

<!-- addItem -->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-cart-plus"></i> เพิ่มสินค้าใหม่</h5>
            </div>
            <form id="addItemNew">
                <div class="modal-body">
                    <table class="table table-bordered table-sm table-valign-middle" width="100%">
                        <tr>
                            <td width="20%">รายการ</td>
                            <td>
                                <input type="text" name="name" class="form-control" placeholder="ชื่อสินค้า" required>
                            </td>
                        </tr>
                        <tr>
                            <td>ราคาขาย/หน่วย</td>
                            <td>
                                <input type="number" name="price" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>หน่วยนับ</td>
                            <td>
                                <input list="unit" name="unit" class="form-control" required></label>
                                <datalist id="unit">
                                    <?php foreach ($unit as $un){ ?>
                                    <option value="<?=$un['unit_id']." : ".$un['unit_name']?>">
                                        <?php } ?>
                                </datalist>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนคงคลัง</td>
                            <td><input type="number" name="stock" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>จุดสั่งซื้อ</td>
                            <td><input type="number" name="point" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนรับเข้า</td>
                            <td><input type="number" name="balance" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>Barcode</td>
                            <td>
                                <input type="text" name="barcode" class="form-control"
                                    placeholder="สแกนบาร์โค้ดจากสินค้า" required>
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
</div>

<script>
$('#addItemNew').on("submit", function(event) {
    event.preventDefault();
    swal({
            title: "ยืนยันการเพิ่มรายการใหม่ ?",
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((createCnf) => {
            if (createCnf) {
                document.getElementById("btnSave").disabled = true;
                $.ajax({
                    url: "menu/stock/query.php?op=addItem",
                    method: "POST",
                    data: $('#addItemNew').serialize(),
                    success: function(data) {
                        swal('บันทึกข้อมูลแล้ว',
                            'Add new item Success',
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