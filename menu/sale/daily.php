<?php $daily = $fnc->getDaily(date('Y-m-d')); $credit_daily = $fnc->getCreditDaily(date('Y-m-d')); $count_credit = $fnc->countCreditDaily(date('Y-m-d'));
foreach ($daily as $ct){ $sales += $ct['list_qty']; $total += $ct['order_income']; } 
foreach ($credit_daily as $ct){ $total_credit += $ct['order_income']; }
?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-file-invoice-dollar"></i>
                ยอดขาย<?=DBThaiLongDateFull(date("Y-m-d"));?>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?=$sales?><sup style="font-size: 20px"> ชิ้น</sup></h3>
                            <p>สินค้าที่ขาย</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?=number_format($total-$total_credit,2)?><sup style="font-size: 20px"> บาท</sup></h3>
                            <p>ยอดการขายวันนี้</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comment-dollar"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3><?=$count_credit['num']?><sup style="font-size: 20px"> ราย</sup></h3>
                            <p>ลูกหนี้วันนี้</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-times"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?=number_format($total_credit,2)?><sup style="font-size: 20px"> บาท</sup></h3>
                            <p>ยอดลูกหนี้</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
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
                        <?php foreach ($daily as $it){ ?>
                        <tr>
                            <td class="text-center"><?=$it['order_id']?></td>
                            <td class=""><?=$it['item_barcode']?></td>
                            <td class=""><?=$it['item_name']?></td>
                            <td class="text-center"><?=$it['list_qty']?></td>
                            <td class="text-center"><?=$it['unit_name']?></td>
                            <td class="text-right"><?=number_format($it['order_income'],2)?></td>
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