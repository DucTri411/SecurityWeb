<div class="main-content-inner">
    <div class="mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-product-table">
                    <h4 class="header-title">Danh sách Khách hàng</h4>
                    <a href="add-user" class="header-add">
                        <p class="header-add-text">Thêm mới</p>
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col"><i class="fa fa-image"></i></th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Đơn hàng</th>
                                    <th scope="col">Tổng chi</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <div class="rounded-circle">
                                                <img src="<?php echo BASE_PATH . '/' . $user['image']; ?>" alt=""
                                                    class="rounded-circle" style="width: 30px; height: 30px;" />
                                            </div>
                                        </td>
                                        <td><?php echo $user['userName'] ?></td>
                                        <td><?php echo $user['email'] ?></td>
                                        <td><?php echo $user['totalOrders'] ?></td>
                                        <td><?php echo $user['totalSpent'] ?></td>
                                        <td class="action-icon">
                                            <a href="<?php echo "detail-user?userId=" . $user['userId']; ?>"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="<?php echo "update-user?userId=" . $user['userId']; ?>"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                            <a class="delete-link"
                                                href="<?php echo "delete-user?userId=" . $user['userId']; ?>"><i
                                                    class="ti-trash"></i></a>
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
    window.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.delete-link', function (e) {
            e.preventDefault();
            showDeleteModal('Bạn có chắc chắn xóa người dùng này?', $(this).attr('href'));
        });
    })
</script>