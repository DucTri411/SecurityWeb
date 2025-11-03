<link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/css/style3.css' ?>">

<div class="customer-container">
    <div class="customer-management">
        <div class="customer-info">
            <img src="<?php echo $user['image'] ?>" alt="Avatar">
            <h2><?php echo $user['userName'] ?></h2>
            <p><?php echo $user['email'] ?></p>
            <a href="update-profile" class="edit-button">Cập nhật thông tin</a>
            <a href="update-password" class="edit-button">Thay đổi mật khẩu</a>
            <a href="logout" class="edit-button">Đăng xuất</a>
        </div>

        <!-- Right Section: Order Info -->
        <div class="order-info">
            <h3>Thông Tin Đơn Hàng</h3>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Đơn Hàng</th>
                        <th>Ngày Đặt</th>
                        <th>Trạng Thái</th>
                        <th>Tổng Giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr style="cursor: pointer;" class="order-tr" data-order-id="<?php echo $order['orderId'] ?>">
                            <td>#<?php echo $order['orderId'] ?></td>
                            <td><?php echo $order['createdAt'] ?></td>
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
                            <td><span class="status <?php echo $class ?>"><?php echo $status ?></span></td>
                            <td><?php echo formatCurrencyVND($order['orderTotal'] + $order['shippingCost']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        $('.order-tr').on('click', function () {
            const orderId = $(this).data('order-id');
            window.location = `order-detail?orderId=${orderId}`;
        })
    })
</script>