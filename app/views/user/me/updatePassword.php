<link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/css/style3.css' ?>">

<div class="form-container">
    <h2 class="form-title">Cập Nhật Mật Khẩu</h2>
    <form class="customer-form" action="" method="POST">
        <div class="input-group">
            <label for="oldPassword">Mật khẩu cũ</label>
            <div class="input-wrapper">
                <i class="fa fa-key"></i>
                <input type="password" id="oldPassword" name="oldPassword" placeholder="Nhập mật khẩu cũ" required>
            </div>
        </div>

        <div class="input-group">
            <label for="newPassword">Mật khẩu mới</label>
            <div class="input-wrapper">
                <i class="fa fa-key"></i>
                <input type="password" id="newPassword" name="newPassword" placeholder="Nhập mật khẩu mới" required>
            </div>
        </div>

        <div class="input-group">
            <label for="confirmedPassword">Nhập lại mật khẩu</label>
            <div class="input-wrapper">
                <i class="fa fa-key"></i>
                <input type="password" id="confirmedPassword" name="confirmedPassword" placeholder="Nhập lại mật khẩu"
                    required>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="form-buttons">
            <button id="btn-update" type="submit" class="btn btn-save">Cập nhật</button>
        </div>
    </form>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        $('#btn-update').on('click', function (e) {
            e.preventDefault();
            if ($('#newPassword').val() !== $('#confirmedPassword').val()) {
                showToast('Mật khẩu bạn nhập không khớp', 'error');
                $('#confirmedPassword').focus();
            } else {
                $(this).closest('form').submit();
            }
        })
    });
</script>