<div class="login">
    <form class="register-form" method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token(); ?>">
        <h2>LSOUL</h2>
        <p>Đăng ký tài khoản</p>
        <input type="email" name="email" placeholder="Nhập Email" required maxlength="254">
        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required minlength="8" maxlength="64">
        <input type="password" name="confirmedPassword" id="confirmedPassword" placeholder="Nhập lại mật khẩu" required minlength="8" maxlength="64">
        <button type="submit">Đăng ký</button>
        <div class="register-link">
            Đã có tài khoản? <a href="login">Đăng nhập ngay</a>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('.register-form').on('submit', function (e) {
            const password = $('#password').val();
            const confirmedPassword = $('#confirmedPassword').val();

            // Check if passwords match
            if (password !== confirmedPassword) {
                e.preventDefault(); 
                showToast('Xác nhận mật khẩu không chính xác');
                $('#password').focus();
            }
        });
    });
</script>