<!DOCTYPE html><html lang="vi-VN" data-nhanh.vn-template="T0299">
<head>
<meta name="robots" content="index, follow" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"><title>Đăng nhập</title><meta name="DC.language" content="scheme&#x3D;utf-8&#x20;content&#x3D;vi">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
<meta name="google-site-verification" content=""><link rel="stylesheet" href="https://web.nvnstatic.net/css/fontAwesome/font-awesome-4.7.0.min.css?v=2" type="text/css"><link rel="stylesheet" href="https://web.nvnstatic.net/css/bootstrap/bootstrap.4.3.1.min.css?v=2" type="text/css"><link rel="stylesheet" href="https://web.nvnstatic.net/css/appLib.css" type="text/css"><link rel="stylesheet" href="https://web.nvnstatic.net/tp/T0299/css/plugin.css?v=10" type="text/css"><link rel="stylesheet" href="https://web.nvnstatic.net/tp/T0299/css/animate.css?v=10" type="text/css"><link rel="stylesheet" href="https://web.nvnstatic.net/tp/T0299/css/define.css?v=10" type="text/css"><link rel="stylesheet" href="https://web.nvnstatic.net/tp/T0299/css/style.css?v=10" type="text/css"><link rel="stylesheet" href="https://web.nvnstatic.net/tp/T0299/css/responsive.css?v=10" type="text/css"><script defer type="text/javascript" src="https://web.nvnstatic.net/js/jquery/jquery.min.js?v=17"></script><script defer type="text/javascript" src="https://web.nvnstatic.net/js/bootstrap/boostrap.popper.min.js?v=17"></script><script defer type="text/javascript" src="https://web.nvnstatic.net/js/bootstrap/bootstrap.4.3.1.min.js?v=17"></script><script defer type="text/javascript" src="https://web.nvnstatic.net/js/lib.js?v=17"></script><script defer type="text/javascript" src="https://web.nvnstatic.net/js/jquery/jquery.cookie.js?v=17"></script><script defer type="text/javascript" src="https://web.nvnstatic.net/tp/T0299/js/plugin.js?v=3"></script><script defer type="text/javascript" src="https://web.nvnstatic.net/tp/T0299/js/mains.js?v=3"></script><style type="text/css"></style><style type="text/css">img {max-width: 100%;} img.lazyload{ opacity: 0.001; object-fit: scale-down !important; } .fb-customerchat>span>iframe.fb_customer_chat_bounce_out_v2 {max-height: 0 !important;}  .fb-customerchat>span>iframe.fb_customer_chat_bounce_in_v2{max-height: calc(100% - 80px) !important;}</style><script src="https://pos.nvnstatic.net/cache/location.vn.js?v=241115_150026" defer></script><script src="https://web.nvnstatic.net/js/lazyLoad/lazysizes.min.js" async></script><style>figure.image{clear: both;display: table;margin: .9em auto;min-width: 50px;text-align: center;width: auto !important;}figure.image img {display: block;margin: 0 auto;max-width: 100%;min-width: 100%;}figure.image>figcaption {background-color: #f7f7f7;caption-side: bottom;color: #333;display: block;font-size: .75em;outline-offset: -1px;padding: .6em;word-break: break-word;}figure.image img, img.image_resized {height: auto !important;aspect-ratio: auto !important;}</style><script src="https://web.nvnstatic.net/js/translate/vi-vn.js" defer></script><script>
</script></head>
<body>
      
<script defer type="text/javascript" src="https://web.nvnstatic.net/js/jquery/jquery.validationEngine.js?v=19"></script><script defer type="text/javascript" src="https://web.nvnstatic.net/js/jquery/jquery.validationEngine-vi.js?v=19"></script><script defer type="text/javascript" src="https://web.nvnstatic.net/tp/T0299/js/user.js?v=2"></script><link rel="stylesheet" href="https://web.nvnstatic.net/css/validationEngine.jquery.css?v=3" type="text/css"><link rel="stylesheet" href="https://web.nvnstatic.net/css/appLib.css" type="text/css"><input type="hidden" id="redirect" value=""><main class="main-site main-childs">
    <div class="user-wrapper">
        <div class="user-nav anonymous-awe">
            <a href="<?php echo WEBROOT . 'taikhoan/login'?>" class="active" rel="nofollow">Đăng nhập</a>
            <a href="<?php echo WEBROOT . 'taikhoan/signup'?>" rel="nofollow">Đăng ký</a>
        </div>
        <form accept-charset="UTF-8" id="loginForm" class="validate" onsubmit="return validateForm()" action="<?php echo WEBROOT . 'taikhoan/xulydangnhap'?>" method="post">
        <?php 
         if(isset( $_SESSION['loidangnhap'])){echo  $_SESSION['loidangnhap'];}
        ?>
            <div class="form-group">
                <input type="text" name="sdt" id="sdt" class="validate[required]" value="<?php if(isset($_SESSION['hienthisdt'])){
                                echo $_SESSION['hienthisdt'] ; 
                            }
                            if(isset($_COOKIE['login_sdt'])){
                               echo $_COOKIE['login_sdt'] ;
                            }
                            ?>"
                       placeholder="Nhập email hoặc tên đăng nhập">
            </div>
            <div id="suggestions" class="suggestions"></div>
            
            <div class="form-group">
                <input type="password" name="password" id="password" class="validate[required]"  value="<?php if(isset($_COOKIE['login_password'])){
                                echo $_COOKIE['login_password'] ; 
                            }   ?>"
                       placeholder="Mật khẩu">
                       <div class="input-group-append">
                    <span id="togglePassword" class="input-group-text" style="cursor: pointer;">
                        <i id="eyeIcon" class="fas fa-eye"></i>  <!-- Biểu tượng con mắt -->
                    </span>
                </div>
            </div>

            <div class="user-foot ">
                <button style="background-color:#79c66e; border-color:#79c66e" type="submit" id="btnsignin" class="btn btn-pink full text-uppercase">
                    Đăng nhập             </button>
               <div class="userfoot" style="gap: 30px;">
                    <label for="rememberMe"><input style=" width:1px; padding-left:4px;" type="checkbox" id="rememberMe" name="rememberMe"> Nhớ mật khẩu</label>
                   
                    <a href="<?php echo WEBROOT . 'taikhoan/forgot'?>" class="clearfix1" rel="nofollow">
                        Quên mật khẩu?
                    </a>
               </div>
               
               
            </div>
        </form>
    </div>
    <script>
    // Lắng nghe sự kiện mousedown và mouseup trên biểu tượng con mắt
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    // Khi giữ chuột xuống
    togglePasswordButton.addEventListener('mousedown', function() {
        passwordField.type = "text"; // Hiển thị mật khẩu
        eyeIcon.classList.remove('fa-eye'); // Đổi biểu tượng mắt đóng thành mắt mở
        eyeIcon.classList.add('fa-eye-slash');
    });

    // Khi nhả chuột
    togglePasswordButton.addEventListener('mouseup', function() {
        passwordField.type = "password"; // Ẩn mật khẩu
        eyeIcon.classList.remove('fa-eye-slash'); // Đổi biểu tượng mắt mở thành mắt đóng
        eyeIcon.classList.add('fa-eye');
    });

    // Đảm bảo xử lý cả sự kiện khi người dùng rời khỏi nút (mouseleave)
    togglePasswordButton.addEventListener('mouseleave', function() {
        passwordField.type = "password"; // Ẩn mật khẩu
        eyeIcon.classList.remove('fa-eye-slash'); // Đổi biểu tượng mắt mở thành mắt đóng
        eyeIcon.classList.add('fa-eye');
    });
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const usernameInput = document.getElementById('sdt');
            const passwordInput = document.getElementById('password');
            const suggestionsBox = document.getElementById('suggestions');

            const savedUser = "<?php echo $saved_user; ?>";
            const savedPassword = "<?php echo $saved_password; ?>";

            usernameInput.addEventListener('focus', function () {
                if (savedUser) {
                    suggestionsBox.innerHTML = `<div>${savedUser}</div>`;
                    suggestionsBox.style.display = 'block';
                }
            });

            suggestionsBox.addEventListener('click', function () {
                usernameInput.value = savedUser;
                passwordInput.value = savedPassword;
                suggestionsBox.style.display = 'none';
            });

            document.addEventListener('click', function (event) {
                if (!usernameInput.contains(event.target) && !suggestionsBox.contains(event.target)) {
                    suggestionsBox.style.display = 'none';
                }
            });
        });
    </script>
