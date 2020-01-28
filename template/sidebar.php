<?php
	$menu = $_GET['menu'];
    if($menu=='main' || $menu==''){$ac_main='active';}
	if($menu=='sale'){$ac_sale='active';}
    if($menu=='stock' || $menu=='setUnit' || $menu=='setGroup'){$ac_stock='active';}
    if($menu=='daily' || $menu=='week' || $menu=='month'){$ac_report='active'; $box='menu-open';}
    if($menu=='daily'){$ac_daily='active';}
    if($menu=='week'){$ac_week='active';}
    if($menu=='month'){$ac_month='active';}
    if($menu=='history'){$ac_history='active';}
    if($menu=='shared'){$ac_shared='active';}
    if($menu=='credit'){$ac_credit='active';}
?>
<aside class="main-sidebar elevation-4 sidebar-dark-info">
    <a href="?" class="brand-link text-center">
        <img src="img/shop.png" class="brand-image" style="opacity: .8">
        <small class="brand-text font-weight-light">SALE & STOCK SYSTEM</small>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="?" class="nav-link <?=$ac_main?>">
                        <i class="nav-icon fa fa-home"></i>
                        <p>หน้าหลัก</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?menu=sale" class="nav-link <?=$ac_sale?>">
                        <i class="nav-icon fa fa-cash-register"></i>
                        <p>ระบบขายหน้าร้าน</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?menu=stock" class="nav-link <?=$ac_stock?>">
                        <i class="nav-icon fa fa-box-open"></i>
                        <p>ระบบบริหารคลังสินค้า</p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?=$box?>">
                    <a href="#" class="nav-link <?=$ac_report?>">
                        <i class="nav-icon fas fa-comments-dollar"></i>
                        <p>รายงานยอดขาย<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?menu=daily" class="nav-link <?=$ac_daily?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ยอดขายรายวัน</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?=$ac_month?>" data-toggle="modal" data-target="#month">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ยอดขายรายเดือน</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="?menu=credit" class="nav-link <?=$ac_credit?>">
                        <i class="nav-icon fa fa-user-tag"></i>
                        <p>ระบบลูกค้าสินเชื่อ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?menu=history" class="nav-link <?=$ac_history?>">
                        <i class="nav-icon fa fa-history"></i>
                        <p>ประวัติการรับสินค้าเข้า</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?menu=shared" class="nav-link <?=$ac_shared?>">
                        <i class="nav-icon fa fa-retweet"></i>
                        <p>ประวัติการแบ่งสินค้าขาย</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-question-circle"></i>
                        <p>คู่มือการใช้งาน</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Report Sale Month -->
<div class="modal fade" id="month" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-search-dollar"></i> สรุปยอดขายรายเดือน</h5>
            </div>
            <form action="?menu=month" method="post">
                <div class="modal-body">
                    <select name="month" class="form-control input-md" required>
                        <option value="">เลือกเดือน</option>
                        <option value="1">- มกราคม</option>
                        <option value="2">- กุมภาพันธ์</option>
                        <option value="3">- มีนาคม</option>
                        <option value="4">- เมษายน</option>
                        <option value="5">- พฤษภาคม</option>
                        <option value="6">- มิถุนายน</option>
                        <option value="7">- กรกฏาคม</option>
                        <option value="8">- สิงหาคม</option>
                        <option value="9">- กันยายน</option>
                        <option value="10">- ตุลาคม</option>
                        <option value="11">- พฤศจิกายน</option>
                        <option value="12">- ธันวาคม</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                        ตกลง
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </form>
        </div>
    </div>
</div>