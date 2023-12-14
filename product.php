<?php
session_start();
ob_start();
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

?>
<?php
    include_once "model/connect.php";
    include_once "model/product_detail.php";
    include_once "model/product_list.php";
?>
<!DOCTYPE html>
<html lang = "en" class="hydrated">
    <head>
        <meta charset= "UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/8306bb466f.js" crossorigin="anonymous"></script>
        <link rel = "stylesheet" href="style.css">
        <title>FootballKit</title>

    </head>
    <body>
        <header>
            <div class="logo">
                <a href="index.php">
                    <img src="img/logo.png" width="75" height="75">
                </a>
                
            </div>
            <div class="menu">
                <li><a href="giohang.php">Áo</a>
                   
                </li>
                <li><a href="giohang.php">Quần</a>

                </li>
                <li><a href="giohang.php">Nguyên bộ</a>

                </li>
            </div>
            <div class="others">
                 
                 <li>
                <form action="model/search.php" method="GET" >
                    
                    <input placeholder="Tìm kiếm" type="text" name="tukhoa" > 
                    <button class="search-button"><i class="fas fa-search"></i></button>
                </form>
                 </li>
                    <li><a href="cart.php"><span class="bag"><ion-icon name="bag-handle"></ion-icon></span></a></li>
                    <li><button class="btnLogin-popup"><span><ion-icon name="person"></ion-icon></span></button></li>
                    
                   
            </div>
            <style>

.search-button {
    background-color: transparent; 
    border: none;
    vertical-align: top; 
}

.search-button i {
    color: #333; 
    font-size: 16px;
}
.search-button:hover i {
    color: #007bff;
}

            </style>
        </header>

        <!--                  product                                  -->
        
        
<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product_detail = get_product_detail($product_id);
    if (!empty($product_detail)) {
        echo '<section class="product">
            <div class="container">
                <div class="product-top row">
                    <p>SẢN PHẨM</p> <span>&#10230;</span><p>' . $product_detail['product_name'] . '</p>
                </div>
                <div class="product-content row">';
        echo'<div class="product-content-left row">';
        echo'<div class="product-content-left-big-img">';
        echo'<img src="admin/uploads/' . $product_detail['product_img'] . '" alt="">';
        echo'</div>';     
    }else{
        echo 'không có';
    }
    if (!empty($product_detail['images'])) {
        echo'<div class="product-content-left-small-img">';
        foreach ($product_detail['images'] as $image) {
            echo '<img src="admin/uploads/' . $image['product_img_desc'] . '" alt="">';
        }
    }

?>
                        
                        </div>
                    </div>
<?php
        echo'<div class="product-content-right">';
        echo'<div class="product-content-right-product-name">';
        echo'<h1>' . $product_detail['product_name'] . '</h1>';
        echo'<p>MSP:' . $product_detail['product_id'] . '</p>';
        echo'</div>';
        echo'<div class="product-content-right-product-price">';
        echo'<p>' . $product_detail['product_price_new'] . '<sup>đ</sup></p>';
        echo'</div>';


?>
    
                        <div class="product-content-right-product-size">
                            <p style="font-weight: bold;">Size</p>
                            <div class="size">
                            <select id="sizeSelect" name="size" onchange="updateHiddenSize()">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                            </select> <br> <br>
                        </div>
                        </div>
                        <div class="quantity">
                            <p style="font-weight: bold;">Số lương</p>
                            <input type="number" id="quantityInput" min="1" value ="1" onchange="updateHiddenField()">   
                        </div>
                        <div class="product-content-right-product-button">                     
                        <form action="admin/add_cart.php" method="post" >
                                <input type="hidden" name="product_id" value="<?= $product_detail['product_id']?>" >
                                <input type="hidden" name="product_name" value="<?= $product_detail['product_name']?>" >
                                <input type="hidden" name="product_img" value="<?= $product_detail['product_img'] ?>" >
                                <input type="hidden" name="product_price_new" value="<?= $product_detail['product_price_new'] ?>" >
                                <input type="hidden" name="size" id="hiddenSize" value = "S" >
                                <input type="hidden" name="soluong" id="hiddenQuantity" value = "1" >
                                <a href=""><button type="submit" name="addcart" ><i class="fa-sharp fa-solid fa-cart-shopping"></i> <p>MUA HÀNG</p></button></a>
                            </form>
                    <script>
                        function updateHiddenSize() {
                            var sizeSelect = document.getElementById("sizeSelect");
                            var hiddenSize = document.getElementById("hiddenSize");
                            hiddenSize.value = sizeSelect.value;
                        }
                    </script>
                    <script>
                        function updateHiddenField() {
                            var quantityValue = document.getElementById("quantityInput").value;
                            document.getElementById("hiddenQuantity").value = quantityValue;
                        }
                    </script>
                            
                            <a href="giohang.php"><button><p>TÌM HÀNG KHÁC</p></button></a>
                        </div>
                        
                        <div class="product-content-right-bottom">
                            <div class="product-content-right-bottom-top">
                                &#8744;	
                            </div>
                            

          
                            <div class="product-content-right-bottom-content-big">
                                <div class="product-content-right-bottom-content-title row">
                                    <div class="product-content-right-bottom-content-title-item chitiet">
                                        <p>Chi tiết</p>
                                    </div>
                                    <div class="product-content-right-bottom-content-title-item baoquan">
                                        <p>Bảo quản</p>
                                    </div>
                                    <div class="product-content-right-bottom-content-title-item thamkhaosize">
                                        <p>Tham khảo size</p>    
                                    </div>
                                </div>
