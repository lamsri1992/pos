<?php $cart = $fnc->getCart(); foreach ($cart as $ct){ $total += $ct['item_price']*$ct['list_qty'];} if(empty($cart)){$cal="disabled";}else{$cal="";}?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-cash-register"></i> Cashier / ระบบขายหน้าร้าน</h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form id="addCart">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="number" name="qty" class="form-control"
                                style="font-size:35px;color:white;background-color:black;font-weight:bold;"
                                placeholder="จำนวน" autofocus required min="1">
                        </div>
                        <div class="col-md-4 input-group mb-4">
                            <input type="text" name="barcode" class="form-control"
                                style="font-size:35px;color:white;background-color:black;font-weight:bold;"
                                placeholder="BARCODE SCAN" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span style="font-size:35px;" class="fas fa-search"></span>
                                </div>
                            </div>
                        </div>
                        <input hidden type="text" name="empID" value="<?=$empSession['emp_id']?>">
                        <input hidden type="submit">
                </form>
                <div class="col-3">
                    <input type="text" name="amount" class="form-control text-center"
                        style="font-size:35px;color:yellow;background-color:gray;font-weight:bold;"
                        value="<?=number_format($total,2)?>" readonly>
                </div>
                <div class="col-3">
                    <button href="#" id="pressChk" class="ajaxModal btn btn-success btn-block" style="font-size:35px;"
                        data-target="#CheckOut" data-toggle="modal" <?=$cal?>>
                        <i class="fa fa-calculator"></i> คิดเงิน (F5)
                    </button>
                </div>
                <table class="table table-hover table-valign-middle table-sm" style="font-size:20px;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th><i class="fa fa-barcode"></i> Barcode</th>
                            <th>รายการสินค้า</th>
                            <th class="text-center">ราคา</th>
                            <th class="text-center">จำนวน</th>
                            <th class="text-center">ยอดรวม</th>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i=0; foreach ($cart as $ct){ $i++;
                            $total += $ct['item_price']*$ct['list_qty'];
                        ?>
                        <tr>
                            <td class="text-center"><?=$i?></td>
                            <td><?=$ct['item_barcode']?></td>
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
                            <td width="10%" class="text-center">
                                <input type="text" class="form-control text-center"
                                    value="<?=number_format($ct['item_price']*$ct['list_qty'],2)?>"
                                    style="color:blue;font-weight:bold;" readonly>
                            </td>
                            <td class="text-center">
                                <a href="menu/sale/query.php?op=delCart&id=<?=$ct['list_id']?>&barcode=<?=$ct['item_barcode']?>&qty=<?=$ct['list_qty']?>"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="alert alert-secondary alert-dismissible fade show text-center" role="alert">
            <small>
                <strong>* โปรดอ่าน *</strong>
                หากสแกนรหัส Barcode แล้วไม่มีรายการสินค้า ให้ท่านตรวจสอบรหัส Barcode ในระบบบริหารคลังสินค้า
            </small>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</section>
<!-- Modal More Leave -->
<div class="modal fade" id="CheckOut" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div id="ajaxReceipt">
            <!-- เรียกใช้งานผ่าน ajax -->
        </div>
    </div>
</div>
<script>
$('#addCart').on("submit", function(event) {
    event.preventDefault();
    $.ajax({
        url: "menu/sale/query.php?op=addCart",
        method: "POST",
        data: $('#addCart').serialize(),
        success: function(data) {
            window.setTimeout(function() {
                location.replace('?menu=sale')
            });
        }
    });
});

document.onkeydown = fkey;
document.onkeypress = fkey
document.onkeyup = fkey;

function fkey(e) {

    if (e.keyCode == 116) {
        e.preventDefault();
        $('#pressChk').click();
    }
}

$('.ajaxModal').click(function() {
    $.ajax({
        url: "menu/sale/receipt.php",
        cache: false,
        success: function(result) {
            $('#ajaxReceipt').html(result);
        }
    });
});
</script>