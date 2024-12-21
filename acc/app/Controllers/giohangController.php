<?php
require_once 'core/Controller.php';
//require_once 'app/models/giohangModel.php';
class giohangController extends Controller {
    private $giohangModel;

    public function __construct() {
        $this->giohangModel = $this->model('giohangModel');
    }


    public function trangchu() {
        $loaisp= $this->giohangModel->Getloaisp(); 
       $this->view('menu', ['loaisp' => $loaisp]);
         $sdt= $_SESSION['sdt'] ;

        // $id_giohang = $_POST['id_giohang'];
        $laygiohang=$this->giohangModel->layGioHang($sdt);
       
        $Laymagiohang=$this->giohangModel->Laymagiohang($sdt);

        $tongTien = $this->giohangModel->tinhTongTien($sdt);


      $this->view('giohang/giohang', [ 'giohang' => $laygiohang , 'magiohang' => $Laymagiohang, 'tongTien' => $tongTien ]);
      //$this->view('footer');
    }


    public function laygiohang() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['sdt'])) {
            header('Location: ' . WEBROOT . 'taikhoan/login');
            exit();
        }
        $sdt = $_SESSION['sdt'];
        $giohang = $this->giohangModel->layGioHang($sdt);
        // Tính tổng tiền
        $tongTien = 0;
        foreach ($giohang as $item) {
        // Giả sử mỗi sản phẩm có giá và số lượng
            $tongTien += $item['gia_goc'] * $item['soluong'];
        }
        $this->view('giohang/giohang', ['giohang' => $giohang, 'tongTien' => $tongTien]);
    }

    public function themvaogiohang($masanpham) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra người dùng đã đăng nhập
            $sdt = $_SESSION['sdt'] ?? null;
            if (!$sdt) {
                // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
                header('Location: ' . WEBROOT . 'taikhoan/login');
                exit();
            }
    
            // Lấy thông tin sản phẩm
            $thongtinsp = $this->giohangModel->Getttinsanpham($masanpham);
            $row = mysqli_fetch_array($thongtinsp);
            $don_gia = $row['gia_goc'];
            $ten_san_pham = $row['ten_san_pham'];
            // Kiểm tra giỏ hàng
            $checkgiohang = $this->giohangModel->checkgiohang($sdt);
            if (mysqli_num_rows($checkgiohang) == 0) {
                // Tạo giỏ hàng nếu chưa có
                $this->giohangModel->themgiohang($sdt);
            }
    
            // Lấy id_giohang
            $id_giohang_result = $this->giohangModel->Laymagiohang($sdt);
            $row_id = mysqli_fetch_array($id_giohang_result);
            $id_giohang = $row_id['id_giohang'];
            $soluong = 1;
            if(isset($_POST['soluong'])){
                $soluong = $_POST['soluong'];
            }
           
            echo $id_giohang;
            // Kiểm tra sản phẩm trong giỏ hàng
            $kiemtra_sp = $this->giohangModel->kiemtrasp($sdt, $masanpham);

            if (mysqli_num_rows($kiemtra_sp) > 0) {
                // Nếu sản phẩm đã tồn tại, tăng số lượng
                $this->giohangModel->updatesolg($id_giohang, $masanpham, $soluong);
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới
                $this->giohangModel->themspgiohang($id_giohang, $masanpham, $ten_san_pham, $soluong, $don_gia);
            }
    
            // Chuyển hướng về trang giỏ hàng
             header('Location:/acc/giohang/giohang');
            exit();
        }
        // Nếu không phải phương thức POST, hiển thị trang giỏ hàng
        $sdt = $_SESSION['sdt'];
        $giohang = $this->giohangModel->layGioHang($sdt);
        if (!is_array($giohang)) {
            $giohang = []; // Đảm bảo $giohang là mảng để tránh lỗi
        }
        $this->view('giohang/giohang', ['giohang' => $giohang]);
    }

    public function themvaogiohangtrangct($masanpham){
        
    }


    public function xoagiohang() {
        if (isset($_SESSION['sdt'])) {
            $sdt = $_SESSION['sdt'];
            $masanpham = $_POST['masanpham'] ?? null;
        $laymagh=$this->giohangModel->Laymagiohang($sdt);
      
        $row=mysqli_fetch_array($laymagh);
        $id_giohang= $row['id_giohang'];
        
        $this->giohangModel->xoaspgiohang($id_giohang,$masanpham);

        $spgiohang= $this->giohangModel->Getchitietgiohang($id_giohang);
        $soluongsp= mysqli_num_rows($spgiohang);
   if($soluongsp ==0){
    $this->giohangModel->xoagiohang($id_giohang,$sdt);
    unset($_SESSION['soluong']);
   }
   header('Location: ' . WEBROOT . 'giohang/giohang'); 
        exit();
    }
}



    public function tongtien() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sdt = $_SESSION['sdt']; // Lấy số điện thoại của người dùng
            $masanpham = $_POST['masanpham']; // Lấy mã sản phẩm
            $soluong = $_POST['soluong']; // Lấy số lượng mới từ form
            $laymagh=$this->giohangModel->Laymagiohang($sdt);
      
            $row=mysqli_fetch_array($laymagh);
            $id_giohang= $row['id_giohang'];
            
       
    
            if ($sdt && $masanpham && $soluong > 0) {
                // Cập nhật số lượng sản phẩm trong giỏ hàng
                $this->giohangModel->capnhatsoluong($sdt, $masanpham, $soluong);


                // Tính lại tổng tiền
                $tongTien = $this->giohangModel->tinhTongTien($sdt);
              
                $this->giohangModel->capnhattongtien($tongTien, $sdt, $id_giohang);
            
               
                // Trả về tổng tiền mới dưới dạng JSON
              echo json_encode(['tongTien' => number_format($tongTien, 0, ',', '.')]);
            exit();
            }
        }
    }



    public function muangay($masp){
        if(isset($_SESSION['sdt'])){

            $masanpham= $masp;
            $loaisp= $this->giohangModel->Getloaisp();  
            $soluong=$_POST['soluong'];
            $_SESSION['slmuangay']= $soluong;
            $sanphammuangay = $this->giohangModel->layspmuangay($masanpham);
            if (!$sanphammuangay) {
                die("Không tìm thấy sản phẩm với mã: $masanpham");
            }
           $this->view('menu',['loaisp' => $loaisp]);
            $this->view('giohang/thanhtoan',['sanphammuangay' => $sanphammuangay ,  'soluong' => $soluong, 'masp' => $masp ]);
            $this->view('footer');
        }else{
            header('Location: ' . WEBROOT . 'taikhoan/login');
            exit();
        }
       

    }



    public function tienhanhthanhtoan($masp) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loaisp= $this->giohangModel->Getloaisp();  
            // Lấy dữ liệu từ form
            $sdt = $_POST['sdt'];
            $hoten_nhan = $_POST['hoten_nhan'];
            $sdt_nhan = $_POST['sdt_nhan'];
            $diachi_nhan = $_POST['diachi_nhan'];
            $phuong_thuc = $_POST['phuong_thuc'];
            $soluong = $_POST['soluong'];
            echo $soluong;
            $tongTien = $_POST['tongTien'];
            $Ngay_tao = date('Y-m-d H:i:s');
            $this->giohangModel->themmuangay($sdt, $hoten_nhan, $sdt_nhan,$diachi_nhan, $phuong_thuc,$tongTien, $Ngay_tao);

            $aaaa = $this->giohangModel ->layid_giohang($sdt);
            $chothe = mysqli_fetch_array($aaaa);
            $id_giohang = $chothe['maxid'];
            $data = $this->giohangModel->Getttinsanpham($masp);
            $row = mysqli_fetch_array($data);
            $don_gia = $row['gia_goc'];
            
            $ten_san_pham = $row['ten_san_pham'];
            $this->giohangModel->themchitietmuangay($id_giohang,$masp, $ten_san_pham,$soluong, $don_gia);
            $this->giohangModel->updatesolgmuangay($masp, $soluong);

         
        
        
            if ($phuong_thuc == 'chuyen_khoan') {
                // Gọi hàm generateQRCode để tạo mã QR cho chuyển khoản
        
                

               
            } else if ($phuong_thuc == 'tien_mat') {
               echo "<script>alert('Đơn hàng sẽ được giao và thanh toán khi nhận hàng.');</script>";
        }
         header("location: /acc/giohang/hoanthanhthanhtoan/$id_giohang");
            }
    }

    public function thanhtoangiohang($id_giohang){
        $magiohang=$id_giohang;
        $loaisp= $this->giohangModel->Getloaisp();  
        $this->view('menu',['loaisp' => $loaisp]);
        $thongtinsanpham= $this->giohangModel->thongtinsanphamgiohang($id_giohang);
        $this->view('giohang/thanhtoangiohang',['thongtinsanpham' => $thongtinsanpham,'id_giohang' => $magiohang  ]);
        $this->view('footer');
       
    }


 public function tienhanhthanhtoangiohang($id_giohang) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sdt = $_POST['sdt'];
            $hoten_nhan = $_POST['hoten_nhan'];
            $sdt_nhan = $_POST['sdt_nhan'];
            $diachi_nhan = $_POST['diachi_nhan'];
            $phuong_thuc = $_POST['phuong_thuc'];
            $soluong = $_POST['soluong'];
            $tongTien = $_POST['tongTien'];
            $Ngay_tao = date('Y-m-d H:i:s');

          $result = $this->giohangModel->updatedondathang( $tongTien,$id_giohang , $hoten_nhan, $sdt_nhan, $diachi_nhan, $phuong_thuc, $Ngay_tao);
            $ketqua = $this->giohangModel->Laymasanpham($id_giohang);
            echo mysqli_num_rows($ketqua);
            while($row = mysqli_fetch_array($ketqua)){
                $this->giohangModel->updatesolgmuangay($row['masanpham'], $row['soluong']);
            }
            header("location: /acc/giohang/hoanthanhthanhtoan/$id_giohang");
            }
    }

    public function hoanthanhthanhtoan($id_giohang){
        $loaisp= $this->giohangModel->Getloaisp();  
        $this->view('menu',['loaisp' => $loaisp]);
        $ttindonhang = $this->giohangModel->Getttinchitietdonhang($id_giohang);
        $ttinnguoimua = $this->giohangModel->Getttindonhang($id_giohang);
        $this->view('giohang/chitiethoadon' , ['ttindonhang' => $ttindonhang, 'ttinnguoimua' => $ttinnguoimua ]);
        $this->view('footer');




    }

    



}

    


