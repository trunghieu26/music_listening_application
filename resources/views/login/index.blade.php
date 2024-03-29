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
    <section class="login-form">
        <div class="login-common">
            <span class="title-login-form">Đăng nhập vào ứng dụng</span>
            <div class="form-field">
                <form>
                    <div class="email-or-name">
                        <span>
                            Email hoặc tên người dùng
                        </span>
                        <input class="form-email" placeholder="Email hoặc tên người dùng">
                    </div>
                    <div class="password-field">
                        <span>
                            Mật khẩu
                        </span>
                        <input class="form-password" placeholder="Mật khẩu">
                    </div>
                    <div class="remember-me">
                        <label class="switch" for="checkbox">
                            <input type="checkbox" id="checkbox" />
                            <div class="slider round"></div>
                        </label>
                        <span style="font-size: 0.875rem;font-weight: 700;">
                            Hãy nhớ tôi
                        </span>
                    </div>
                    <button type="submit" class="submit-login">Đăng nhập</button>
                    <a href="/password/forgot" style="font-size: 1rem; display : flex; justify-content : center; text-decoration: underline;  color : #fff;">
                        Quên mật khẩu của bạn?
                    </a>
                </form>
            </div>
            <span style="font-size: 1rem; color : #6a6a6a; display : flex; justify-content : center;">
                Bạn chưa có tài khoản? <a href="/register" style="font-size: 1rem; color : #fff; text-decoration: underline;">Đăng ký Spotify</a>
            </span>
        </div>
    </section>
</body>

</html>