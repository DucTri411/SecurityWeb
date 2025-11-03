<link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/css/style3.css' ?>">

<div class="form-container">
    <h2 class="form-title">Cập Nhật Thông Tin</h2>
    <form class="customer-form" action="" method="POST" enctype="multipart/form-data">
        <div class="input-group">
            <label for="userName">Họ và Tên</label>
            <div class="input-wrapper">
                <i class="fa fa-user"></i>
                <input type="text" id="userName" name="userName" placeholder="Nhập họ và tên"
                    value="<?php echo $user['userName'] ?>">
            </div>
        </div>

        <!-- Email -->
        <div class="input-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <i class="fa fa-envelope"></i>
                <input type="email" id="email" name="email" value="<?php echo $user['email'] ?>"
                    placeholder="Nhập email" disabled>
            </div>
        </div>

        <!-- Số điện thoại -->
        <div class="input-group">
            <label for="phone">Số Điện Thoại</label>
            <div class="input-wrapper">
                <i class="fa fa-phone"></i>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại"
                    value="<?php echo $user['phone'] ?>">
            </div>
        </div>

        <!-- Địa chỉ -->
        <div class="input-group">
            <label for="city">Tỉnh/Thành phố</label>
            <div class="input-wrapper">
                <i class="fa fa-map-marker-alt"></i>
                <input type="text" id="city" name="city" value="<?php echo $user['city'] ?>" placeholder="Nhập địa chỉ">
            </div>
        </div>

        <div class="input-group">
            <label for="district">Quận/Huyện</label>
            <div class="input-wrapper">
                <i class="fa fa-map-marker-alt"></i>
                <input type="text" id="district" name="district" value="<?php echo $user['district'] ?>"
                    placeholder="Nhập địa chỉ">
            </div>
        </div>

        <div class="input-group">
            <label for="ward">Phường/Xã</label>
            <div class="input-wrapper">
                <i class="fa fa-map-marker-alt"></i>
                <input type="text" id="ward" name="ward" placeholder="Nhập địa chỉ" value="<?php echo $user['ward'] ?>">
            </div>
        </div>

        <div class="input-group">
            <label for="street">Số nhà, tên đường</label>
            <div class="input-wrapper">
                <i class="fa fa-map-marker-alt"></i>
                <input type="text" id="street" name="street" placeholder="Nhập địa chỉ"
                    value="<?php echo $user['street'] ?>">
            </div>
        </div>

        <div class="input-group">
            <label for="street">Hình ảnh</label>
            <div class="input-wrapper">
                <i class="fa fa-image"></i>
                <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg"
                    placeholder="Chọn hình ảnh">
            </div>
        </div>

        <div class="input-group img">
            <img id="preview" src="<?php echo $user['image'] ?>" alt="<?php echo $user['userName'] ?>">
        </div>

        <!-- Nút hành động -->
        <div class="form-buttons">
            <button type="submit" class="btn btn-save">Lưu Thông Tin</button>
            <button type="button" id="btn-reset" class="btn btn-cancel">Hủy</button>
        </div>
    </form>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        $('#image').on('change', function (e) {
            const preview = $('#preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $('#btn-reset').on('click', function (e) {
            e.preventDefault();
            window.location = 'me';
        })
    });
</script>