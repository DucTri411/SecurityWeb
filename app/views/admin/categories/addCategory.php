<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row justify-content-center">
                <div class="col-8 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"><?php echo $action === 'add' ? 'Thêm' : 'Cập nhật' ?> danh mục
                            </h4>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="categoryName" class="col-form-label">Tên Danh mục</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $category['categoryName'] ?? '' ?>" id="categoryName"
                                        name="categoryName" />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-rounded btn-success mb-3">
                                        <?php echo $action === 'add' ? 'Thêm' : 'Cập nhật' ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>