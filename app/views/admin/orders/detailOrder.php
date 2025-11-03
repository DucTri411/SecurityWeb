<?php
switch ($order['status']) {
    case 'ordered':
        $status = 'Đã đặt hàng';
        break;
    case 'processing':
        $status = 'Đang xử lý';
        break;
    case 'delivering':
        $status = 'Đang giao hàng';
        break;
    case 'completed':
        $status = 'Đã hoàn tất';
        break;
    default:
        $status = '';

}

?>

<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row justify-content-center">
                <div class="col-10 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="orderdetail-form">
                                <div class="orderdetail-form-header d-flex justify-content-between">
                                    <div
                                        class="orderdetail-form-header-left col-11 p-0 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="h-bold">Đơn hàng: #<?php echo $order['orderId'] ?></h6>
                                        </div>
                                        <div class="orderdetail-form-header-status">
                                            <span><?php echo $status ?></span>
                                        </div>
                                    </div>
                                    <button id="return-button" class="orderdetail-form-header-icon m-2 border-5"><i
                                            class="fa fa-times"></i></button>
                                </div>
                                <hr>
                                <div class="orderdetail-form-body">
                                    <div>
                                        <h5 class="h-bold">Địa chỉ giao hàng</h5>
                                        <p class="mt-3"><?php echo $order['userName'] ?></p>
                                        <p><?php echo $order['street'] ?>, <?php echo $order['ward'] ?>,
                                            <?php echo $order['district'] ?>, <?php echo $order['city'] ?>
                                        </p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mt-5 col-7 p-0">
                                            <div>
                                                <h6 class="h-bold">Số điện thoại</h6>
                                                <p class="mt-2"><?php echo $order['phone'] ?></p>
                                            </div>
                                            <div class="mt-3">
                                                <h6 class="h-bold">Ngày đặt hàng</h6>
                                                <p class="mt-2"><?php echo $order['createdAt'] ?></p>
                                            </div>
                                            <div class="mt-3">
                                                <h6 class="h-bold">Ghi chú</h6>
                                                <p class="mt-2"><?php echo $order['note'] ?></p>
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <div>
                                                <h6 class="h-bold">Phương thức vận chuyển</h6>
                                                <p class="mt-2">Đồng giá:
                                                    <?php echo formatCurrencyVND($order['shippingCost']) ?>
                                                </p>
                                            </div>
                                            <div class="mt-3">
                                                <h6 class="h-bold">Phương thức thanh toán</h6>
                                                <p class="mt-2">Thanh toán khi nhận hàng</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="col-8 p-0 pt-3 pb-3">Sản phẩm</th>
                                                    <th class="col-2 p-0">Số lượng</th>
                                                    <th class="col-2 p-0">Đơn giá</th>
                                                    <th class="col-2 p-0">Tổng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($order['items'] as $item): ?>
                                                    <tr>
                                                        <td class="pt-3 pb-3"><?php echo $item['productName'] ?></td>
                                                        <td><?php echo $item['quantity'] ?></td>
                                                        <td><?php echo $item['price'] ?></td>
                                                        <td><?php echo $item['totalPrice'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <p>Tổng đơn:
                                    <?php echo formatCurrencyVND($order['orderTotal'] + $order['shippingCost']) ?>
                                </p>
                                <hr>
                                <form action="update-order-status" method="POST"
                                    class="orderdetail-form-footer d-flex justify-content-center">
                                    <input type="hidden" name="orderId" value="<?php echo $order['orderId']; ?>">
                                    <input type="hidden" name="status" id="status">

                                    <div><button id="btn-order" class="orderdetail-form-footer-btn">Đặt
                                            hàng</button></div>
                                    <div><button id="btn-process" class="orderdetail-form-footer-btn">Đang xử
                                            lý</button></div>
                                    <div><button id="btn-deliver" class="orderdetail-form-footer-btn">Đang vận
                                            chuyển</button></div>
                                    <div><button id="btn-completed" class="orderdetail-form-footer-btn">Đã hoàn
                                            tất</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.orderdetail-form-footer-btn').on('click', function (e) {
            e.preventDefault();

            let statusValue = '';
            switch ($(this).attr('id')) {
                case 'btn-order':
                    statusValue = 'ordered';
                    break;
                case 'btn-process':
                    statusValue = 'processing';
                    break;
                case 'btn-deliver':
                    statusValue = 'delivering';
                    break;
                case 'btn-completed':
                    statusValue = 'completed';
                    break;
            }

            $('#status').val(statusValue);
            $(this).closest('form').submit();
        });

        $('#return-button').on('click', function () {
            window.location = 'orders';
        })
    });
</script>