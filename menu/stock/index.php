<?php $item = $fnc->getStock(); $unit = $fnc->getUnit(); $group = $fnc->getGroup(); $count_item = $fnc->countItem(); $count_order = $fnc->countOrderPoint(); $count_low = $fnc->countLowOrderPoint();?>
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
                        <i class="fa fa-cart-plus"></i> เพิ่มสินค้าใหม่
                    </button>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#sharedItem">
                        <i class="fa fa-retweet"></i> แบ่งสินค้าขาย
                    </button>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateItem">
                        <i class="fa fa-cart-arrow-down"></i> รับเข้าสินค้า
                    </button>
                    <a href="?menu=setGroup" class="btn btn-info btn-sm">
                        <i class="fa fa-sitemap"></i> ตั้งค่าหมวดหมู่สินค้า
                    </a>
                    <a href="?menu=setUnit" class="btn btn-info btn-sm">
                        <i class="fa fa-tasks"></i> ตั้งค่าหน่วยนับ
                    </a>
                </div>
            </div>
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
                        <td class="text-center"><?=DateTimeThai($it['item_update'])?></td>
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
                            <td>หมวดหมู่สินค้า</td>
                            <td>
                                <input list="group" name="group" class="form-control" required></label>
                                <datalist id="group">
                                    <?php foreach ($group as $un){ ?>
                                    <option value="<?=$un['group_id']." : ".$un['group_name']?>">
                                        <?php } ?>
                                </datalist>
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
                            <td>
                                <input type="number" name="stock" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>จุดสั่งซื้อ</td>
                            <td>
                                <input type="number" name="point" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนรับเข้า</td>
                            <td>
                                <input type="number" name="balance" class="form-control" placeholder="กรอกเฉพาะตัวเลข"
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

<!-- updateItem -->
<div class="modal fade" id="updateItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-cart-arrow-down"></i> รับเข้าสินค้า</h5>
            </div>
            <form id="updateItemStock">
                <div class="modal-body">
                    <table class="table table-bordered table-sm table-valign-middle" width="100%">
                        <tr>
                            <td>เลขที่บิล/ใบสั่งซื้อ</td>
                            <td>
                                <input type="text" name="bill" class="form-control"
                                    placeholder="ระบุเลขที่บิล/ใบสั่งซื้อ หากไม่มีให้ใส่ -" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">ค้นหาชื่อรายการสินค้า</td>
                            <td>
                                <input type="text" id="autoItem" name="autoItem" class="form-control"
                                    placeholder="พิมพ์ Keyword สินค้า" required>
                                <input type="hidden" id="autoID" name="autoID" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Barcode</td>
                            <td>
                                <input type="text" id="get_barcode" name="get_barcode" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>หน่วยนับ</td>
                            <td>
                                <input type="text" id="get_unit" name="get_unit" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนคงคลัง</td>
                            <td>
                                <input type="text" id="get_stock" name="get_stock" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนคงเหลือ</td>
                            <td>
                                <input type="text" id="get_balance" name="get_balance" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>จุดสั่งซื้อ</td>
                            <td>
                                <input type="text" id="get_orderpoint" name="get_orderpoint" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>ราคาซื้อ</td>
                            <td>
                                <input type="number" id="get_price" name="get_price" class="form-control"
                                    placeholder="กรอกเป็นตัวเลขจำนวนเต็มเท่านั้น">
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนรับเข้า</td>
                            <td>
                                <input type="number" id="get_instock" name="get_instock" class="form-control"
                                    placeholder="กรอกเป็นตัวเลขจำนวนเต็มเท่านั้น">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="empID" class="form-control" value="<?=$_SESSION['user']?>">
                    <button type="submit" id="btnUpdate" class="btn btn-success btn-sm"><i class="fa fa-save"></i>
                        บันทึกการรับเข้าสินค้า
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- sharedItem -->
<div class="modal fade" id="sharedItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-retweet"></i> แบ่งสินค้าขาย</h5>
            </div>
            <form id="sharedItemStock">
                <div class="modal-body">
                    <h6><i class="fa fa-share-square"></i> สินค้าที่ต้องการแบ่งขาย</h6>
                    <table class="table table-bordered table-sm table-valign-middle" width="100%">
                        <tr>
                            <td width="20%">รายการสินค้า</td>
                            <td>
                                <input type="text" id="itemName" name="itemName" class="form-control"
                                    placeholder="พิมพ์ Keyword สินค้าที่ต้องการแยกขาย" required>
                                <input type="hidden" id="itemID" name="itemID" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Barcode</td>
                            <td>
                                <input type="text" id="get_barcode2" name="get_barcode2" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวน</td>
                            <td>
                                <input type="text" id="get_balance2" name="get_balance2" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>หน่วยนับ</td>
                            <td>
                                <input type="text" id="get_unit2" name="get_unit2" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนที่ต้องการแบ่ง</td>
                            <td>
                                <input type="num" id="item_num1" name="item_num1" class="form-control"
                                    placeholder="จำนวนที่ต้องการแบ่ง">
                            </td>
                        </tr>
                    </table>
                    <h6><i class="fa fa-plus-square"></i> สินค้าที่ต้องการเพิ่ม</h6>
                    <table class="table table-bordered table-sm table-valign-middle" width="100%">
                        <tr>
                            <td width="20%">รายการสินค้า</td>
                            <td>
                                <input type="text" id="itemName2" name="itemName2" class="form-control"
                                    placeholder="พิมพ์ Keyword สินค้าที่ต้องการรับเข้า" required>
                                <input type="hidden" id="itemID2" name="itemID2" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Barcode</td>
                            <td>
                                <input type="text" id="get_barcode3" name="get_barcode3" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวน</td>
                            <td>
                                <input type="text" id="get_balance3" name="get_balance3" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>หน่วยนับ</td>
                            <td>
                                <input type="text" id="get_unit3" name="get_unit3" class="form-control"
                                    placeholder="auto fill" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>จำนวนที่รับเข้า</td>
                            <td>
                                <input type="num" id="item_num2" name="item_num2" class="form-control"
                                    placeholder="จำนวนที่รับเข้า">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="empID" class="form-control" value="<?=$_SESSION['user']?>">
                    <button type="submit" id="btnShared" class="btn btn-success btn-sm"><i class="fa fa-save"></i>
                        บันทึกการแบ่งสินค้า
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editItem" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="font-size:14px;">
        <div id="ajaxEdit">
            <!-- เรียกใช้งานผ่าน ajax -->
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

