<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

?>
<?php
    include_once "model/connect.php";
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
        <!--                       GioHang                              -->
        <section class="cartegory">
            <div class="container">
                <div class="cartegory-top row">
                    <p>Trang chủ</p> <span>&#10230;</span> <p>TOÀN BỘ SẢN PHẨM</p>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="cartegory-left">
                        <ul>
                            <li class="cartegory-left-li"><a href="#">Áo</a>
                            <ul>
                                <li><a href="">Áo mới</a></li>
                                <li><a href="">Áo 1</a></li>
                            </ul>
                            </li>
                            <li class="cartegory-left-li"><a href="#">Quần</a>
                                <ul>
                                    <li><a href="">Quần mới</a></li>
                                    <li><a href="">Quần 1</a></li>
                                </ul>
                            </li>
                            <li class="cartegory-left-li"><a href="#">Bộ</a>
                                <ul>
                                    <li><a href="">Bộ mới</a></li>
                                    <li><a href="">Bộ 1</a></li>
                                </ul>
                            </li>
                            <li class="cartegory-left-li"><a href="#">CLB</a>
                                <ul>
                                    <li><a href="">CLB mới</a></li>
                                    <li><a href="">CLB 1</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="cartegory-right row">
                        <div class="cartegory-right-top-item">
                            <p>SẢN PHẨM MỚI NHẤT</p>
                        </div>
                        <div class="cartegory-right-top-item">
                            <button><span>Bộ lọc</span><i class="fas fa-sort-down"></i></button>
                        </div>
                        <div class="cartegory-right-top-item">
                            <select name="" id="">
                                <option value="">Sắp xếp</option>
                                <option value="">Cao-Thấp</option>
                                <option value="">Thấp-Cao</option>
                            </select>
                        </div>
                        
                        <div class="cartegory-right-content row">
                        <?php
                        $products = get_new_product();
                        
                        // Kiểm tra xem có sản phẩm nào hay không
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                $product_id = $product["product_id"];
                                $product_name = $product["product_name"];
                                $product_img = $product["product_img"];
                                $product_price = $product["product_price"];
                                
                                // Hiển thị thông tin sản phẩm
                                echo '<div class="cartegory-right-content-item">';
                                echo '<a href="product.php?product_id=' . $product_id . '">';
                                echo '<img src="admin/uploads/' . $product_img . '" alt="">';
                                echo '<h1>' . $product_name . '</h1>';
                                echo '<p>' . $product_price . '<sup>đ</sup></p>';
                                echo '</a>';
                                echo '</div>';
                                
                            }
                        } else {
                            echo 'Không có sản phẩm nào.';
                        }
                        ?>
                           
                          
                           
                         
                           
                        </div>
                      

                      <!--  <div class="cartegory-right-bottom row">
                            <div class="cartegory-right-bottom-items">
                                <p>Hiển thị 2 <span>|</span> 4 sản phẩm  </p>
                            </div>
                            <div class="cartegory-right-bottom-items">
                                <p><span>&#171;</span>1 2 3 4 5<span>&#187;</span>Trang cuối</p>
                            </div>
                        </div>
                    -->

                    </div>

                </div>
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