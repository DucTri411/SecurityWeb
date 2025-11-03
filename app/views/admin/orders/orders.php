<div class="main-content-inner">
    <div class="mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-product-table">
                    <h4 class="header-title">Danh sách Đơn hàng</h4>
                </div>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">Đơn hàng</th>
                                    <th scope="col">Ngày đặt hàng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Tổng</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?php echo $order['orderId'] ?></td>
                                        <td><?php echo $order['createdAt'] ?></td>
                                        <td>
                                            <form action="update-order-status" method="POST" class="status-form">
                                                <input type="hidden" name="orderId"
                                                    value="<?php echo $order['orderId']; ?>">
                                                <select name="status" id="status" style="background: none; border: none;">
                                                    <option value="ordered" <?php echo $order['status'] === 'ordered' ? 'selected' : ''; ?>>Đã đặt
                                                        hàng
                                                    </option>
                                                    <option value="processing" <?php echo $order['status'] === 'processing' ? 'selected' : ''; ?>>Đang
                                                        xử
                                                        lý
                                                    </option>
                                                    <option value="delivering" <?php echo $order['status'] === 'delivering' ? 'selected' : ''; ?>>Đang
                                                        vận
                                                        chuyển</option>
                                                    <option value="completed" <?php echo $order['status'] === 'completed' ? 'selected' : ''; ?>>Đã
                                                        hoàn
                                                        tất
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td><?php echo formatCurrencyVND($order['orderTotal']) ?></td>
                                        <td>
                                            <a href="detail-order?orderId=<?php echo $order['orderId'] ?>"><i
                                                    class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.status-form select').forEach(function (select) {
            select.addEventListener('change', function () {
                this.closest('form').submit();
            });
        });
    });
</script>