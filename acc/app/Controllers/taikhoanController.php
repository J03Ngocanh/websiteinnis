<?php 
require_once './core/controller.php';
require_once 'app/models/taikhoan.php';
require_once 'app/models/mailer.php';

class taikhoanController extends Controller {
    private $taikhoanModel;
    public function __construct() {
        $this->taikhoanModel = $this->model('taikhoanModel');
    } 

    public function forgot() {
        
        $this->view('taikhoan/forgot_password');
    }
    public function login() {
        $this->view('taikhoan/login');
    }

    // Hàm xử lý khi người dùng ấn "Gửi mã xác nhận"
    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];

            // Kiểm tra email trong cơ sở dữ liệu
            $user = $this->taikhoanModel->checkEmailExists($email);

            if ($user) {
                // Tạo mã xác nhận
                $verificationCode = rand(100000, 999999);

                // Lưu mã xác nhận vào cơ sở dữ liệu
                if ($this->taikhoanModel->saveVerificationCode($user['id'], $verificationCode)) {
                    // Gửi mã xác nhận qua email (sử dụng PHPMailer hoặc thư viện khác)
                    $mailer = new Mailer();
                    if ($mailer->sendVerificationCode($email, $verificationCode)) {
                        // Lưu email vào session để dùng ở bước xác nhận
                        $_SESSION['email'] = $email;
                        $_SESSION['message'] = "Mã xác nhận đã được gửi đến email của bạn.";
                        $_SESSION['message_type'] = "success";
                        $this->view('taikhoan/verify_code'); // Chuyển tới trang nhập mã xác nhận
                        exit;
                    } else {
                        $_SESSION['message'] = "Không thể gửi email. Vui lòng thử lại.";
                        echo 'hihi';
                        $_SESSION['message_type'] = "error";
                        echo 'hihi';
                        $this->view('taikhoan/forgot_password'); // Quay lại form quên mật khẩu
                        exit;
                    }
                }
            } else {
                $_SESSION['message'] = "Email không tồn tại trong hệ thống.";
                $_SESSION['message_type'] = "error";
                $this->view('taikhoan/forgot_password');
                exit;
            }
        }
    }
      // Hàm xử lý khi người dùng nhập mã xác nhận
      public function verifyCode() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $verificationCode = $_POST['verification_code'];
            $email = $_SESSION['email']; // Lấy email từ session

            // Kiểm tra email trong cơ sở dữ liệu
            $user = $this->taikhoanModel->checkEmailExists($email);

            if ($user) {
                // Kiểm tra mã xác nhận
                if ($this->taikhoanModel->checkVerificationCode($user['id'], $verificationCode)) {
                    // Nếu mã xác nhận đúng, chuyển đến trang thay đổi mật khẩu
                    $_SESSION['message'] = "Mã xác nhận đúng. Bạn có thể thay đổi mật khẩu.";
                    $_SESSION['message_type'] = "success";
                    $this->view('taikhoan/reset_password');
                } else {
                    $_SESSION['message'] = "Mã xác nhận không chính xác.";
                    $_SESSION['message_type'] = "error";
                    $this->view('taikhoan/verify_code');
                }
            } else {
                $_SESSION['message'] = "Email không tồn tại trong hệ thống.";
                $_SESSION['message_type'] = "error";
                $this->view('taikhoan/verify_code');
            }
        }
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION['email']; // Lấy email từ session
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($newPassword === $confirmPassword) {
                // Mã hóa mật khẩu mới (sử dụng password_hash để bảo mật)
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                // Cập nhật mật khẩu mới vào cơ sở dữ liệu
                $user = $this->taikhoanModel->updatePassword($email, $hashedPassword);

                if ($user) {
                    $_SESSION['message'] = "Mật khẩu đã được thay đổi thành công!";
                    $_SESSION['message_type'] = "success";
                    // Xóa session email khi xong
                    unset($_SESSION['email']);
                    // Redirect về trang đăng nhập hoặc trang nào đó
                    header("Location: /acc/taikhoan/login");
                    exit;
                } else {
                    $_SESSION['message'] = "Có lỗi xảy ra. Vui lòng thử lại.";
                    $_SESSION['message_type'] = "error";
                    $this->view('taikhoan/reset_password');
                    exit;
                }
            } else {
                $_SESSION['message'] = "Mật khẩu và xác nhận mật khẩu không khớp.";
                $_SESSION['message_type'] = "error";
                $this->view('taikhoan/reset_password');
                exit;
            }
        }
    }
    



    public function xulydangnhap() {
        $sdt = $_POST['sdt'] ;
        $password = $_POST['password'] ;
    
        $check_tk = $this->taikhoanModel->check_tk($sdt);
        if ($check_tk && $row = mysqli_fetch_assoc($check_tk)) {
            if (password_verify($password, $row['password'])) {
                // Lưu họ tên vào Session
                $_SESSION['hoten'] = $row['hoten'];
                $_SESSION['sdt'] = $sdt;
    
                // Tùy chọn lưu thông tin đăng nhập (Remember Me)
                if (!empty($_POST['rememberMe'])) {
                    setcookie('login_sdt', $sdt, time() + (7 * 24 * 60 * 60), "/");
                    setcookie('login_password', $password, time() + (7 * 24 * 60 * 60), "/");
                }
                if($row['role']==1){
                    header('Location: /acc/admin/listsp');
                    exit();
                }
                if(isset($_SESSION['loidangnhap'])){
                    unset($_SESSION['loidangnhap']);
                  }
             
    
                header('Location: /acc/trangchu/');
                exit();
            } else {
                $_SESSION['loidangnhap'] = "Bạn đã nhập sai Password.";
            }
        } else {
            $_SESSION['loidangnhap'] = "Không tồn tại tài khoản.";
        }
    
        $this->view('taikhoan/login');
    }
    
