<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row justify-content-center">
                <div class="col-8 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"><?php echo $action === 'add' ? 'Thêm' : 'Cập nhật' ?> Thông tin
                            </h4>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="userName" class="col-form-label">Tên</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $user['userName'] ?? '' ?>" id="userName"
                                        name="userName" />
                                </div>
                                <?php if ($action === 'add'): ?>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input class="form-control" type="email"
                                            value="<?php echo $user['email'] ?? ''; ?>" id="email" name="email"
                                            required />
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label">Mật khẩu</label>
                                        <input class="form-control" type="password"
                                            value="<?php echo $user['password'] ?? ''; ?>" id="password" name="password"
                                            required />
                                    </div>
                                <?php else: ?>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input class="form-control" type="email"
                                            value="<?php echo $user['email'] ?? ''; ?>" id="email" name="email"
                                            disabled />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-form-label">Số điện thoại</label>
                                        <input 
                                        class="form-control" 
                                        type="tel"
                                            value="<?php echo $user['phone'] ?? ''; ?>" 
                                            id="phone" 
                                            name="phone" />
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="col-form-label">Tỉnh/Thành phố</label>
                                        <input class="form-control" type="text"
                                            value="<?php echo $user['city'] ?? '' ?>" id="city" name="city" />
                                    </div>
                                    <div class="form-group">
                                        <label for="district" class="col-form-label">Quận/Huyện</label>
                                        <input class="form-control" type="text"
                                            value="<?php echo $user['district'] ?? '' ?>" id="district"
                                            name="district" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ward" class="col-form-label">Phường/Xã</label>
                                        <input class="form-control" type="text"
                                            value="<?php echo $user['ward'] ?? '' ?>" id="ward" name="ward" />
                                    </div>
                                    <div class="form-group">
                                        <label for="street" class="col-form-label">Số nhà, Tên đường,
                                            Khóm/Ấp</label>
                                        <input class="form-control" type="text"
                                            value="<?php echo $user['street'] ?? '' ?>" id="street" name="street" />
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image"
                                                accept="image/png, image/jpeg, image/jpg"
                                                onchange="previewImage(event)" />
                                            <label class="custom-file-label" for="image">Ảnh đại diện</label>
                                        </div>
                                    </div>
                                    <div class="row mb-3 justify-content-center">
                                        <div
                                            class="update-img-product m-1 p-0 col-4 border border-1 position-relative image-container">
                                            <img src="<?php echo BASE_PATH . '/' . $user['image']; ?>" alt="Chưa có ảnh"
                                                id="preview" />
                                            <!-- <div class="delete-btn"><i class="fa fa-times"></i></div> -->
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-rounded btn-success mb-3">
                                        <?php echo $action === 'add' ? 'Thêm' : 'Cập nhật'; ?>
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
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    }
</script>