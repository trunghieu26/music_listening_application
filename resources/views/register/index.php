<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <title>Đăng nhập</title>
</head>

<body>
    <header>
        <div>
        
        </div>
    </header>
    <section class="login-form">
        <div class="login-common">
            <span class="title-login-form">Đăng ký để bắt đầu nghe </span>
            <div class="form-field" id="formField">
                <form>
                    <div class="email-or-name">
                        <span>
                            Địa chỉ email
                        </span>
                        <input style="margin-bottom: 8px;" class="form-email" placeholder="Email hoặc tên người dùng">
                        <a style="font-size: 14px; color : #1ed760; text-decoration: underline; margin-top:8px;">Dùng số điện thoại.</a>
                    </div>
                    <button type="" class="submit-register">Tiếp theo</button>
                    <a href="#" style="font-size: 1rem; display : flex; justify-content : center; text-decoration: underline;  color : #fff;"></a>
                </form>
            </div>
            <span style="font-size: 1rem; color : #6a6a6a; display : flex; justify-content : center;">
                Bạn đã có tài khoản? <a href="/login" style="font-size: 1rem; color : #fff; text-decoration: underline;">&nbsp Đăng nhập tại đây.</a>
            </span>
        </div>
    </section>
</body>
<script>
function scrollToFormField() {
    var formField = document.getElementById('formField');
    if (formField) {
        formField.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

</html>