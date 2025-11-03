<?php
require_once 'app/models/CategoryModel.php';
$categoryModel = new CategoryModel();
$categories = $categoryModel->getAllCategories();
?>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4> ĐĂNG KÝ NHẬN BẢN TIN</h4>
        <p> Nhận thông tin cập nhật qua Email về cửa hàng của chúng tôi và <span> các ưu đãi đặc biệt </span>
        </p>
    </div>
    <div class="form">
        <input type="text" placeholder="info@lsoul.com">
        <button class="normal"> Đăng ký </button>

    </div>
    <div>

    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h4>LSOUL CÓ THỂ GIÚP GÌ</h4>
            <p><a href="mailto:your-email@example.com"><i class="fa-solid fa-envelope"></i> Email</a></p>
            <p><i class="fa-solid fa-phone"></i> +84777071707 <span class="online">Online</span></p>
            <p>Opening hours 8:30 AM - 10 PM</p>
        </div>
        <div class="footer-section">
            <h4>VỀ LSOUL</h4>
            <ul>
                <li><a href="<?php echo BASE_PATH . '/about' ?>">Về Chúng Tôi</a></li>
                <li><a href="<?php echo BASE_PATH . '/#feedback' ?>">Feedback</a></li>
                <li><a href="<?php echo BASE_PATH . '/shop' ?>">Cửa Hàng</a></li>
                <li><a href="<?php echo BASE_PATH . '/contact' ?>">Work With Us</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>CHÍNH SÁCH LSOUL</h4>
            <ul>
                <li><a href="<?php echo BASE_PATH . '/policy' ?>">Chính Sách Đổi Trả</a></li>
                <li><a href="<?php echo BASE_PATH . '/policy' ?>">Chính Sách Bảo Mật</a></li>
                <li><a href="<?php echo BASE_PATH . '/policy' ?>">Hướng Dẫn Thanh Toán</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>DANH MỤC</h4>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li><a
                            href="shop?categoryId=<?php echo $category['categoryId']; ?>"><?php echo $category['categoryName']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="footer-section">
            <h4>THEO DÕI CHÚNG TÔI</h4>
            <div class="social-icons">
                <a href="https://www.facebook.com/lsoul.officiel"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/lsoul.officiel/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.tiktok.com/@lsoul.officiel?_t=8qumpMMgNyg&_r=1"><i
                        class="fa-brands fa-tiktok"></i></a>
                <a href="https://www.youtube.com/@lsoulofficial"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://shopee.vn/lsoul.vn"><i class="fa-solid fa-shop"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="language-switch">
            🌐 <a href="#">THAI</a> | <a href="#">ENGLISH</a> | <a href="#" class="active">TIẾNG VIỆT</a>
        </div>
        <p style="text-align: center;">© 2023 LSOUL | GCNKD số: 41A8047682 - Ngày cấp 02/07/2020, Nơi đăng ký Sở kế
            hoạch đầu tư Thành Phố Hồ Chí
            Minh</p>
    </div>
</footer>