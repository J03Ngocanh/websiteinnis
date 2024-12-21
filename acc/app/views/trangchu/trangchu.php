<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innisfree</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<style>
    body {
  font-family: 'Nunito', sans-serif;
}

.event-blog-section {
  text-align: center;
  padding: 40px;
  background-color: #f9f9f9;
}

.section-title {
  font-size: 28px;
  color: green;
  margin-bottom: 20px;
  
}

.blogs {
  display: flex;
  justify-content: center;
  gap: 20px;
}

.blog {
  width: 300px;
  cursor: pointer;
  border: 1px solid #ddd;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.blog img {
  width: 100%;
  height: auto;
}

.blog h3 {
  padding: 10px;
  font-size: 18px;
  color: #555;
}
.section-title {
  font-size: 36px;
  font-weight: bold;
  text-transform: uppercase;
  /* color: #2c3e50; */
  position: relative;
  display: inline-block;
  padding-bottom: 10px;
  margin-bottom: 20px;
  background: linear-gradient(to right, #16a085, #16a085);
  background-clip: text;
  -webkit-text-fill-color: transparent;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 80%;
  height: 4px;
  background: linear-gradient(to right, #16a085, #16a085);
  border-radius: 10px;
  animation: underline-animation 1s infinite alternate ease-in-out;
}

.member-benefits {
    background-color: #f9f9f9;
    text-align: center;
    padding: 20px;
}

.member-benefits h2 {
    font-size: 36px;
    margin-bottom: 20px;
    font-weight: bold;
}

.benefits-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-top:30px;
}

.benefit-item {
    text-align: center;
    width: 200px;
    transition: transform 0.3s ease; /* Hiệu ứng tổng thể */
}
.benefit-item:hover {
    transform: scale(1.1); /* Phóng to toàn bộ benefit-item */
}

.benefit-item .icon {
    border: 2px solid #139b43 ;
    border-radius: 50%;
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
}

.benefit-item .icon img {
    width: 40px;
    height: 40px;
}

.benefit-item p {
    margin: 0;
    font-size: 18px;
    color: #333;
    transition: transform 0.3s ease, color 0.3s ease; /* Hiệu ứng chữ */
}
.benefit-item .icon {
    border: 2px solid #139b43;
    border-radius: 50%;
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    transition: transform 0.3s ease, border-color 0.3s ease;
}
.benefit-item:hover .icon {
    border-color: #16a085; /* Thay đổi màu viền */
}
.benefit-item:hover p {
    transform: scale(1.1); /* Phóng to chữ */
    color: #16a085; /* Thay đổi màu chữ */
}

.benefit-item .icon img {
    width: 40px;
    height: 40px;
    transition: transform 0.3s ease;
}

.benefit-item:hover .icon {
    transform: scale(1.1);
    border-color: #16a085;
}

.benefit-item:hover .icon img {
    transform: scale(1.2);
}
.product-detail {
    display: grid;
    grid-template-columns: repeat(4, 270px);
    height: 400px;
    gap: 20px;
    margin-top: 20px;
    padding: 0 20px;
    justify-content: center;
    align-items: center;
}

.item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.item:hover {
    transform: scale(1.05); /* Hiệu ứng phóng to khi hover */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.item img {
    width: 80%;
    height: 230px; /* Cố định chiều cao cho hình ảnh */
    object-fit: cover;
    transition: transform 0.3s ease;
    padding-top:20px;
    
}

.item img:hover {
    transform: scale(1.1); /* Phóng to hình ảnh khi hover */
}

.item p {
    font-size: 14px;
    color: #555;
    margin: 10px 0;
}

.item span {
    display: block;
    height: 1px;
    background-color: #ddd;
    margin: 10px 0;
}

.item .buy-now {
    background-color: #16a085;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.item .buy-now:hover {
    background-color: #139b43; /* Màu khi hover */
}
.left{
    z-index:-10;
}

</style>
<body>
    <?php 
     if(isset( $_SESSION['loidangnhap'])){
        unset( $_SESSION['loidangnhap']);
     }
    ?>
    <div class="snow-container"></div>
    
        <div class='anh_giua'>
            <img src="<?php echo WEBROOT; ?>public/img/anh_giua.jpeg" alt="anh giua">
        </div>
        <div class='anh_ngang'>
            <img src="<?php echo WEBROOT; ?>public/img/anh_ngang.jpg" alt="anh ngang">
        </div>
        <div class='anh_doc'>
            <img src="<?php echo WEBROOT; ?>public/img/anh_doc.jpg" alt="anh doc">
        </div>
       <div class="slider" style="display: flex;">
            <div class='left'>
                <div class="slogan" style="margin-top:-40px,">
            <p style= "font-size: 26px">"Effective, nature-powered </p>
            <p style="text-transform: uppercase;font-weight:bolder; font-size:50px; margin-top: -30px; letter-spacing: 5px;"> skincare </p>  
            <p style="margin-top:-60px">discovered from the island"</p>
            <p style="font-size: 17px; font-style: italic;  text-align: justify; max-width: 100%">Innisfree, the pure island where clean nature and healthy beauty coexist in harmony. Innisfree is a natural brand that shares the benefits of nature from the pristine island of Jeju for healthy beauty and pursues an eco-friendly green life to preserve the balance of nature</p>
                 </div>
                 <div id="shop-now">
                      <a href="<?php echo WEBROOT . 'sanpham/sanpham' ?>"><button>SHOP NOW</button></a>
                </div>

            </div>
            <div class='right'></div>
       </div>
    </div>
    <p>Chatbot sẽ xuất hiện ở đây.</p>

<!-- Mã nhúng Landbot -->
<script>
window.addEventListener('mouseover', initLandbot, { once: true });
window.addEventListener('touchstart', initLandbot, { once: true });
var myLandbot;
function initLandbot() {
  if (!myLandbot) {
    var s = document.createElement('script');s.type = 'text/javascript';s.async = true;
    s.addEventListener('load', function() {
      var myLandbot = new Landbot.Livechat({
        configUrl: 'https://storage.googleapis.com/landbot.online/v3/H-2721772-J7VDBWQEF6L7JZWV/index.json',
      });
    });
    s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.js';
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
  }
}
</script>
<script async src="https://static.landbot.io/landbot-widget/landbot-widget.js"></script>


 
<section class="event-blog-section">
      <h2 class="section-title">BEST SELLER</h2>
                  
                  <div  class="product-detail"  style="margin-top:20px">
                      <?php
                      while($row = mysqli_fetch_array($best)){
                          ?>
                          
                          <div class="item"> 
                              <a href="<?php echo WEBROOT . 'sanpham/chitietsp/' . $row['masanpham']; ?>"><img src="<?php echo WEBROOT; ?>public/img/<?php echo $row['hinh_anh'] ?>"  alt=""></a>
                              
                          
                              <a href="<?php echo WEBROOT . 'sanpham/chitietsp/' . $row['masanpham']; ?>"><p  style="font-size: 12px;"><?php echo $row['ten_san_pham']?></p></a>
                            
                              <span></span>
                              <p style="margin-top:-5px;">
                                   <a href="<?php echo WEBROOT . 'sanpham/chitietsp/' . $row['masanpham']; ?>" style="color:green; font-weight:bold; text-decoration:none;">
                                   VND <?php echo number_format($row['gia_goc'], 0, ',', '.'); ?>đ
                                  </a>
                              </p>
                              <form action="/acc/giohang/themvaogiohang/<?php echo $row['masanpham']; ?>" method="POST">
                                  <input type="hidden" name="masanpham" value="<?= htmlspecialchars($row['masanpham']) ?>">
                                  <button style="margin-bottom: 20px;" type="submit" class="buy-now">Thêm vào giỏ hàng</button>
                              </form>
  
                          </div>
                          <?php } ?>
                            
  
                          </div>  
</section>

<section class="event-blog-section">
      <h2 class="section-title">NEW ITEMS</h2>
                  
                  <div  class="product-detail"  style="margin-top:20px">
                      <?php
                      while($row = mysqli_fetch_array($new)){
                          ?>
                          
                          <div class="item"> 
                              <a href="<?php echo WEBROOT . 'sanpham/chitietsp/' . $row['masanpham']; ?>"><img src="<?php echo WEBROOT; ?>public/img/<?php echo $row['hinh_anh'] ?>"  alt=""></a>
                              
                          
                              <a href="<?php echo WEBROOT . 'sanpham/chitietsp/' . $row['masanpham']; ?>"><p  style="font-size: 12px;"><?php echo $row['ten_san_pham']?></p></a>
                            
                              <span></span>
                              <p style="margin-top:-5px;">
                                   <a href="<?php echo WEBROOT . 'sanpham/chitietsp/' . $row['masanpham']; ?>" style="color:green; font-weight:bold; text-decoration:none;">
                                   VND <?php echo number_format($row['gia_goc'], 0, ',', '.'); ?>đ
                                  </a>
                              </p>
                              <form action="/acc/giohang/themvaogiohang/<?php echo $row['masanpham']; ?>" method="POST">
                                  <input type="hidden" name="masanpham" value="<?= htmlspecialchars($row['masanpham']) ?>">
                                  <button style="margin-bottom: 20px;" type="submit" class="buy-now">Thêm vào giỏ hàng</button>
                              </form>
  
                          </div>
                          <?php } ?>
                            
  
                          </div>  
</section>

                

    <section class="event-blog-section">
  <h2 class="section-title">EVENT BLOG</h2>
  <div class="blogs">
    <div class="blog" data-id="blog1">
    <a href="<?php echo WEBROOT; ?>veinnis/blog1">
      <img style = "width:" src="<?php echo WEBROOT; ?>public/img/blog1.png" alt="blog1">
     
    </a>
    </div>
    <div class="blog" data-id="blog2">
    <a href="<?php echo WEBROOT; ?>veinnis/blog2">
    <img src="<?php echo WEBROOT; ?>public/img/blog2.png" alt="blog2">
   
    </a>
    </div>
  </div>
</section>

<div class="member-benefits">
        <h2 class="section-title">CHÍNH SÁCH </h2>
        <div class="benefits-container">
          
        <div class="benefit-item">
                <a href="/acc/app/views/chinhsach/muahang.php">
                  <div class="icon">
                      <img src="<?php echo WEBROOT; ?>public/img/1.png" alt="Voucher ưu đãi">
                  </div>
                  <p>Chính sách mua hàng</p>
                </a>
            </div>
         
       
       
            <div class="benefit-item">
                <a href="/acc/app/views/chinhsach/trahang.php">
                  <div class="icon">
                      <img src="<?php echo WEBROOT; ?>public/img/2.png" alt="Voucher ưu đãi">
                  </div>
                  <p>Chính sách trả hàng</p>
                </a>
            </div>

            <div class="benefit-item">
                <a href="/acc/app/views/chinhsach/giaohang.php">
                  <div class="icon">
                      <img src="<?php echo WEBROOT; ?>public/img/3.png" alt="">
                  </div>
                  <p>Dịch vụ giao hàng</p>
                </a>
            </div>

            <div class="benefit-item">
               <a href="/acc/app/views/chinhsach/pttt.php">
                  <div class="icon">
                      <img src="<?php echo WEBROOT; ?>public/img/4.png" alt="Phương thức thanh toán">
                  </div>
                  <p>Phương thức thanh toán</p>
               </a>
            </div>
        </div>
    </div>

    
    <script src="<?php echo WEBROOT; ?>java/script.js"></script>
 
</body>
</html>
