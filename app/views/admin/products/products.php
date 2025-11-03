<div class="main-content-inner">
    <div class="mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-product-table">
                    <h4 class="header-title">Danh sách sản phẩm</h4>
                    <a href="add-product" class="header-add">
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
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col"><i class="fa fa-eye"></i></th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($products as $product):
                                    ?>

                                    <tr>
                                        <td><img style="width: 100px;" src="<?php if ($product['images'])
                                            echo BASE_PATH . '/' . $product['images'][0]['link']; ?>" alt=""></td>
                                        <td><?php echo $product['productName'] ?></td>
                                        <td><?php echo $product['stock'] ?></td>
                                        <td><?php echo formatCurrencyVND($product['price']) ?></td>
                                        <td><?php echo $product['categoryName'] ?></td>
                                        <td><?php echo $product['views'] ?></td>
                                        <td class="action-icon">
                                            <a href="<?php echo "update-product?productId=" . $product['productId']; ?>"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                            <a class="delete-link"
                                                href="<?php echo "delete-product?productId=" . $product['productId']; ?>"><i
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
            showDeleteModal('Bạn có chắc chắn xóa sản phẩm này?', $(this).attr('href'));
        });
    })
</script>