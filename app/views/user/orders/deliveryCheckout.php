<div class="checkout2-container">
    <nav>
        <span>THÔNG TIN GIAO HÀNG</span> > <span class="highlight">2. PAYMENT</span> > <span>3. METHOD</span>
    </nav>
    <div class="content">
        <div class="shipping">
            <h3>Phí ship</h3>
            <p>Tiêu chuẩn: <?php echo formatCurrencyVND($shippingCost); ?></p>
            <button id="btn-return">Quay lại</button>
            <a href="checkout-payment"><button class="checkout">Tiếp tục thanh toán</button></a>
        </div>

        <div class="order-summary">
            <h2>Tóm Tắt Đơn Hàng</h2>
            <?php foreach ($carts as $cart): ?>
                <div class="product-item">
                    <img src="<?php echo $cart['images'][0]['link']; ?>" alt="Sản phẩm" class="product-image">
                    <div class="product-details">
                        <p><strong><?php echo $cart['productName']; ?></strong></p>
                        <p>Phân loại: <?php echo $cart['categoryName']; ?></p>
                        <p>Giá: <?php echo formatCurrencyVND($cart['price']); ?></p>
                        <p>Số lượng: <?php echo $cart['quantity']; ?></p>
                        <p class="product-price"><?php echo formatCurrencyVND($cart['totalPrice']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="discount-code">
                <input type="text" placeholder="Nhập mã giảm giá ">
                <button type="button">Áp dụng</button>
            </div>

            <div class="pricing">
                <p>Giá tạm tính: <span><?php echo formatCurrencyVND($orderTotal); ?></span></p>
                <p>Phí vận chuyển: <span><?php echo formatCurrencyVND($shippingCost); ?></span></p>
                <p class="total">TỔNG TIỀN:
                    <strong><?php echo formatCurrencyVND($orderTotal + $shippingCost); ?></strong>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#btn-return").on('click', function (e) {
            e.preventDefault();
            window.location = 'checkout';
        })
    })
</script>