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
include "class/brand_class.php";
?>
<?php
$brand = new brand;
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $cartegory_id = $_POST["cartegory_id"];
    $brand_name = $_POST["brand_name"];
    $inser_brand = $brand ->insert_brand( $cartegory_id, $brand_name );
}
?>
<style>
    select{
        height: 30px;
        width: 200px;
    }
</style>
<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Thêm loại sản phẩm</h1> <br>
                <form action="" method="POST">
                    <select name="cartegory_id" id="">
                        <option value="#">--Chọn danh mục</option>
                        <?php
                        $show_cartegory = $brand -> show_cartegory();
                        if($show_cartegory){while($result = $show_cartegory -> fetch_assoc()){


                        ?>
                            <option value="<?php echo $result['cartegory_id'] ?>"><?php echo $result['cartegory_name'] ?></option>
                        <?php
                         }}
                        ?>
                    </select> <br>
                    <input required name="brand_name" type="text" placeholder="Nhập tên loại sản phẩm">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>


   

           
</body>
</html>