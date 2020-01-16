<?php
	$menu = $_GET['menu'];
    if($menu=='main' || $menu==''){$ac_main='active';}
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
            </ul>
        </nav>
    </div>
</aside>