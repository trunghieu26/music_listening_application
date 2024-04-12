<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Đăng ký</title>
</head>

<body>
    <section class="login-form">
        <div class="login-common">
            <span class="title-login-form">Đăng ký để bắt đầu nghe </span>
            <div class="form-field" id="formField">
                <form class="signUp" action="/register" method="post">
                    {{ csrf_field() }}
                    <div class="email-or-name">
                        <span>
                            Địa chỉ email
                        </span>
                        <input name="email" style="margin-bottom: 8px;" class="form-email @error('email') is-invalid @enderror" placeholder="Email hoặc tên người dùng">
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                        <a style="font-size: 14px; color : #1ed760; text-decoration: underline; margin-top:8px;">Dùng số điện thoại.</a>
                    </div>
                    <div class="password-field">
                        <span>
                            Mật khẩu
                        </span>
                        <input name="password" type="password" id="password" class="form-password" placeholder="Mật khẩu">
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                        <span toggle="#password" class="fa fa-eye-slash fa-fw  field-icon toggle-password"></span>
                    </div>
                    <div class="name-field">
                        <span>
                            Tên
                        </span>
                        <h5 style="color: #6a6a6a; font-size : 0.875rem;">Tên này sẽ xuất hiện trên hồ sơ của bạn</h5>
                        <input name="name" class="form-name" placeholder="Tên">
                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                    </div>
                    <div class="gender-field">
                        <span>
                            Giới tính
                        </span>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="1" {{old('gender') == 1 ? 'checked' : ''}} id="exampleRadios1">
                            <label class="form-check-label" for="exampleRadios1">
                                Nam
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="2" {{old('gender') == 2 ? 'checked' : ''}} id="exampleRadios2">
                            <label class="form-check-label" for="exampleRadios2">
                                Nữ
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="3" {{old('gender') == 3 ? 'checked' : ''}} id="exampleRadios3">
                            <label class="form-check-label" for="exampleRadios3">
                                Không phân biệt giới tính
                            </label>
                        </div>
                        <span class="text-danger">@error('gender'){{$message}}@enderror</span>
                    </div>
                    <button type="submit" class="submit-register">Đăng ký</button>
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
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>

</html>