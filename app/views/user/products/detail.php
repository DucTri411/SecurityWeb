<style>
    .container {
        width: 1200px;
        margin: 0 auto;
        background-color: #fff;
    }

    .product-details {
        display: flex;
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    .product-image {
        width: 40%;
        padding-right: 20px;
        border: none;
        height: 100%;
    }

    .product-image img {
        width: 100%;
    }

    .product:hover {
        transform: scale(1.05);
        border-color: black;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .product:hover a {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .product-info {
        width: 60%;
    }

    .product-info h1 {
        font-size: 26px;
        margin-bottom: 10px;
    }

    .product-info p {
        font-size: 16px;
        color: #555;
    }

    .product-info .price {
        font-size: 20px;
        color: black;
        margin: 15px 0;
    }

    .product-info .star {
        font-size: 16px;
        color: #e9cc2893;
    }

    .product-info select,
    .product-info input[type="number"] {
        padding: 8px;
        margin: 8px 0;
        border: 1px solid #ccc;
        width: 45%;
        font-size: 14px;
    }

    .product-info button {
        background-color: black;
        color: #fff;
        border: none;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
        width: 60%;
        transition: background-color 0.3s;
    }

    .product-info button:hover {
        background-color: #5c4d3d;
        /* Thêm hiệu ứng hover */
    }

    .tabs {
        margin-top: 20px;
        display: flex;
        cursor: pointer;
        list-style-type: none;
        padding: 0 80px;
    }

    .tabs li {
        margin-right: 20px;
        padding: 10px;
        background-color: #dddd;
        border-radius: 5px;
        text-align: center;
    }

    .tabs li.active {
        background-color: black;
        color: white;
    }

    .tab-content {
        display: none;
        padding: 20px 80px;
        border-top: 1px solid #ddd;
    }

    .tab-content.active {
        display: block;
    }

    .suggestions {
        background-color: #f9f9f9;
        padding: 20px 80px;
        margin-top: 40px;
    }

    .suggestions h2 {
        font-size: 20px;
        margin-bottom: 15px;
    }

    .suggestions .product {
        display: inline-block;
        width: 180px;
        margin-right: 15px;
        text-align: center;

    }

    .suggestions img {
        width: 100%;
        height: auto;
    }

    .size-options {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .size-option input[type="radio"] {
        display: none;
    }

    .size-option label {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 16px;
        color: white;
    }

    .size-option input[type="radio"]:checked+label {
        background-color: #787674;
    }

    .size-option label:hover {
        background-color: #aaa;
    }

    .button-container {
        width: 30%;
        display: flex;
    }

    .button-container i {
        font-size: 14px;
    }

    .quantity-controls {
        margin-top: 6px;
    }

    #decrease {
        margin-left: 0;
    }
</style>

<div class="sanpham-container">
    <!-- Chi tiết sản phẩm -->
    <div class="sanpham" id="12">
        <div class="product-image">
            <img src="<?php echo $product['images'][0]['link']; ?>" alt="Sản phẩm">
        </div>
        <div class="product-info">
            <h1><?php echo $product['productName']; ?></h1>
            <p class="price"><?php echo formatCurrencyVND($product['price']); ?></p>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <br>
            <p>Luợt xem: <?php echo $product['views']; ?></p>
            <p>Danh mục: <?php echo $product['categoryName']; ?></p>
            <p>Còn lại <b><?php echo $product['stock']; ?></b> sản phẩm</p>
            <input type="hidden" name="stock" id="stock" value="<?php echo $product['stock']; ?>">
            <label for="quantity">Số lượng</label>
            <div class="quantity-controls">
                <label id="decrease" class="quantity-btn">-</label>
                <input type="text" id="quantity" value="01" readonly>
                <label id="increase" class="quantity-btn">+</label>
            </div>
            <br>
            <div class="button-container">
                <button id="btn-add-to-cart" data-product-id="<?php echo $product['productId']; ?>"><i
                        class="fa-solid fa-cart-shopping"></i></button>
                <button id="btn-buy-now" data-product-id="<?php echo $product['productId']; ?>">Mua ngay</button>
            </div>
        </div>

    </div>

    <!-- Các Tab -->
    <ul class="tabs">
        <li class="active" data-tab="detail">Thông tin chi tiết</li>
        <li data-tab="return">Chính sách đổi trả</li>
        <li data-tab="care">Hướng dẫn bảo quản</li>
        <li data-tab="review">Đánh giá</li>
    </ul>

    <!-- Nội dung của các Tab -->
    <div id="detail" class="tab-content active">
        <h2><strong>Thông tin chi tiết sản phẩm</strong></h2>
        <p>
            <?php echo $product['productDesc']; ?>
        </p>
    </div>

    <div id="return" class="tab-content">
        <h2>Chính sách đổi trả</h2>
        <p><strong>I. Điều kiện đổi trả:</strong></p>
        <ul>
            <li>Khách hàng phải cung cấp đầy đủ video/hình ảnh quay chụp khi khui mở kiện hàng, cùng với biên nhận mua
                hàng.</li>
            <li>Sản phẩm vẫn giữ nguyên trạng thái ban đầu bao gồm cả tem mác thương hiệu và phụ kiện đi kèm nếu có,
                không bị chỉnh sửa, không bị bẩn hoặc bị tác động bởi hóa chất, không được giặt ủi, không có mùi lạ và
                không có dấu hiệu đã sử dụng.</li>
            <li>Trong trường hợp đổi trả, phí vận chuyển ban đầu sẽ không được hoàn lại.</li>
            <li>Với các sản phẩm được đặt hàng trên các sàn thương mại điện tử (Shopee, Lazada, Tiktok), L Seoul sẽ tuân
                thủ chính sách đổi trả hàng của sàn.</li>
        </ul>

        <p><strong>II. Các trường hợp đổi trả sản phẩm:</strong></p>
        <ul>
            <li><strong>L Seoul cam kết đổi trả miễn phí:</strong>
                <ul>
                    <li>Nếu sản phẩm bị lỗi kỹ thuật từ phía nhà sản xuất.</li>
                    <li>Nếu L Seoul giao không đúng mẫu mã hoặc không đủ số lượng như trong đơn đặt hàng.</li>
                </ul>
            </li>
            <li><strong>L Seoul yêu cầu đối với khách hàng muốn hỗ trợ đổi size:</strong>
                <ul>
                    <li>Sản phẩm cần đổi phải còn đủ số lượng để giao.</li>
                    <li>Khách hàng tự thanh toán phí vận chuyển 2 chiều và chi phí phát sinh nếu có.</li>
                </ul>
            </li>
            <li><strong>L Seoul yêu cầu đối với khách hàng muốn đổi sản phẩm khác so với đơn đặt hàng ban đầu:</strong>
                <ul>
                    <li>Trong trường hợp sản phẩm đổi có giá trị cao hơn, khách hàng cần bù phần chênh lệch.</li>
                    <li>Trong trường hợp sản phẩm đổi có giá trị thấp hơn, L Seoul sẽ không hoàn trả phần chênh lệch.
                    </li>
                    <li>Khách hàng tự thanh toán phí vận chuyển 2 chiều và chi phí phát sinh nếu có.</li>
                </ul>
            </li>
        </ul>

        <p><strong>III. Sản phẩm không đủ điều kiện đổi trả:</strong></p>
        <ul>
            <li>Trường hợp sản phẩm bị cắt tag hay bị hỏng do sử dụng không đúng cách sẽ không được L Seoul chấp nhận
                đổi trả.</li>
            <li>Quá 48 giờ kể từ khi khách nhận hàng, nếu L Seoul không nhận được phản hồi về tình trạng của sản phẩm, L
                Seoul sẽ coi như sản phẩm đã được chấp nhận.</li>
            <li>Sản phẩm thuộc các chương trình khuyến mãi, giảm giá mà không có lỗi từ nhà sản xuất sẽ không được L
                Seoul chấp nhận đổi trả.</li>
        </ul>

        <p>L Seoul có quyền từ chối mọi yêu cầu đổi trả hàng nếu khách hàng không tuân thủ theo các quy định về chính
            sách đổi trả của L Seoul.</p>

        <p><strong>IV. Thời gian quy định đổi trả:</strong></p>
        <ul>
            <li>Khách hàng cần gửi trả sản phẩm trong vòng 7 ngày kể từ ngày nhận hàng. Sau thời hạn này, L Seoul có
                quyền từ chối mọi yêu cầu đổi trả từ phía khách hàng.</li>
            <li>Khách hàng có thể đến trực tiếp cửa hàng của L Seoul để đổi trả sản phẩm hoặc sử dụng dịch vụ chuyển
                phát nhanh.</li>
            <li>Mỗi đơn hàng chỉ được đổi trả một lần.</li>
        </ul>
    </div>

    <div id="care" class="tab-content">
        <h2>Hướng dẫn bảo quản</h2>
        <ul>
            <li>Giặt máy lưu ý lộn sản phẩm mặt trái ra ngoài.</li>
            <li>Sử dụng nước ấm ở nhiệt độ vừa phải.</li>
            <li>Sấy khô ở nhiệt độ thấp.</li>
            <li>Đặt sản phẩm ở nơi khô thoáng.</li>
            <li>Không sử dụng nước tẩy.</li>
        </ul>
    </div>

    <div id="review" class="tab-content">
        <div class="reviews">
            <div id="review-list"></div>
        </div>

        <div class="review-form">
            <h3>Hãy để lại đánh giá của bạn:</h3>
            <textarea id="review-text" rows="5" cols="40" placeholder="Nhập đánh giá của bạn tại đây..." required
                disabled></textarea>
            <br><br>

            <input type="text" id="review-name" placeholder="Nhập tên của bạn" required disabled>
            <br><br>

            <button disabled>Gửi Đánh Giá</button>
        </div>


    </div>

    <!-- Gợi ý sản phẩm -->
    <div>
        <div class="suggestions">
            <h2>Sản phẩm gợi ý</h2>
            <?php foreach ($relativeProducts as $product): ?>
                <a href="#" class="product">
                    <img src="<?php echo $product['images'][0]['link'] ?>" alt="<?php echo $product['productName'] ?>">
                    <p><?php echo $product['productName'] ?></p>
                    <p><?php echo formatCurrencyVND($product['price']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Chức năng chuyển tab
        const tabs = document.querySelectorAll('.tabs li');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = document.getElementById(tab.getAttribute('data-tab'));
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                tab.classList.add('active');
                target.classList.add('active');
            });
        });

        //handle plus and minus button (quantity)
        const quantity = $('#quantity');
        $('#increase').on('click', function (e) {
            e.preventDefault();
            const currentQuantity = parseInt(quantity.val(), 10);
            const newQuantity = currentQuantity + 1;
            if (newQuantity <= $('#stock').val())
                quantity.val(newQuantity < 10 ? `0${newQuantity}` : newQuantity);
            else {
                showToast('Không đủ sản phẩm trong kho', 'error');
            }
        })
        $('#decrease').on('click', function (e) {
            e.preventDefault();
            const currentQuantity = parseInt(quantity.val(), 10);
            const newQuantity = currentQuantity - 1;
            if (newQuantity > 0)
                quantity.val(newQuantity < 10 ? `0${newQuantity}` : newQuantity);
        })
    })
</script>