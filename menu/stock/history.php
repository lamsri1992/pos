<?php $item = $fnc->getReceive(); ?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-history"></i> ประวัติการรับสินค้าเข้า</h3>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#">
                    <i class="fa fa-calendar"></i> ค้นหาตามช่วงเวลา
                </button>
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#">
                    <i class="fa fa-print"></i> พิมพ์รายงาน
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="itemData" class="table table-sm table-hover compact" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class=""><i class="fa fa-file-invoice"></i> BILL</th>
                        <th class="">รายการ</th>
                        <th class="text-center">จำนวน</th>
                        <th class="text-right">ราคา</th>
                        <th class="text-center"><i class="fa fa-calendar-day"></i> วันที่</th>
                        <th class="text-center">ผู้ทำรายการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($item as $it){ ?>
                    <tr>
                        <td class="text-center"><?=$it['receive_id']?></td>
                        <td class=""><?=$it['receive_bill']?></td>
                        <td class="">#<?=$it['item_barcode']." ".$it['item_name']?></td>
                        <td class="text-center"><?=$it['receive_amount']?></td>
                        <td class="text-right"><?=number_format($it['receive_price'],2)?>฿</td>
                        <td class="text-center"><?=DateTimeThai($it['receive_date'])?></td>
                        <td class="text-center"><?=$it['emp_name']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>