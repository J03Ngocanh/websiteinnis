<?php 
require_once './core/model.php';
class trangchuModel extends Model {
   protected $tblloaisp='loaisp';
   protected $tblsanpham = 'sanpham';
   protected $tblchitietgiohang = 'chitiet_giohang';
   protected $tblgiohang = 'giohang';

   public function Getloaisp(){
    $sql = "SELECT * FROM $this->tblloaisp ";
    $result=$this->con->query($sql);
    return $result;
   }

   public function laybestseller(){
    $sql = "SELECT 
    sp.masanpham,
    sp.ten_san_pham, 
    sp.hinh_anh, 
    sp.gia_goc,
    SUM(ctgh.soluong) AS total_sold
FROM {$this->tblchitietgiohang} AS ctgh
INNER JOIN {$this->tblgiohang} AS gh 
    ON ctgh.id_giohang = gh.id_giohang
INNER JOIN {$this->tblsanpham} AS sp 
    ON ctgh.masanpham = sp.masanpham
WHERE gh.active = 1
GROUP BY sp.masanpham
ORDER BY total_sold DESC
LIMIT 4";

$result = $this->con->query($sql);
return $result;

}
 public function laynewitem(){
    $sql = "SELECT 
    sp.masanpham,
    sp.ten_san_pham, 
    sp.hinh_anh, 
    sp.gia_goc
FROM {$this->tblsanpham} AS sp
ORDER BY sp.ngay_them DESC
LIMIT 4";
$result = $this->con->query($sql);
return $result;
 }
}


?>