</main>
<style>
    main {
    display: flex;
    justify-content: center; /* Căn giữa theo chiều ngang */
    align-items: center;    /* Căn giữa theo chiều dọc */
    height: 100vh;          /* Chiều cao toàn màn hình */
    background-color: #f9f9f9; /* Màu nền cho thẩm mỹ */
    }

   .clearfix1 {
    display: block; /* Đảm bảo phần tử được xem như một khối */
    text-align: right; /* Căn chỉnh nội dung sang phải */
    margin-top: 10px; /* Tạo khoảng cách trên để đẹp hơn */
      
    }

    .form-group {
            position: relative;
        }

        #togglePassword {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .fas {
            font-size: 18px;
        }


    .loginFb{
        width: 100%;
        border-radius: 3px;
        background: #2e4b88;
        display: inline-block;
        font-weight: normal;
        margin-top: 20px;
    }
    .loginFb span, .loginGg span {
        float: left;
        width: 50px;
        height: 100%;
        font-size: 31px;
        color: #fff;
        border-right:1px solid #15416f;
    }
    .loginGg span{
        border-right:1px solid #646668;
    }
    .loginFb a, .loginGg a{
        color: #fff;
        padding: 0 5px;
    }
    .loginGg{
        width: 100%;
        background: #ea4235;
        color: #fff;
        display: inline-block;
        border-radius: 3px;
        margin-top: 10px;
    }
    .user-wrapper {
        max-width: 600px;
        /* background: #f5f5f5; */
        margin: 35px auto;
        border: 1px solid grey;
        border-radius: 3px;
    }
    .user-nav {
        border-bottom: 2px solid #cccccc63;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(146, 146, 146, 0.14);
    }
    .user-nav a{
        width: 50%;
        float: left;
        display: inline-block;
        text-transform: uppercase;
        font-size: 18px;
        text-align: center;
        padding: 5px 10px;
        border-bottom: 2px solid transparent;
        color: #79c66e;
    }
    .user-nav a.active, .user-nav a:hover{
        border-bottom: 2px solid #79c66e;
    }
    .user-wrapper #loginForm{
        padding: 20px;
    }
    #loginForm input{
        font-size: 15px;
        width: 100%;
        clear: both;
        padding: 8px 12px;
        border: 1px solid #ccc;
    }
    #loginForm input:focus{
        outline: 0;
    }

   
    a[href="/user/getpassword"]{
        color: #333;
    }
    a[href="/user/getpassword"]:hover{
        color: #ffb0bd;
    }
 
    .userfoot {
    display: flex;
    justify-content: space-between; /* Phân chia không gian đều giữa các phần tử */
    align-items: center; /* Căn giữa theo chiều dọc */
}

.userfoot label {
    margin: 0;
    display: flex;
    align-items: center;
}

.userfoot a {
    margin-top:4px;
    color: #333;
    text-decoration: none;
    margin-left: auto; /* Đẩy chữ "Quên mật khẩu" sang phải */
}

.userfoot a:hover {
    color: green;
}




.suggestions {
            display: none;
            position: absolute;
            top: 110%;
            left: 0;
            width: calc(100% - 2px);
            margin-top: -20px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .suggestions div {
            padding: 12px;
            cursor: pointer;
        }

        .suggestions div:hover {
            background-color: #e0e0e0;
        }

</style>
</body>
</html>