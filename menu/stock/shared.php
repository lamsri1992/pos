<?php $item = $fnc->getShared(); $data = $fnc->getStock();?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-retweet"></i> ประวัติการแบ่งสินค้าขาย</h3>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#">
                    <i class="fa fa-calendar"></i> ค้นหาตามช่วงเวลา
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="itemData" class="table table-sm table-hover compact" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="">รายการหลัก</th>
                        <th class="">รายการแบ่ง</th>
                        <th class="text-center"><i class="fa fa-calendar-day"></i> วันที่</th>
                        <th class="text-center">ผู้ทำรายการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($item as $it){ ?>
                    <tr>
                        <td class="text-center"><?=$it['shared_id']?></td>
                        <td><?php foreach ($data AS $name){
                            if ($it['shared_item_main'] == $name['item_id']){
                                echo $name['item_name']." => ".$it['shared_item_main_num']." ".$name['unit_name'];}
                            }?>
                        </td>
                        <td><?php foreach ($data AS $name){
                            if ($it['shared_item_sub'] == $name['item_id']){
                                echo $name['item_name']." => ".$it['shared_item_sub_num']." ".$name['unit_name'];}
                            }?>
                        </td>
                        <td class="text-center"><?=DateTimeThai($it['shared_date'])?></td>
                        <td class="text-center"><?=$it['emp_name']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>