<?php
        echo '<div class="product-content-right-bottom-content">';
        echo '<div class="product-content-right-bottom-content-chitiet">';
        echo ''. $product_detail['product_desc'] .'';
}
?>
                                
                                        
                                    </div>
                                    <div class="product-content-right-bottom-content-baoquan">
                                        Logo thêu sắc sảo, bền đẹp không bong tróc <br><br>
                                        Vải thun lạnh 100% polyester, đặt dệt độc quyền mềm và mịn. <br><br>
                                        Độ co dãn tốt, giúp thoáng mát và thoải mái khi vận động. <br><br>
                                        Màu áo quần cực bền, in ấn có độ thẩm mỹ cao, không bong tróc. <br><br>
                                    </div>
                                    <div class="product-content-right-bottom-content-thamkhaosize">
                                        S   : 45kg
                                        M   : 50kg
                                        L   : 55kg
                                        XL  : 60kg
                                        XXL : 65kg
                                        
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            
        </section>
<!--                            product related                  -->
        <section class="product-related">
            <div class="product-related-title">
                <p>SẢN PHẨM KHÁC</p>
            </div>
            <div class="product-related-content row">
<?php
    $products = get_new_product();
    if (!empty($products)) {
        foreach ($products as $product) {
            $product_idn = $product["product_id"];
            $product_name = $product["product_name"];
            $product_img = $product["product_img"];
            $product_price = $product["product_price"];
        if($product_idn != $product_id){
            echo '<div class="product-related-item">';
            echo '<a href="product.php?product_id=' . $product_idn . '">';
            echo '<img src="admin/uploads/' . $product_img . '" alt="">';
            echo '<h1>' . $product_name . '</h1>';
            echo '<p>' . $product_price . '<sup>đ</sup></p>';
            echo '</a>';
            echo '</div>';
        }
        }
    } else {
        echo 'Không có sản phẩm nào.';
    }
?>
            </div>
        </section>

    <!--                  login                          -->
     
<div class="wrapper">
    <span class="icon-close"><ion-icon name="close"></ion-icon></span>

    <?php
    if ($isLoggedIn) {
        // Nếu đã đăng nhập, hiển thị thông tin người dùng và nút đăng xuất
        echo '<div class="form-box login">
                <h2>User Information</h2>
                <a href="informationuser.php?user_id=' . $_SESSION['user_id'] . '"><p>Welcome, ' . $_SESSION['user_name'] . '!</p></a>
                <form action="admin/logout.php" method="post"> 
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

                <div class="login-register">
                    <p>Don\'t have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </div>';
    } else {
        // Nếu chưa đăng nhập, hiển thị biểu mẫu đăng nhập và nút đăng ký
        echo '<div class="form-box login">
        <h2>Login</h2>
        <form action="admin/login.php" method="post">
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="pass" required>
                <label>Password</label>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" id="dangnhap" name="dangnhap" class="btn">Login</button><br> <br>


            <div class="login-register">
                <p>Don\'t have an account? <a href="#" class="register-link">Register</a></p>
            </div>
        </form>
    </div>';
    }
    ?>

            <div class="form-box register">
                <h2>Registration</h2>
                <form action="admin/register.php" method="post">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="username" required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">I agree to the terms & conditions</label>
                    </div>
                    <button type="submit" name="dangky" class="btn">Register</button>
                    <div class="login-register">
                        <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                    </div>
                </form>
            </div>
        </div>




        <!--                Footer                            -->

        <section class="footer">
            <div class="footer-container">
                <div class="footer-top">
                    <li><a href=""><img src="img/logo.png" width="50" height="50" alt=""></a></li>
                    <li><a href=""></a>Liên hệ</li>
                    <li><a href=""></a>Tuyển dụng</li>
                    <li><a href=""></a>Giới thiệu</li>
                    <li>
                       <a href="" class="fab fa-facebook-f"></a>
                       <a href="" class="fab fa-twitter"></a>
                       <a href="" class="fab fa-youtube"></a>
                   </li>
       
               </div>
               <div class="footer-center">
                   <p>
                       Email liên hệ : 21522483@gm.uit.edu.vn <br>
                       Email liên hệ : 21522483@gm.uit.edu.vn <br>
                       Đặt hàng online : <b>0123456789</b>
                   </p>
               </div>
               <div class="footer-bottom">
                   @FootballKit
               </div>
            </div>
        </section>


       


        <script src="slider.js"></script>
        <script src="script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
    
</html>