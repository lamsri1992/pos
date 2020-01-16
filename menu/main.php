<?php
$count_item = $fnc->countItem();
$count_order = $fnc->countOrderPoint();
$count_low = $fnc->countLowOrderPoint();
?>
<section class="content-header"></section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-clipboard-list"></i> รายงานคลังสินค้า</h3>
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
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-comments-dollar"></i> สรุปยอดการขาย</h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="myChart" width="800px" height="400px"></canvas>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">5 อันดับสินค้าขายดี</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Rank</th>
                                            <th>รายการสินค้า</th>
                                            <th>ราคา</th>
                                            <th>ยอดขาย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>เบียร์ช้าง (กระป๋องยาว)</td>
                                            <td>48 บาท</td>
                                            <td>100 กระป๋อง</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>เบียร์ลีโอ (กระป๋องยาว)</td>
                                            <td>52 บาท</td>
                                            <td>62 กระป๋อง</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>เบียร์ช้าง (ขวดใหญ่)</td>
                                            <td>55 บาท</td>
                                            <td>48 ขวด</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>เบียร์ลีโอ (ขวดใหญ่)</td>
                                            <td>58 บาท</td>
                                            <td>43 ขวด</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>smirnoff midnight (กระป๋องเล็ก)</td>
                                            <td>48 บาท</td>
                                            <td>32 กระป๋อง</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน'],
        datasets: [{
            label: 'สรุปยอดการขาย (เดือน/บาท)',
            data: [10545, 7584, 9965, 12552, 10232, 8522],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>