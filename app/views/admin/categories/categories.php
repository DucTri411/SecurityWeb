<div class="main-content-inner">
    <div class="mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-product-table">
                    <h4 class="header-title">Danh mục sản phẩm</h4>
                    <a href="add-category" class="header-add">
                        <p class="header-add-text">Thêm mới</p>
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-uppercase">
                                <tr>
                                    <!-- <th scope="col"><i class="fa fa-image"></i></th> -->
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Số lượng sản phẩm</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $cate): ?>
                                    <tr>
                                        <td><?php echo $cate['categoryName'] ?></td>
                                        <td><?php echo $cate['productCount'] ?></td>
                                        <td class="action-icon width-40">
                                            <a href="<?php echo "update-category?categoryId=" . $cate['categoryId']; ?>"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                            <a class="delete-link"
                                                href="<?php echo "delete-category?categoryId=" . $cate['categoryId']; ?>"><i
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
            showDeleteModal('Bạn có chắc chắn xóa danh mục này?', $(this).attr('href'));
        });
    })
</script>