<?php $credit = $fnc->getCredit(); $count_credit = $fnc->countCredit(); foreach ($credit as $ct){ $total += $ct['order_income']; } ?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-user-tag"></i> ระบบลูกค้าสินเชื่อ</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3><?=$count_credit['num']?><sup style="font-size: 20px"> ราย</sup></h3>
                            <p>ลูกหนี้ทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-times"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?=$total?><sup style="font-size: 20px"> บาท</sup></h3>
                            <p>ยอดลูกหนี้ทั้งหมด</p>
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
                            <th class="text-center">ลูกหนี้</th>
                            <th class="text-right">ยอดค้างจ่าย</th>
                            <th class="text-center"><i class="fa fa-calendar-day"></i> วันที่</th>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($credit as $it){ ?>
                        <tr>
                            <td class="text-center"><?=$it['credit_id']?></td>
                            <td class="text-center"><?=$it['credit_customer']?></td>
                            <td class="text-right" style="color:red;"><?=number_format($it['order_income'],2)?></td>
                            <td class="text-center"><?=DateTimeThai($it['order_date'])?></td>
                            <td class="text-center">
                                <a href="#" class="ajaxCredit badge badge-success" data-target="#detailCredit"
                                    data-toggle="modal" data-id="<?=$it['credit_id']?>">
                                    <i class="fa fa-search"></i> รายละเอียด
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>