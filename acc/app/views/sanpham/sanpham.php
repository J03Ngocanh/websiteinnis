<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <style>

        main{
           
            margin-left:50px;
            margin-right: 50px;
            font-family:  "Nunito", sans-serif; ;
         
        }
        
        .danhmuc{
            max-width:300px;
        }
        li{
            list-style: none;
            text-decoration: none;
        }
        a{
            text-decoration: none;
            color:black;
        }
        img{
            width: 200px;
            height:200px;
        }
        .full{
            display:flex;
            margin-bottom: 100px;
        }

        .product{
            margin-left:30px;
        }

        .product-detail{
            display: grid;
            grid-template-columns: 200px 200px 200px 200px;
            grid-template-rows: 340px;
            gap: 80px;
            
        }
        .item {
            flex-direction: column;
            justify-content: space-between;
}


.item .buy-now {
    background-color: white;
    color: green;
    border: 1px solid #12b560 ;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    margin-top: 10px;
    transition: background-color 0.3s ease;
    width: 90%;
    align-items: center;
    text-align: center;
    cursor: pointer;
}

/* Khi hover qua sản phẩm, hiển thị nút "Mua ngay" */
.item:hover .buy-now {
    display: inline-block;
}

/* Khi hover vào nút "Mua ngay", thay đổi màu sắc */
.item .buy-now:hover {
    background-color: #1e8449;
    color: White;
}

    </style>
   <main>
  
<div class="full">
            <div class="danhmuc" >
                <p style="font-size:22px; color:green; font-weight: bold;">Danh mục sản phẩm</p>

                <hr>
                <ul class="chanhoc">
        <?php 
        while($row = mysqli_fetch_array($loaisp)) { 
        ?>
            <li style="text-transform: capitalize; font-size: 15px; padding: 1px; margin: 1px; color:black;">
                <a href="/acc/sanpham/sanpham_loai/<?php echo $row['id_loaisp']?>"><?php echo $row['tenloai']; ?></a>
                <ul class="chanhocx2">
                    <?php 
                    mysqli_data_seek($danhmucsp, 0); 
                    while($huhu = mysqli_fetch_array($danhmucsp)) {
                        if ($huhu['id_loaisp'] == $row['id_loaisp']) {
                    ?>
                        <li style="text-transform: capitalize; font-size: 15px; padding: 1px; margin: 1px; color:black;">
                            <a href="/acc/sanpham/sanpham_danhmuc/<?php echo $huhu['id_danhmuc']?>"><?php echo $huhu['ten_danhmuc']; ?></a>
                        </li>
                    <?php 
                        } 
                    } 
                    ?>
                </ul>
            </li>
        <?php 
        } 
        ?>
    </ul>
            </div>
            <div class="product">
            <p>
                <span style="font-size: 17px; padding-bottom: 5px;">Sản phẩm</span>
                <?php if(isset($tenloai)){
                    $row=mysqli_fetch_array($tenloai);
                    ?>
                   <span>></span>
                   <span><?php echo $row['tenloai'] ;?></span>
                <?php } ?>
                <?php if(isset($tendanhmuc_loai)){
                    $row=mysqli_fetch_array($tendanhmuc_loai);
                    ?>
                   <span>></span>
                   <span><?php echo $row['tenloai'] ;?></span>
                   <span>></span>
                   <span><?php echo $row['ten_danhmuc'] ;?></span>
                <?php } ?>
                </p>
                
                <hr style="margin-top:37px">
    
                <div  class="product-detail"  style="margin-top:20px">
                    <?php
                    while($row = mysqli_fetch_array($sanpham)){
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
                                <button type="submit" class="buy-now">Thêm vào giỏ hàng</button>
                            </form>

                        </div>
                        <?php } ?>
                          

                        </div>  

                
    
                </div>
    
            </div>
            <div class="pagination" style="text-align: center; margin-top: 20px;">
    <!-- Các nút phân trang sẽ được tạo động -->
</div>
</div>
   </main>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Khi người dùng click vào giỏ hàng, AJAX sẽ được gọi
        $('fas fa-shopping-cart').click(function(e) {
            e.preventDefault(); // Ngừng hành động mặc định

            // Gửi yêu cầu AJAX để cập nhật giỏ hàng
            $.ajax({
                url: '<?php echo WEBROOT; ?>giohang/giohang',
                method: 'GET',
                success: function(response) {
                    // Cập nhật phần nội dung giỏ hàng sau khi nhận phản hồi
                    $('.cart-container').html(response);
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error: " + error);
                }
            });
        });
    });
</script>

  
</body>
</html>