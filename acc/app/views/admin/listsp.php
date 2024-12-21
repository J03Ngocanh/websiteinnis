<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang Quản Trị</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
  </head>
  <style>
    /* styles.css */
    body {
      font-family: 'nunito', sans-serif;
      margin: 0;
      display: flex;
      height: 100vh;
      background-color: #f4f4f9;
    }

    .admin-container {
      display: flex;
      width: 100%;
    }

    .sidebar {
      width: 250px;
      background-color: #2c3e50;
      color: #ecf0f1;
      height: 100%;
      display: flex;
      flex-direction: column;
      padding: 20px;
      box-sizing: border-box;
      position: relative;
    }

    .sidebar h2 {
      margin-bottom: 20px;
      font-size: 24px;
      text-align: center;
      color: #1abc9c;
    }

    .sidebar nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar nav ul li {
      margin: 15px 0;
    }

    .sidebar nav ul li a {
      color: #ecf0f1;
      text-decoration: none;
      font-size: 18px;
      padding: 10px 15px;
      display: block;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .sidebar nav ul li a.active {
      background-color: #1abc9c;
      color: #fff;
    }

    .sidebar nav ul li a:hover {
      background-color: #34495e;
    }

    .main-content {
      flex: 1;
      padding: 20px;
      box-sizing: border-box;
      overflow-y: auto;
    }

    .main-content header {
      background-color: #1abc9c;
      padding: 20px;
      color: #fff;
      text-align: center;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .content-section {
      display: none;
    }

    .content-section:not(.hidden) {
      display: block;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    table th,
    table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    table th {
      background-color: #1abc9c;
      color: white;
    }

    table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    table tr:hover {
      background-color: #ddd;
    }





    /* Nút chung */
a button {
    padding: 8px 12px;
    margin: 5px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    text-decoration: none; /* Loại bỏ gạch chân mặc định của <a> */
    display: inline-block; /* Đảm bảo hiển thị đều */
}

/* Nút "Sửa" */
a .edit-btn {
    background-color: #3498db; /* Màu xanh */
    color: white;
}

a .edit-btn:hover {
    background-color: #2980b9;
    transform: scale(1.05);
}

/* Nút "Xóa" */
a .delete-btn {
    background-color: #e74c3c; /* Màu đỏ */
    color: white;
}

a .delete-btn:hover {
    background-color: #c0392b;
    transform: scale(1.05);
}

a .add-btn {
    background-color: #2ecc71; /* Màu xanh lá */
    color: white;
    font-weight: bold;
}

a .add-btn:hover {
    background-color: #27ae60; /* Màu xanh lá đậm khi hover */
    transform: scale(1.05); /* Phóng to nhẹ khi hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Thêm bóng đổ để nổi bật */
}





  </style>
  <body>
    <div class="admin-container">
      <!-- Sidebar -->
      <aside class="sidebar">
      <h2>Quản Trị</h2>
        <nav>
          <ul>
          <li>
            <a 
            class=""
            href="/acc/admin/dashboard" 
            >Tổng quan</a
              >
            </li>
            <li>
              
              <a 
              class="active"
              href="/acc/admin/listsp" 
                >Danh Sách Sản Phẩm</a
              >
            </li>
            <li>
              <a href="/acc/admin/listddh" 
                >Đơn Đặt Hàng</a
              >
            </li>
           
            <li><a href="<?php echo WEBROOT; ?>taikhoan/logout">Đăng Xuất</a></li>
          </ul>
        </nav>
      </aside>

      <!-- Main Content -->
      <main class="main-content">
        <header>
          <h1>Trang Quản Trị</h1>
        </header>

        <!-- Sections -->
        <section id="products" class="content-section">
          <h2>Danh Sách Sản Phẩm</h2>
          <table>
            <thead>
              <tr>
                <th>STT</th>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                while($row=mysqli_fetch_array($listsp)){?>
              <tr>
                <td><?php echo $i;  ?></td>
                <td><?php echo $row['masanpham']  ?></td>
                <td><?php echo $row['ten_san_pham']  ?></td>
                <td><img style="width:100px" src="<?php echo WEBROOT . 'public/img/' . $row['hinh_anh']; ?>" alt=""></td>
                <td><?php echo number_format($row['gia_goc'], 0, ',', '.'); ?> VNĐ</td>
                <td><?php echo $row['soluong']  ?></td>
                <td>
                   <a href="/acc/admin/suasp/<?php echo $row['masanpham'] ?>"><button class="btn edit-btn">Sửa</button></a>
                    <a href="/acc/admin/xoasp/<?php echo $row['masanpham'] ?>" onclick="return confirmCustom('Bạn chắc chắn muốn xóa sản phẩm mã : <?php echo $row['masanpham'] ?>. tên: <?php echo $row['ten_san_pham'] ?>')  "><button class="btn delete-btn">Xóa</button></a>
                </td>

              </tr>
              <?php $i++; }?>
            </tbody>
          </table>
          <a href="/acc/admin/themsp"><button class="btn add-btn">Thêm sản phẩm </button></a>
        </section>
        <?php 
if (isset($_SESSION['thanhcong'])) {
    echo "<script>alert('" . addslashes($_SESSION['thanhcong']) . "');</script>";
    unset($_SESSION['thanhcong']);
}
?>
        
      </main>
    </div>
    <script>
  function confirmCustom(message) {
    const isConfirmed = window.confirm(message);
    return isConfirmed;
}
</script>
  </body>
</html>