$('#updateItemStock').on("submit", function(event) {
    event.preventDefault();
    swal({
            title: "ยืนยันการรับเข้ารายการสินค้า ?",
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((createCnf) => {
            if (createCnf) {
                document.getElementById("btnUpdate").disabled = true;
                $.ajax({
                    url: "menu/stock/query.php?op=updateItem",
                    method: "POST",
                    data: $('#updateItemStock').serialize(),
                    success: function(data) {
                        swal('บันทึกข้อมูลแล้ว',
                            'Update item Success',
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

$('#sharedItemStock').on("submit", function(event) {
    event.preventDefault();
    swal({
            title: "ยืนยันการแบ่งขายรายการสินค้า ?",
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((createCnf) => {
            if (createCnf) {
                document.getElementById("btnShared").disabled = true;
                $.ajax({
                    url: "menu/stock/query.php?op=sharedItem",
                    method: "POST",
                    data: $('#sharedItemStock').serialize(),
                    success: function(data) {
                        swal('บันทึกข้อมูลแล้ว',
                            'Update item Success',
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

$('.ajaxItem').click(function() {
    var id = $(this).attr('data-id');
    $.ajax({
        url: "menu/stock/edit.php?id=" + id,
        cache: false,
        success: function(result) {
            $('#ajaxEdit').html(result);
        }
    });
});

function make_autocom(autoObj, showObj) {
    var mkAutoObj = autoObj;
    var mkSerValObj = showObj;
    new Autocomplete(mkAutoObj, function() {
        this.setValue = function(id) {
            document.getElementById(mkSerValObj).value = id;
            if (id != "") {
                $.post("menu/stock/json_item_fill.php", {
                    id: id
                }, function(data) {
                    if (data != null && data.length > 0) {
                        $("#get_barcode").val(data[0].barcode);
                        $("#get_unit").val(data[0].unit);
                        $("#get_stock").val(data[0].stock);
                        $("#get_balance").val(data[0].balance);
                        $("#get_orderpoint").val(data[0].orderpoint);
                    }
                });
            } else {
                $("#get_barcode").val("");
                $("#get_unit").val("");
                $("#get_stock").val("");
                $("#get_balance").val("");
                $("#get_orderpoint").val("");
            }
        }
        if (this.isModified)
            this.setValue("");
        if (this.value.length < 1 && this.isNotClick)
            return;
        return "menu/stock/json_item_take.php?q=" + encodeURIComponent(this.value);
    });
}
make_autocom("autoItem", "autoID");

function make_autocom2(autoObj, showObj) {
    var mkAutoObj = autoObj;
    var mkSerValObj = showObj;
    new Autocomplete(mkAutoObj, function() {
        this.setValue = function(id) {
            document.getElementById(mkSerValObj).value = id;
            if (id != "") {
                $.post("menu/stock/json_item_fill.php", {
                    id: id
                }, function(data) {
                    if (data != null && data.length > 0) {
                        $("#get_barcode2").val(data[0].barcode);
                        $("#get_unit2").val(data[0].unit);
                        $("#get_balance2").val(data[0].balance);
                    }
                });
            } else {
                $("#get_barcode2").val("");
                $("#get_unit2").val("");
                $("#get_balance2").val("");
            }
        }
        if (this.isModified)
            this.setValue("");
        if (this.value.length < 1 && this.isNotClick)
            return;
        return "menu/stock/json_item_take.php?q=" + encodeURIComponent(this.value);
    });
}
make_autocom2("itemName", "itemID");

function make_autocom3(autoObj, showObj) {
    var mkAutoObj = autoObj;
    var mkSerValObj = showObj;
    new Autocomplete(mkAutoObj, function() {
        this.setValue = function(id) {
            document.getElementById(mkSerValObj).value = id;
            if (id != "") {
                $.post("menu/stock/json_item_fill.php", {
                    id: id
                }, function(data) {
                    if (data != null && data.length > 0) {
                        $("#get_barcode3").val(data[0].barcode);
                        $("#get_unit3").val(data[0].unit);
                        $("#get_balance3").val(data[0].balance);
                    }
                });
            } else {
                $("#get_barcode3").val("");
                $("#get_unit3").val("");
                $("#get_balance3").val("");
            }
        }
        if (this.isModified)
            this.setValue("");
        if (this.value.length < 1 && this.isNotClick)
            return;
        return "menu/stock/json_item_take.php?q=" + encodeURIComponent(this.value);
    });
}
make_autocom3("itemName2", "itemID2");
</script>