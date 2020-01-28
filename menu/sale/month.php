<?php $num = $_REQUEST['month']; $month = $fnc->getMonth($num); foreach ($month as $ct){ $total += $ct['item_price']*$ct['list_qty']; $sales += $ct['list_qty']; } ?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ยอดขายเดือน</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?=$sales?><sup style="font-size: 20px"> ชิ้น</sup></h3>
                            <p>สินค้าที่ขาย/เดือน</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?=$total?><sup style="font-size: 20px"> บาท</sup></h3>
                            <p>ยอดการขาย/เดือน</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comment-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <table id="itemData" class="table table-sm table-hover compact" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">รหัสบิล</th>
                            <th class=""><i class="fa fa-barcode"></i> Barcode</th>
                            <th class="">รายการ</th>
                            <th class="text-center">จำนวน</th>
                            <th class="text-center">หน่วยนับ</th>
                            <th class="text-right">รวม</th>
                            <th class="text-center">พนักงานขาย</th>
                            <th class="text-center"><i class="fa fa-clock"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($month as $it){ ?>
                        <tr>
                            <td class="text-center"><?=$it['order_id']?></td>
                            <td class=""><?=$it['item_barcode']?></td>
                            <td class=""><?=$it['item_name']?></td>
                            <td class="text-center"><?=$it['list_qty']?></td>
                            <td class="text-center"><?=$it['unit_name']?></td>
                            <td class="text-right"><?=number_format($it['item_price']*$it['list_qty'],2)?></td>
                            <td class="text-center"><?=$it['emp_name']?></td>
                            <td class="text-center"><?=DateTimeThai($it['order_date'])?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>