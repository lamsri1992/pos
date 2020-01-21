<?php
	$menu = $_GET['menu'];
    if($menu=='main' || $menu==''){$ac_main='active';}
	if($menu=='sale'){$ac_sale='active';}
    if($menu=='stock' || $menu=='setUnit'){$ac_stock='active';}
    if($menu=='daily' || $menu=='week' || $menu=='month'){$ac_report='active'; $box='menu-open';}
    if($menu=='daily'){$ac_daily='active';}
    if($menu=='week'){$ac_week='active';}
    if($menu=='month'){$ac_month='active';}
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
                            <a href="?menu=week" class="nav-link <?=$ac_week?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ยอดขายรายสัปดาห์</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?menu=month" class="nav-link <?=$ac_month?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ยอดขายรายเดือน</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-sliders-h"></i>
                        <p>การตั้งค่าระบบ</p>
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