<?php
	$menu = $_GET['menu'];
    if($menu=='main' || $menu==''){$ac_main='active';}
	if($menu=='sale'){$ac_sale='active';}
	if($menu=='stock'){$ac_stock='active';}

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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-sliders-h"></i>
                        <p>การตั้งค่าระบบ</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>