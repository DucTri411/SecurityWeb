<!-- Banner -->
<section id="hero" class="parallax">
    <h4> Ưu đãi siêu giá trị </h4>
    <h2> Sale khủng đến 50% </h2>
    <p> Tiết kiệm nhiều hơn với phiếu giảm giá</p>
    <button onclick="window.location='shop'">Mua ngay</button>
</section>

<section id="product1" class="section-p1">
    <h2> Sản Phẩm Nổi Bật </h2>
    <p> Bộ Sưu Tập Mùa Hè Thiết Kế Hiện Đại</p>
    <div class="pro-container">

        <?php foreach ($popularProducts as $product): ?>
            <div class="pro">
                <img src="<?php echo BASE_PATH . '/' . $product['images'][0]['link'] ?>" alt="Sản phẩm 1"
                    onclick="window.location='detail?productId=<?php echo $product['productId'] ?>'">
                <div class="des">
                    <h4 onclick="window.location='detail?productId=<?php echo $product['productId'] ?>'">
                        <?php echo $product['productName'] ?>
                    </h4>
                    <h5 onclick="window.location='detail?productId=<?php echo $product['productId'] ?>'">
                        <?php echo formatCurrencyVND($product['price']) ?>
                    </h5>
                    <div class="star" onclick="window.location='detail?productId=<?php echo $product['productId'] ?>'">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <button class="cart add-to-cart" data-product-id="<?php echo $product['productId']; ?>"><i
                            class="fa-solid fa-cart-plus"></i></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="shop" class="view-more">Xem thêm →</a>
</section>
<!--Banner small-->
<section id="banner" class="section-m1"></section>
<!-- New product -->
<section id="product1" class="section-p1">
    <h2> Hàng Mới Về </h2>
    <p> Bộ Sưu Tập Mới Dành Cho Bạn</p>
    <div class="pro-container">
        <?php foreach ($latestProducts as $product): ?>
            <div class="pro">
                <img src="<?php echo BASE_PATH . '/' . $product['images'][0]['link'] ?>" alt="Sản phẩm 1"
                    onclick="window.location='detail?productId=<?php echo $product['productId'] ?>'">
                <div class="des">
                    <h4 onclick="window.location='detail?productId=<?php echo $product['productId'] ?>'">
                        <?php echo $product['productName'] ?></h4>
                    <h5 onclick="window.location='detail?productId=<?php echo $product['productId'] ?>'">
                        <?php echo formatCurrencyVND($product['price']) ?></h5>
                    <div onclick="window.location='detail?productId=<?php echo $product['productId'] ?>'" class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <button class="cart add-to-cart" data-product-id="<?php echo $product['productId']; ?>"><i
                            class="fa-solid fa-cart-plus"></i></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="shop" class="view-more">Xem thêm →</a>
</section>

<div class="section-banner">
    <h2> Bộ Sưu Tập Mới</h2>
    <p> Xuân 2025</p>
    <section id="sm-banner" class="section-p1">
        <!-- Small 2 banner -->
        <div class="banner-box">
            <h4> Sailor Moon Collection</h4>
            <h2> Mua 1 tặng 1</h2>
            <span> Các bộ trang phục hot nhất đang được bán tại LSoul</span>
            <button class="white">Xem thêm </button>
        </div>
        <div class="banner-box2">
            <h4> 1707 Collection</h4>
            <h2> Mùa sắp tới<i></i></h2>
            <span> Chiếc váy hot nhất đang được bán tại LSoul</span>
            <button class="white">Xem thêm</button>
        </div>
    </section>
    <div class="view-more-container">
        <a href="shop" class="view-more-link">Xem thêm →</a>
    </div>
</div>

<!--Feedback-->

<section id="feedback" class="section-p1">
    <h2> Feedback </h2>
    <p> Từ Khách Hàng Của Lsoul</p>
    <div class="pro-container">
        <div class="pro">
            <img src="https://lsoul.b-cdn.net/wp-content/uploads/2024/11/HUONG-GIANG.jpg" alt="Feedback1">
            <div class="des">
                <p>Hương Giang - Level Dress</p>
            </div>
        </div>
        <div class="pro">
            <img src="https://lsoul.b-cdn.net/wp-content/uploads/2024/04/Jentle-Salon.jpg" alt="Feedback2">
            <div class="des">
                <p> Jennierubyjane</p>
            </div>
        </div>
        <div class="pro">
            <img src="https://lsoul.b-cdn.net/wp-content/uploads/2024/11/TU-HAO.jpg" alt="Feedback3">
            <div class="des">
                <p> Tú Hảo</p>
            </div>
        </div>
        <div class="pro">
            <img src="https://lsoul.b-cdn.net/wp-content/uploads/2024/10/Ninh-Duong-Lan-Ngoc.jpg" alt="Feedback4">
            <div class="des">
                <p> Ninh Dương Lan Ngọc</p>
            </div>
        </div>
    </div>
    <a href="blogs" class="view-more-link">Xem thêm →</a> </div>
