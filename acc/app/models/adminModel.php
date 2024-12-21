<?php 
require_once './core/model.php';
class adminModel extends Model {
   protected $tblsanpham="sanpham";
   protected $tbldanhmucsp = "danhmucsp";
   protected $tblloaisp='loaisp';
   protected $tblgiohang = "giohang";
   protected $tblchitietgiohang = "chitiet_giohang";

   public fUNCTION getlistsanpham(){
      $sql = "SELECT * FROM $this->tblsanpham ";
      $result = $this->con->query($sql);
      return $result;
  }
  public fUNCTION getsanpham($masanpham){
   $sql = "SELECT * FROM $this->tblsanpham WHERE masanpham='$masanpham' ";
   $result = $this->con->query($sql);
   return $result;
}

public fUNCTION getdanhmuc(){
   $sql = "SELECT * FROM $this->tbldanhmucsp  ";
   $result = $this->con->query($sql);
   return $result;
}

public fUNCTION suasanpham($masanpham,$ten_san_pham,$id_danhmuc,$soluong,$gia_goc,$mota,$hinh_anh){
   $sql = " UPDATE $this->tblsanpham SET ten_san_pham='$ten_san_pham',mo_ta='$mota',gia_goc=$gia_goc,hinh_anh='$hinh_anh',soluong=$soluong,id_danhmuc=$id_danhmuc
   WHERE masanpham='$masanpham'";
   echo $sql ;
   $result = $this->con->query($sql);
   return $result;
}
public fUNCTION themsanpham($masanpham,$ten_san_pham,$id_danhmuc,$soluong,$gia_goc,$mota,$hinh_anh){
   $sql = "INSERT INTO $this->tblsanpham(masanpham,id_danhmuc,ten_san_pham,mo_ta,gia_goc,hinh_anh,soluong)  
   VALUES('$masanpham',$id_danhmuc,'$ten_san_pham','$mota',$gia_goc,'$hinh_anh',$soluong)
   ";
   echo $sql;
   $result = $this->con->query($sql);
   return $result;
}

public fUNCTION checkmasanpham($masanpham){
   $sql = "SELECT * FROM $this->tblsanpham WHERE masanpham='$masanpham' ";
   $result = $this->con->query($sql);
   return $result;
}

public fUNCTION xoasanpham($masanpham){
   $sql = "DELETE FROM $this->tblsanpham  WHERE masanpham='$masanpham' ";
   $result = $this->con->query($sql);
   return $result;
}
public fUNCTION getddh(){
   $sql = "SELECT * FROM $this->tblgiohang WHERE active=1  ";
   $result = $this->con->query($sql);
   return $result;
}

public fUNCTION xacnhan($id_giohang){
   $sql = " UPDATE $this->tblgiohang  SET trangthai='Đã thanh toán' WHERE id_giohang=  $id_giohang ";
   $result = $this->con->query($sql);
   return $result;
}
public fUNCTION chitietdonhang(){
   $sql = "SELECT $this->tblchitietgiohang.*, $this->tblsanpham.hinh_anh  FROM $this->tblchitietgiohang INNER JOIN $this->tblsanpham
   ON $this->tblchitietgiohang.masanpham = $this->tblsanpham.masanpham
       ";
   $result = $this->con->query($sql);
   return $result;
}

// SELECT 
//                 DATE(ngaydat) AS ngay,
//                 SUM(tongtien) AS doanhthu
//             FROM $this->tabledondathang
//             WHERE active = 1";

//     if ($month) {
//         $sql .= " AND DATE_FORMAT(ngaydat, '%Y-%m') = ?"; // Filter by month
//     }

//     $sql .= " GROUP BY DATE(ngaydat)
//               ORDER BY ngay ASC";

//     $stmt = $this->con->prepare($sql);
//     if ($month) {
//         $stmt->bind_param("s", $month);
//     }
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $data = [];
//     while ($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }

//     return $data;

   // Phương thức lấy doanh thu theo tháng và năm
   public function doanhthu($month = null){
       // Lấy tất cả các dữ liệu về tháng và năm từ bảng orders
       $sql = "SELECT 
            DATE(ngay_tao) AS ngay, 
            SUM(tongtien) AS doanhthu 
        FROM $this->tblgiohang 
        WHERE ((phuong_thuc = 'chuyen_khoan' AND trangthai = 'Đã thanh toán') 
               OR (phuong_thuc = 'tien_mat' AND trangthai = 'Đang xử lý')) 
          AND phuong_thuc IS NOT NULL";
   if ($month) {
      $sql .= " AND DATE_FORMAT(ngay_tao, '%Y-%m') = ?"; // Lọc theo tháng nếu có
  }
  
  $sql .= " GROUP BY DATE(ngay_tao) 
            ORDER BY ngay ASC";
  
  $stmt = $this->con->prepare($sql);
  if ($month) {
      $stmt->bind_param("s", $month);
  }
  
  $stmt->execute();
  $result = $stmt->get_result();
  $data = [];
  
  while ($row = $result->fetch_assoc()) {
      $data[] = $row;
  }
  
  return $data;
  
   }

   public function sanphamsaphet(){
      $sql = "SELECT masanpham, soluong
FROM $this->tblsanpham
WHERE soluong < 15
ORDER BY soluong ASC;
";
$result = $this->con->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

return $data;

 
   }

 
}


    

?>