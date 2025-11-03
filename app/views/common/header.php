<?php
if (!isset($page))
    $page = '';
?>
<section id="header">
    <div class="header-container">
       <a href="<?php echo BASE_PATH . '/'; ?>">
            <img src="https://sp-ao.shortpixel.ai/client/to_auto,q_glossy,ret_img,w_1536/https://lsoul.b-cdn.net/wp-content/uploads/2024/10/500-X-100-1536x307.png"
                alt="Logo" style="max-height: 50px;">
        </a>
    </div>
    <div>
        <ul id="navbar" class="navbar">
            <li><a class="<?php if ($page === 'home')
                echo 'active'; ?>" href="<?php echo BASE_PATH . '/' ?>">Trang
                    chủ</a></li>
            <li><a class="<?php if ($page === 'shop')
                echo 'active'; ?>" href="<?php echo BASE_PATH . '/shop' ?>">Cửa hàng</a></li>
            <li><a class="<?php if ($page === 'about')
                echo 'active'; ?>" href="<?php echo BASE_PATH . '/about' ?>">Về chúng tôi</a></li>
            <li><a class="<?php if ($page === 'blogs')
                echo 'active'; ?>" href="<?php echo BASE_PATH . '/blogs' ?>">Blog</a></li>
            <li><a class="<?php if ($page === 'contact')
                echo 'active'; ?>" href="<?php echo BASE_PATH . '/contact' ?>">Liên hệ</a></li>
            <li id="lg-acc"><a class="<?php if ($page === 'me')
                echo 'active'; ?>" href=" <?php echo BASE_PATH . '/me' ?>"><i class="fa-solid fa-user"></i></a></li>
            <li id="lg-search"><a href="<?php echo BASE_PATH . '/shop' ?>"><i class="fa-solid fa-search"></i></a></li>
            <li id="lg-bag"><a class="<?php if ($page === 'carts')
                echo 'active'; ?>" href="<?php echo BASE_PATH . '/carts' ?>"><i
                        class="fa-solid fa-cart-shopping"></i></a>
            </li>
        </ul>
    </div>
    <div class="menu-icon" id="menu-icon">☰</div>
</section>
<div class="mobile-menu" id="mobile-menu">
    <span class="close-btn" id="close-btn">&times;</span>
    <nav>
        <a href="<?php echo BASE_PATH . '/' ?>">Trang chủ</a>
        <a href="<?php echo BASE_PATH . '/shop' ?>">Cửa hàng</a>
        <a href="<?php echo BASE_PATH . '/about' ?>">Về chúng tôi</a>
        <a href="<?php echo BASE_PATH . '/blogs' ?>">Blog</a>
        <a href="<?php echo BASE_PATH . '/contact' ?>">Liên hệ</a>
        <a href="<?php echo BASE_PATH . '/login' ?>"><i class="fa-solid fa-user"></i></a>
        <a href="<?php echo BASE_PATH . '/shop' ?>"><i class="fa-solid fa-search"></i></a>
        <a href="<?php echo BASE_PATH . '/carts' ?>"><i class="fa-solid fa-cart-shopping"></i></a>
    </nav>
</div>