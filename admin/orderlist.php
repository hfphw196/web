<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>
  <!--                  login                          -->
  <div class="wrapper">
            <span class="icon-close"><ion-icon name="close"></ion-icon></span>

            <?php
    if ($isLoggedIn) {
        // Nếu đã đăng nhập, hiển thị thông tin người dùng và nút đăng xuất
        echo '<div class="form-box login">
                <h2>User Information</h2>
                <p>Welcome, ' . $_SESSION['user_name'] . '!</p>
                <form action="logout.php" method="post"> 
                    <button type="submit" id="dangxuat" name="dangxuat" style="background-color: #ff0000; color: #fff; padding: 10px 15px; border: none; cursor: pointer; border-radius: 5px; display: flex;">Log Out</button>
                </form>
                <style>
                    #dangxuat {
                        background-color: #ff0000; 
                        color: #fff; 
                        padding: 10px 15px; 
                        border: none; 
                        cursor: pointer; 
                        border-radius: 5px; 
                    }
                
                    #dangxuat:hover {
                        background-color: #cc0000; 
                    }
                </style>

              
            </div>';
    } 

    if ($_SESSION['role'] != 1) {
        // Người dùng không có quyền truy cập, có thể chuyển hướng hoặc thực hiện các hành động khác
        echo 'Bạn không có quyền truy cập trang admin.';
        exit;
    }
    ?>
<?php
include "header.php";
include "slider.php";
include "class/product_class.php";

$productInstance = new product;
$products = $productInstance->show_products();
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
        <h1>Danh sách sản phẩm</h1>
        <table>
            <tr>
                <th>Stt</th>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Loại sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Giá mới</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Hình ảnh chi tiết</th>
                <th>Tùy biến</th>
            </tr>
            <?php
            if ($products && $products->num_rows > 0) {
                $i = 0;
                while ($result = $products->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['product_id'] ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['brand_name'] ?></td>
                        <td><?php echo $result['cartegory_name'] ?></td>
                        <td><?php echo $result['product_price'] ?></td>
                        <td><?php echo $result['product_price_new'] ?></td>
                        <td><?php echo $result['product_desc'] ?></td>
                        <td>
                         <img src="uploads/<?php echo $result['product_img']; ?>" alt="" style="width: 50px; height: 50px;">
                        </td>
                        <td>
    <?php 
    if (!empty($result['all_img_desc'])) {
        $img_desc_array = explode(',', $result['all_img_desc']);
        foreach ($img_desc_array as $img_desc) {
    ?>
        <img src="uploads/<?php echo $img_desc; ?>" alt="Product Image" style="width: 50px; height: 50px;">
    <?php
        }
    } else {
        echo "No Images";
    }
    ?>
</td>
                        <td>
                            <a href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Sửa</a> |
                            <a href="productdelete.php?product_id=<?php echo $result['product_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='8'>Không có sản phẩm nào.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
