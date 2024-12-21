<?php 
require_once 'core/Controller.php';
// require_once 'app/models/sanpham.php';

class adminController extends Controller {
    private $adminModel;
    public function __construct() {
         $this->adminModel = $this->model('adminModel');
    } 
    public function trangchu(){

    }
    public function listsp() {
        $listsp=$this->adminModel->getlistsanpham();
        $this->view('admin/listsp',['listsp' => $listsp]);

    }
    public function suasp($masanpham) {
        $sanpham=$this->adminModel->getsanpham($masanpham);
        $danhmuc= $this->adminModel->getdanhmuc();
        $this->view('admin/suasp',['sanpham' =>  $sanpham,'danhmuc'=> $danhmuc ]);
    }

    public function xulysuasanpham() {
        $ten_san_pham = $_POST['ten_san_pham'];
        $id_danhmuc= $_POST['danh_muc'];
        $soluong= $_POST['so_luong'];
        $gia_goc=$_POST['gia'];
        $masanpham=$_POST['masanpham'];
        $mota=$_POST['mota'];
        $result=$this->adminModel->getsanpham($masanpham);
        $row= mysqli_fetch_array($result);
        $hinh_anh=$row['hinh_anh'];
        if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['name'] != ''){
            $hinh_anh = $_FILES['hinhanh']['name'];
            $file_tmp =$_FILES['hinhanh']['tmp_name'];  
            move_uploaded_file($file_tmp,"public/img/".$hinh_anh);
         }

       $this->adminModel->suasanpham($masanpham,$ten_san_pham,$id_danhmuc,$soluong,$gia_goc,$mota,$hinh_anh);
        

        $_SESSION['thanhcong']="Bạn đã sửa thành công sản phẩm mã: $masanpham , tên: $ten_san_pham ";
         header("location: /acc/admin/suasp/$masanpham");




    }

    public function themsp() {
        $danhmuc= $this->adminModel->getdanhmuc();
        $this->view('admin/themsp',['danhmuc'=> $danhmuc ]);
    }

    public function xulythemsanpham() {
        $masanpham=$_POST['masanpham'];
        $ten_san_pham = $_POST['ten_san_pham'];
        $id_danhmuc= $_POST['danh_muc'];
        $soluong= $_POST['so_luong'];
        $gia_goc=$_POST['gia'];
        $mota=$_POST['mota'];
        $hinh_anh='';
        if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['name'] != ''){
            $hinh_anh = $_FILES['hinhanh']['name'];
            $file_tmp =$_FILES['hinhanh']['tmp_name'];  
            move_uploaded_file($file_tmp,"public/img/".$hinh_anh);
         }
         $checkma= $this->adminModel->checkmasanpham($masanpham);
         if(mysqli_num_rows($checkma)>0){
            $_SESSION['loi']=" Đã có mã: $masanpham , vui lòng chọn mã khác ";
            header("location: /acc/admin/themsp");
            exit();

         }
         $this->adminModel->themsanpham($masanpham,$ten_san_pham,$id_danhmuc,$soluong,$gia_goc,$mota,$hinh_anh);
        $_SESSION['thanhcong']="Bạn đã thêm thành công sản phẩm mã: $masanpham , tên: $ten_san_pham ";
        header("location: /acc/admin/listsp");




    }
    public function xoasp($masanpham) {
        $this->adminModel->xoasanpham($masanpham);
        $_SESSION['thanhcong']="Bạn đã xóa thành công sản phẩm mã: $masanpham  ";
        header("location: /acc/admin/listsp");
    }
    
    public function listddh() {
        $listddh=$this->adminModel->getddh();
        $chitietddh=$this->adminModel->chitietdonhang();
        $this->view('admin/listddh',['listddh'=>$listddh , 'ctddh' => $chitietddh ]);

    }
    public function xulyxacnhan($id_giohang) {
        $this->adminModel->xacnhan($id_giohang);
        header("location: /acc/admin/listddh");

    }
    public function dashboard(){
      $doanhthu = $this->adminModel->doanhthu();
      $sanphamsaphet = $this->adminModel->sanphamsaphet();
    
        $this->view('admin/dashboard',['doanhthu'=>$doanhthu, 'sanphamsaphet' => $sanphamsaphet]);

    }
    public function getDoanhThuJSON() {
        $month = isset($_POST['month']) ? $_POST['month'] : null; // Get the selected month from POST
        $doanhthu = $this->adminModel->doanhthu($month); // Pass the month to the model
        echo json_encode($doanhthu);
    }
    
}





?>