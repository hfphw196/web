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
    } else {
        header('Location: ../index.php');

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
include "class/cartegory_class.php";
?>
<?php
$cartegory = new cartegory;
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $cartegory_name = $_POST["cartegory_name"];
    $inser_cartegory = $cartegory ->insert_cartegory( $cartegory_name);
}
 
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Thêm danh mục</h1>
                <form action="" method="POST">
                    <input required name="cartegory_name" type="text" placeholder="Nhập tên danh mục">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>