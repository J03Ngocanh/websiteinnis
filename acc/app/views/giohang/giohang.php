<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="<?php echo WEBROOT; ?>public/huhu.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .duong_dan ul li .dropdown-menu {
            display: none; 
        }
        .cart-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            color: green; /* Đổi màu chữ thành xanh lá */
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .cart-table th {
            background-color: #4CAF50; /* Màu xanh lá cho tiêu đề bảng */
            color: white;
        }
        .cart-container h1 {
            color: #4CAF50; /* Màu xanh lá cho tiêu đề */
        }
        .quantity-input {
            width: 60px;
        }
        .delete-btn {
            color: red;
            cursor: pointer;
        }
        .btn-quaylai {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }

        .btn-quaylai:hover {
            background-color: #218838;
        }
        .tongTien {
            position: fixed;
            right: 20px; /* Cách cạnh phải màn hình 20px */
            bottom: 80px; /* Cách đáy màn hình 80px (có thể chỉnh theo nhu cầu) */
            background-color: #f8f8f8;
            padding: 15px;
            border: 1px solid #ddd;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            font-size: 20px;
            color: #333;
            text-align: right;
            width: 250px; /* Chiều rộng của hộp chứa tổng tiền */
            border-radius: 8px;
        }
        .thanh-toan {
            position: fixed;
            right: 20px; /* Cách cạnh phải màn hình 20px */
            bottom: 20px; /* Cách đáy màn hình 20px */
        }

        .btn-thanh-toan{
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            font-size: 20px;
        }
        .btn-thanh-toan:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <br>
    <br><br>
    <div class="cart-container">
        <h1>Giỏ hàng</h1>
        <?php if (!empty($data['giohang'])): ?>
        <table class="cart-table">
            <thead> 
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; ?>
                <?php foreach ($data['giohang'] as $item): ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= htmlspecialchars($item['masanpham']) ?></td>
                    <td><?= htmlspecialchars($item['ten_san_pham'])?></td>
                    <td><img style="width:50px; height:auto;" src="<?php echo WEBROOT; ?>public/img/<?php echo $item['hinh_anh'] ?>" alt="product"></td>
                    <td>
                       
                    <p style=" font-size:12px;">
                        VND <?php echo number_format($item['gia_goc'], 0, ',', '.'); ?>đ
                    </p>
                    <span></span>
                    </td>
                    <td>
                    <input type="number" class="quantity-input" data-masanpham="<?= htmlspecialchars($item['masanpham']) ?>" value="<?= htmlspecialchars($item['soluong']) ?>" min="1" step="1">
                    </td>
                    <td>
                    
                     <form method="POST" action="<?= WEBROOT ?>giohang/xoagiohang" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                     <input type="hidden" name="masanpham" value="<?= htmlspecialchars($item['masanpham']) ?>">
                     <button type="submit" name="delete">Xóa</button>
                     </form>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>Giỏ hàng của bạn đang trống.</p>
        <?php endif; ?>
        <!-- Nút quay lại trang chủ -->
        <div class="quaylai">
            <a href="<?php echo WEBROOT;?>sanpham/sanpham" class="btn-quaylai">Quay lại Trang Sản Phẩm</a>
        </div>
        <!-- Hiển thị tổng tiền -->
        <div class="tongTien" id="tongTien">
       
    <h3>Tổng tiền: <?php echo number_format($tongTien, 0, ',', '.'); ?> VNĐ</h3>
</div>
        <!-- Nút thanh toán -->
        <div class="thanh-toan">
        <a href="<?php echo WEBROOT; ?>giohang/thanhtoangiohang/<?php echo $item['id_giohang']; ?>" class="btn-thanh-toan">Thanh toán</a>
   
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
        $(document).ready(function () {
        // Khi click vào biểu tượng giỏ hàng
        $('.fas.fa-shopping-cart').click(function (e) {
            e.preventDefault(); // Ngăn hành động mặc định
    
            // Gửi yêu cầu AJAX
            $.ajax({
                url: '<?php echo WEBROOT; ?>giohang/giohang',
                method: 'GET',
                success: function (response) {
                    // Cập nhật nội dung giỏ hàng
                    $('.cart-container').html(response);
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error: " + error);
                }
            });
        });
    
    

        // Hàm gửi AJAX cập nhật số lượng
        function updateQuantity(masanpham, soluong) {
            $.ajax({
                url: '<?= WEBROOT ?>giohang/tongtien',
                method: 'POST',
                data: { masanpham: masanpham, soluong: soluong },
                success: function (response) {
                    try {
                        const data = JSON.parse(response);
                        if (data.error) {
                            alert(data.error);
                        } else {
                            // Cập nhật tổng tiền
                            $('.tongTien h3').text(`Tổng tiền: ${data.tongTien} VNĐ`);
                        }
                    } catch (e) {
                        console.error("Lỗi xử lý JSON:", e);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error: " + error);
                }
            });
        }

        // Lắng nghe sự kiện thay đổi số lượng
        $('.quantity-input').on('change keydown', function (e) {
            if (e.type === 'change' || (e.type === 'keydown' && e.key === 'Enter')) {
                const masanpham = $(this).data('masanpham');
                const soluong = $(this).val();
                if (soluong > 0) {
                    updateQuantity(masanpham, soluong);
                } else {
                    alert("Số lượng phải lớn hơn 0!");
                }
            }
        });
    });

  </script>
</body>
</html>
