<?php 
require_once './core/model.php';
class taikhoanModel extends Model {
   protected $tbltk="taikhoan";

   public function check_tk($sdt){
    $sql = "SELECT * FROM $this->tbltk WHERE (sdt = '$sdt' OR email = '$sdt')";
    $result=$this->con->query($sql);
    return $result;
   }
   
   public function check_sdt($sdt){
     $sql = "SELECT * FROM $this->tbltk WHERE sdt='$sdt'";
     $result=$this->con->query($sql);
     return $result;
    }

    public function checkEmailExists($email) {
        $sql = "SELECT * FROM taikhoan WHERE email = '$email'";
        $result = $this->con->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Lưu mã xác nhận vào cơ sở dữ liệu
    public function saveVerificationCode($userId, $verificationCode) {
        $sql = "UPDATE taikhoan SET verification_code = '$verificationCode' WHERE id = $userId";
        return $this->con->query($sql);
    }


    // Kiểm tra mã xác nhận
    public function checkVerificationCode($userId, $verificationCode) {
        $sql = "SELECT * FROM taikhoan WHERE id = $userId AND verification_code = '$verificationCode'";
        $result = $this->con->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }


    // Cập nhật mật khẩu mới
    public function updatePassword($email, $newPassword) {
        $sql = "UPDATE taikhoan SET password = '$newPassword' WHERE email = '$email'";
        return $this->con->query($sql);
    }
    public function themtaikhoan($object) {
        $thuocTinh =get_object_vars($object);
        $slthuoctinh=count($thuocTinh);
        $query = "INSERT INTO $this->tbltk(hoten,sdt,password,email,ngaysinh) VALUES ("; 
        $i=1;
        foreach ($thuocTinh as $key => $value) {
            
            if (is_string($value))
                $query.="'$value'";
            else
                $query.="$value";
            if ($i!=$slthuoctinh)
                $query.=",";
            $i=$i+1;

        }
        $query.=")";
        echo $query ;
       
        return $this->con->query($query);
    }

}
?>