</section>

<!-- Banner 3-->

<div class="banner3">

</div>
<!--Thương hiệu-->
<div class="brand-story">
    <div class="brand-container">
        <h2>Câu Chuyện Thương Hiệu</h2>
        <p class="brand-summary">
            LSOUL ra đời từ khát vọng kết nối thời trang với tâm hồn, mang đến những sản phẩm bền vững và tinh tế,
            giúp bạn khẳng định giá trị bản thân. Với phong cách tối giản và hiện đại, LSOUL là tuyên ngôn sống đầy cảm
            hứng.
            Chúng tôi cam kết sử dụng chất liệu thân thiện môi trường, giảm thiểu lãng phí, và lan tỏa thông điệp sống
            bền vững.
            <span class="dots">...</span>
        </p>
    </div>
    <div class="view-more">
        <a href="about" class="view-more-link">Xem thêm →</a>
    </div>
</div>
<section class="news-section">
    <h2 class="section-title">Tin Tức Nổi Bật</h2>
    <div class="news-grid">
        <!-- Tin tức 1 -->
        <div class="news-item">
            <img src="https://channel.mediacdn.vn/428462621602512896/2023/6/2/photo-1-16856954932251633378377.jpg"
                alt="Thương hiệu thời trang nữ LSOUL" class="news-image">
            <h3 class="news-title">Thương hiệu thời trang nữ LSOUL "đốn tim" mọi cô nàng</h3>
            <p class="news-meta">By admin • 5 December, 2024</p>
            <p class="news-excerpt">Thời trang LSOUL mang đến sự thanh lịch và cá tính, chinh phục trái tim của mọi tín
                đồ thời trang...</p>
        </div>
        <!-- Tin tức 2 -->
        <div class="news-item">
            <img src="https://bazaarvietnam.vn/wp-content/uploads/2024/06/BZ-Nguyen-Trong-Lam-LSEOUL2.jpg"
                alt="Jennie diện váy LSOUL" class="news-image">
            <h3 class="news-title"> CEO Nguyễn Trọng Lâm đưa thương hiệu Việt LSEOUL bước ra thế giới</h3>
            <p class="news-meta">By admin • 4 December, 2024</p>
            <p class="news-excerpt">CEO Nguyễn Trọng Lâm đã thành công trong việc đưa thương hiệu thời trang Việt...</p>
        </div>

        <!-- Tin tức 3 -->
        <div class="news-item">
            <img src="https://bazaarvietnam.vn/wp-content/uploads/2024/10/bazaarvietnam-lsoul-bitis-khong-ngai-thay-ao-moi-mua-cuoi-nam1.jpg"
                alt="LSOUL đổi tên" class="news-image">
            <h3 class="news-title">LSESOUL bất ngờ đổi tên thành LSOUL</h3>
            <p class="news-meta">By admin • 6 December, 2024</p>
            <p class="news-excerpt">Thương hiệu thời trang nổi tiếng LSESOUL chính thức đổi tên thành LSOUL, đánh dấu
                một hành trình mới...</p>
        </div>
        <!-- Tin tức 4 -->
        <div class="news-item">
            <img src="https://i.ex-cdn.com/vntravellive.com/files/content/2024/05/17/4-5_lseoul_0873-2-1-1714.jpg"
                alt="BST mới của LSOUL" class="news-image">
            <h3 class="news-title"> L Soul - Khác biệt vô song, Incomparable</h3>
            <p class="news-meta">By admin • 29 October, 2024</p>
            <p class="news-excerpt">L Soul mang đến một phong cách thời trang khác biệt hoàn toàn, khẳng định vị thế ...
            </p>
        </div>
    </div>
    <div class="view-more">
        <a href="blogs" class="view-more-link">Xem thêm →</a>
    </div>
</section>

<script>
    const menuIcon = document.getElementById('menu-icon');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeBtn = document.getElementById('close-btn');

    menuIcon.addEventListener('click', () => {
        mobileMenu.classList.add('open');
    });

    closeBtn.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
    });

    document.addEventListener('scroll', function () {
        const parallaxImg = document.querySelector('.parallax-image img');
        const scrollPosition = window.scrollY;

        // Điều chỉnh giá trị dịch chuyển
        parallaxImg.style.transform = `translateY(${scrollPosition * 0.5}px)`;
    }); 
</script>