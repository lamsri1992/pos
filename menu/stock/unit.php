<?php $item = $fnc->getStock(); $unit = $fnc->getUnit(); $count_item = $fnc->countItem(); $count_order = $fnc->countOrderPoint(); $count_low = $fnc->countLowOrderPoint();?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-b ox-open"></i> ระบบบริหารคลังสินค้า</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-store"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">จำนวนสินค้าทั้งหมด</span>
                            <span class="info-box-number"><?=$count_item['num']?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-clipboard-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">สินค้าถึงจุดสั่งซื้อ</span>
                            <span class="info-box-number"><?=$count_order['num']?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fa fa-sort-amount-down"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">สินค้าต่ำกว่าจุดสั่งซื้อ</span>
                            <span class="info-box-number"><?=$count_low['num']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addItem">
                        <i class="fa fa-plus-circle"></i> เพิ่มหน่วยนับ
                    </button>
                </div>
            </div>
            <table id="itemData" class="table table-sm table-hover compact" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="">รายการ</th>
                        <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($unit as $it){ ?>
                    <tr>
                        <td class="text-center"><?=$it['unit_id']?></td>
                        <td class=""><?=$it['unit_name']?></td>
                        <td class="text-center" width="10%">
                            <a href="#" class="ajaxUnit badge badge-success" data-target="#editItem" data-toggle="modal"
                                data-id="<?=$it['item_id']?>">
                                <i class="fa fa-edit"></i> แก้ไข
                            </a>
                            <a href="menu/stock/query.php?op=delUnit&id=<?=$it['unit_id']?>" class="badge badge-danger"
                                onclick="return confirm('ยืนยันการลบหน่วยนับ <?=$it['unit_name']?> ?\nหากลบข้อมูลหน่วยนับ อาจส่งผลต่อระบบคลังบางส่วน')">
                                <i class="fa fa-trash-alt"></i> ลบ
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- addItem -->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-cart-plus"></i> เพิ่มสินค้าใหม่</h5>
            </div>
            <form id="addItemNew">
                <div class="modal-body">
                    <table class="table table-bordered table-sm table-valign-middle" width="100%">
                        <tr>
                            <td width="20%">ชื่อหน่วยนับ</td>
                            <td>
                                <input type="text" name="name" class="form-control" placeholder="ระบุชื่อหน่วยนับ" required>
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
            title: "ยืนยันการเพิ่มหน่วยนับ ?",
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((createCnf) => {
            if (createCnf) {
                document.getElementById("btnSave").disabled = true;
                $.ajax({
                    url: "menu/stock/query.php?op=addUnit",
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
                            location.replace('?menu=setUnit')
                        }, 1500);
                    }
                });
            }
        });
});
</script>