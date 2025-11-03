<link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/css/style3.css' ?>">

<?php
switch ($order['status']) {
    case 'ordered':
        $class = 'pending';
        $status = 'Đã đặt hàng';
        break;
    case 'processing':
        $class = 'pending';
        $status = 'Đang xử lý';
        break;
    case 'delivering':
        $class = 'pending';
        $status = 'Đang vận chuyển';
        break;
    case 'completed':
        $class = 'completed';
        $status = 'Đã hoàn tất';
        break;
    default:
        $class = '';
        $status = '';
}
?>

<div class="order-container">
    <div class="order-header">
        <h2>Đơn hàng #<?php echo $order['orderId'] ?></h2>
        <span class="status <?php echo $class ?>"><?php echo $status ?></span>
    </div>

    <!-- Billing and Shipping Details -->
    <div class="details-container">
        <div class="details-section">
            <h3>Chi tiết đơn hàng</h3>
            <p><strong><?php echo $order['userName'] ?></strong></p>
            <p><?php echo $order['street'] ?>, <?php echo $order['ward'] ?>, <?php echo $order['district'] ?></p>
            <p><?php echo $order['city'] ?></p>
            <p>Email: <a href="mailto:<?php echo $user['email'] ?>"><?php echo $user['email'] ?></a></p>
            <p>Phone: <a href="tel:<?php echo $order['phone'] ?>"><?php echo $order['phone'] ?></a></p>
            <p>Phương thức thanh toán<br>Thanh toán khi nhận hàng</p>
        </div>

        <div class="details-section">
            <h3>Thông tin vận chuyển</h3>
            <p><strong><?php echo $order['userName'] ?></strong></p>
            <p><?php echo $order['street'] ?>, <?php echo $order['ward'] ?>, <?php echo $order['district'] ?></p>
            <p><?php echo $order['city'] ?></p>
            <p><strong>Chi phí vận chuyển</strong><br><?php echo formatCurrencyVND($order['shippingCost']) ?></p>
        </div>
    </div>

    <!-- Product Section -->
    <div class="product-section">
        <h3>Product</h3>
        <?php foreach ($order['items'] as $item): ?>
            <div class="product-item">
                <div class="product-name">
                    <?php echo $item['productName'] ?>
                </div>
                <div class="product-quantity"><?php echo $item['quantity'] ?></div>
                <div class="product-total"><?php echo formatCurrencyVND($item['totalPrice']) ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Buttons -->
    <div class="button-section">
        <button id="btn-return" class="btn btn-secondary" style="color: black;">Quay về</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#btn-return').on('click', function () {
            window.location = 'me';
        })
    })
</script>