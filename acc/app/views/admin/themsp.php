<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="https://cdn.tiny.cloud/1/fu913pcqvkkjh88a0sbfv2ujw5rgt3bh3w46uhb7drzy233p/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '.mytextarea',
        plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Dec 16, 2024:
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      // Early access to document converters
      'importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),

      });
      
    </script>

  </head>
  <style>
    /* styles.css */
    body {
      font-family: Arial, sans-serif;
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


    /* Căn chỉnh chung cho form */
.form-edit-product {
    max-width: 1200px;
    margin: 20px auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-edit-product label {
    font-weight: bold;
    margin-bottom: 5px;
}

.form-edit-product input, 
.form-edit-product select, 
.form-edit-product textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    width: 100%;
}

.form-edit-product textarea {
    resize: none;
}

.form-edit-product img {
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

/* Nút */
.form-edit-product .btn {
    padding: 10px 16px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.form-edit-product .submit-btn {
    background-color: #1abc9c;
    color: white;
}

.form-edit-product .submit-btn:hover {
    background-color: #16a085;
    transform: scale(1.05);
}

.form-edit-product .reset-btn {
    background-color: #e74c3c;
    color: white;
}

.form-edit-product .reset-btn:hover {
    background-color: #c0392b;
    transform: scale(1.05);
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
        <section id="products" class="content-section">
         <a href="/acc/admin/listsp" style="text-decoration:none"><h3>🔙Quay lại danh sách</h3></a>
        <h2>Thêm sản phẩm mới </h2>
        <form action="/acc/admin/xulythemsanpham" method="POST" enctype="multipart/form-data" class="form-edit-product">
        <label for="product-name">Mã sản phẩm:</label>
         <input type="text" name="masanpham" value="" required>
        <label for="product-name">Tên sản phẩm:</label>
        <input type="text" id="product-name" name="ten_san_pham" value="" required>
        <label for="product-quantity">Số lượng:</label>
        <input type="number" id="product-quantity" name="so_luong" value="" min="1" required>

        <label for="product-category">Danh mục:</label>
        <select id="product-category" name="danh_muc" >
           <?php while($row_danhmuc=mysqli_fetch_array($danhmuc)){?>
            
            <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['ten_danhmuc'] ?></option>

            <?php }?>
        </select>

        <label for="product-description">Mô tả sản phẩm:</label>
        <textarea class="mytextarea" name="mota" ></textarea>
        <label for="product-price">Giá sản phẩm:</label>
        <input type="number" id="product-price" name="gia" value="" min="0" required>

        <label for="product-image">Hình ảnh:</label>
        <input type="file" id="product-image" name="hinhanh" accept="image/*" required>
        <button type="submit" class="btn submit-btn">Thêm sản phẩm </button>
        <button type="reset" class="btn reset-btn">Làm mới</button>
    </form>

        </section>

        
      </main>
    </div>

    <script >
  document.addEventListener('DOMContentLoaded', () => {
  const fileInput = document.getElementById('product-image');
  const formResetButton = document.querySelector('.form-edit-product .reset-btn');
  const previewImageContainer = document.createElement('div');

  // Thêm container hiển thị ảnh xem trước
  previewImageContainer.style.marginTop = '10px';
  previewImageContainer.innerHTML = '<img id="preview-image" style="width: 500px; display: none; border: 1px solid #ccc; border-radius: 5px;" />';
  fileInput.insertAdjacentElement('afterend', previewImageContainer);

  const previewImage = document.getElementById('preview-image');

  fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];

    // Kiểm tra nếu không có file
    if (!file) {
      previewImage.style.display = 'none';
      return;
    }

    // Kiểm tra loại file
    if (!file.type.startsWith('image/')) {
      alert('Vui lòng chọn tệp ảnh hợp lệ!');
      fileInput.value = '';
      previewImage.style.display = 'none';
      return;
    }

    // Kiểm tra kích thước file
    if (file.size > 2 * 1024 * 1024) {
      alert('Kích thước tệp không được vượt quá 2MB!');
      fileInput.value = '';
      previewImage.style.display = 'none';
      return;
    }

    // Hiển thị ảnh xem trước
    const reader = new FileReader();
    reader.onload = (e) => {
      previewImage.src = e.target.result;
      previewImage.style.display = 'block';
    };
    reader.readAsDataURL(file);
  });

  // Reset ảnh xem trước khi nhấn nút làm mới
  formResetButton.addEventListener('click', () => {
    previewImage.style.display = 'none';
    fileInput.value = '';
  });
});

</script>
<?php 
if (isset($_SESSION['loi'])) {
    echo "<script>alert('" . addslashes($_SESSION['loi']) . "');</script>";
    unset($_SESSION['loi']);
}
?>


    
  </body>
</html>

