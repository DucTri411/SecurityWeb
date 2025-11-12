<div class="login">
    <form class="login-form" method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token(); ?>">
        <h2>LSOUL</h2>
        <p>Đăng nhập tài khoản </p>
        <input type="email" name="email" placeholder="Nhập Email" required maxlength="254">
        <input type="password" name="password" placeholder="Nhập mật khẩu" required minlength="8" maxlength="64">
        <button type="submit">LOG IN</button>
        <div class="register-link">
            Chưa có tài khoản? <a href="signup">Đăng ký ngay</a>
        </div>
    </form>
</div>