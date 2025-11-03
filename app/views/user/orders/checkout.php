<main class="checkout-page">
    <div class="checkout-container">
        <div class="delivery-details">
            <h2>Thông Tin Giao Hàng</h2>
            <form method="POST" action="checkout-delivery">
                <label for="userName">TÊN <span>*</span></label>
                <input type="text" id="userName" name="userName" placeholder="Nhập tên"
                    value="<?php echo $user['userName'] ?>" required>

                <label for="email">EMAIL <span>*</span></label>
                <input type="email" id="email" name="email" placeholder="Nhập email"
                    value="<?php echo $user['email'] ?>" disabled>

                <label for="phone">SỐ ĐIỆN THOẠI <span>*</span></label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại"
                    value="<?php echo $user['phone'] ?>" required>

                <label for="city">TỈNH/THÀNH PHỐ <span>*</span></label>
                <input type="text" id="city" name="city" placeholder="Nhập tỉnh/thành phố của bạn"
                    value="<?php echo $user['city'] ?>" required>


                <label for="district">QUẬN/HUYỆN <span>*</span></label>
                <input type="text" id="district" name="district" placeholder="Nhập quận/huyện của bạn"
                    value="<?php echo $user['district'] ?>" required>

                <label for="ward">PHƯỜNG/XÃ<span>*</span></label>
                <input type="text" id="ward" name="ward" placeholder="Nhập phường/xã của bạn"
                    value="<?php echo $user['ward'] ?>" required>

                <label for="street">SỐ NHÀ, ĐƯỜNG <span>*</span></label>
                <input type="text" id="street" name="street" placeholder="Nhập số nhà, tên đường của bạn"
                    value="<?php echo $user['street'] ?>" required>
                <p class="mandatory-note">*Lưu liên hệ cho lần thanh toán sau</p>
                <button id="save-contact-button">Lưu liên hệ </button>

                <label for="note">GHI CHÚ CHO ĐƠN HÀNG (KHÔNG BẮT BUỘC)</label>
                <textarea id="note" name="note" placeholder="Nhập ghi chú..."></textarea>

                <p class="mandatory-note">(*) Các trường này là bắt buộc</p>

                <div class="buttons">
                    <button type="button" class="cancel-button" id="btn-cancel">Hủy</button>
                    <button type="submit" class="continue-button">Tiếp tục</button>
                </div>
            </form>
        </div>

        <!-- Cột phải: Tóm tắt đơn hàng -->
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
                <input type="text" placeholder="Nhập mã giảm giá">
                <button type="button">Áp dụng</button>
            </div>

            <div class="pricing">
                <p>Giá tạm tính: <span><?php echo formatCurrencyVND($orderTotal); ?></span></p>
                <p>Phí vận chuyển: <span>Hiển thị ở bước tiếp theo</span></p>
                <p class="total">TỔNG TIỀN: <strong><?php echo formatCurrencyVND($orderTotal); ?></strong></p>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {

        $('#btn-cancel').on('click', function (e) {
            e.preventDefault();
            window.location = 'carts';
        });

        $('#save-contact-button').on('click', function (e) {
            e.preventDefault();

            const userName = $('#userName').val();
            const phone = $('#phone').val();
            const city = $('#city').val();
            const district = $('#district').val();
            const ward = $('#ward').val();
            const street = $('#street').val();

            const body = { userName, phone, city, district, ward, street };

            $.ajax({
                url: `api/users/update-contact`,
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(body),
                success: function (response) {
                    if (response.success && !response.unchange) {
                        showToast('Lưu thông tin thành công')
                    } else if (response.unchange) {
                        showToast('Thông tin đã được cập nhật')
                    } else {
                        console.log(response)
                        showToast('Lưu thông tin thất bại', 'error')
                    }
                },
                error: function () {
                    showToast('Lưu thông tin xảy ra lỗi', 'error');
                }
            });
        })
    })
</script>