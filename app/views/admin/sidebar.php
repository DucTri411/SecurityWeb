<?php
if (!isset($page))
    $page = '';

?>
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="<?php echo BASE_PATH . "/admin" ?>"><img
                    src="<?php echo BASE_PATH . "/app/public/assets/images/icon/logo.png" ?>" alt="logo" /></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <!-- <li class="<?php echo $page === 'dashboard' ? 'active' : '' ?>">
                        <a href="<?php echo BASE_PATH . "/admin" ?>" aria-expanded="true"><i
                                class="ti-dashboard"></i><span>Dashboard</span></a> -->
                    </li>
                    <li class="<?php echo $page === 'users' ? 'active' : '' ?>">
                        <a href="<?php echo BASE_PATH . "/admin/users" ?>" aria-expanded="true"><i
                                class="ti-user"></i><span>Khách
                                hàng</span></a>
                    </li>
                    <li class="<?php echo $page === 'products' ? 'active' : '' ?>">
                        <a href="<?php echo BASE_PATH . "/admin/products" ?>" aria-expanded="true"><i
                                class="fa fa-table"></i><span>Sản
                                phẩm</span></a>
                    </li>
                    <li class="<?php echo $page === 'categories' ? 'active' : '' ?>">
                        <a href="<?php echo BASE_PATH . "/admin/categories" ?>" aria-expanded="true"><i
                                class="ti-layout-list-thumb"></i><span>Danh
                                mục</span></a>
                    </li>
                    <li class="<?php echo $page === 'orders' ? 'active' : '' ?>">
                        <a href="<?php echo BASE_PATH . "/admin/orders" ?>" aria-expanded="true"><i
                                class="ti-clipboard"></i><span>Đơn
                                hàng</span></a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_PATH . "/admin/logout" ?>" aria-expanded="true"><i
                                class="fa fa-sign-out"></i><span>Đăng
                                xuất</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>