public function signup() {
   
    $this->view('taikhoan/signup1');
 
}
public function xulydangky(){
    $hoten = $_POST['hoten'];
    $sdt = $_POST['sdt'];
    $password = $_POST['password'];
    $password_hash= password_hash($password,PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $ngaysinh = $_POST['ngaysinh'];
    echo $ngaysinh ;
    $checksdt= $this->taikhoanModel->check_sdt($sdt);
    $checkemail= $this->taikhoanModel->checkEmailExists($email);
       $i=0 ;
       if(mysqli_num_rows($checksdt)>0){
          
            $_SESSION['trungsdt'] = "SDT này đã tồn tại."; 
           $i=$i+1;
       }
       else{
        if(isset($_SESSION['trungsdt'])){ unset($_SESSION['trungsdt']);}
        $_SESSION['hienthisdt']=$sdt;
       }
       if ($this->taikhoanModel->checkEmailExists($email)) {
        session_start();
        $_SESSION['trungemail'] = "Email này đã tồn tại";
        $i = $i + 1; 
    } 
    
       else{
        if(isset($_SESSION['trungemail'])){ unset($_SESSION['trungemail']);}
        $_SESSION['hienthiemail']=$email;
       }
       if($i==0){
        $object=new taikhoan($hoten,$sdt,$password_hash,$email,$ngaysinh);
         $this->taikhoanModel->themtaikhoan($object);
         if(isset($_SESSION['hienthihoten'])){
            unset($_SESSION['hienthihoten']);
        }
         if(isset($_SESSION['trungsdt'])){ unset($_SESSION['trungsdt']);}
         if(isset($_SESSION['hienthisdt'])){unset($_SESSION['hienthisdt']);}
         if(isset($_SESSION['trungemail'])){unset($_SESSION['trungemail']);}
         if(isset($_SESSION['hienthiemail'])){unset($_SESSION['hienthiemail']);}
         if(isset($_SESSION['hienthipass'])){unset($_SESSION['hienthipass']);}
         header('Location: /acc/taikhoan/login'); 
        }
        else{
          $_SESSION['hienthihoten']=$hoten;
          $_SESSION['hienthipass']=$password;
          header('Location: /acc/taikhoan/signup');
        } 
    }
    public function logout() {
        if(isset($_SESSION['sdt'])){
            unset($_SESSION['sdt']);
            unset($_SESSION['hoten']);
        header('Location: /acc/trangchu/');
        exit();
        }
    }
}
?>