<?php
session_start();
ob_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
if(!isset($_SESSION['gio_hang'])){
    $_SESSION['gio_hang'] = [];
    }

// ... (Kiểm tra phiên và các thông tin khác)

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
<!-- ........               Cart                    ......-->

        <section class="cart">
            <div class="container">
               <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="cart-top-address  cart-top-item">
                        <i class="fa-sharp fa-solid fa-location-dot"></i>                    </div>
                    <div class="cart-top-payment  cart-top-item">
                        <i class="fa-solid fa-money-check"></i>                    </div>
                    </div>
               </div>
            </div>
            <div class="container">
                <div class="cart-content row">
                    <div class="cart-content-left">
                        <table>
                            <tr>
                                <th>SẢN PHẨM</th>
                                <th>TÊN SẢN PHẨM</th>
                                <th>SIZE</th>
                                <th>SỐ LƯỢNG</th>
                                <th>THÀNH TIỀN</th>
                                <th>XÓA</th>
                                
                                <?php
                            if($isLoggedIn) {
                            $i=0;
                            foreach($_SESSION["gio_hang"] as $sp) {
                                extract($sp);
                                $product_price_numeric = floatval(str_replace(',', '.', str_replace('.', '', $product_price_new)));
                                $tt = $product_price_numeric * $soluong;
                                $linkdel="cart.php?del=".$i;
                            echo '<tr>
                                <td><img src="admin/uploads/'. $product_img .'" alt=""></td>
                                <td><p>'. $product_name .'</p></td>
                                <td><p>'. $size .'</p></td>
                                <td><p>'. $soluong .'</p></td>
                                <td><p>'.number_format($tt, 0, ',', '.').'<sup>đ</sup></p></td>
                                <td><a href="'.$linkdel.'"><span>X</span></a></td>
                            </tr>';
                            $i++;
                            }
                        }else{
                            $i=0;
                            foreach($_SESSION["gio_hang"] as $sp) {
                                extract($sp);
                                $product_price_numeric = floatval(str_replace(',', '.', str_replace('.', '', $product_price_new)));
                                $tt = $product_price_numeric * $soluong;
                                $linkdel="cart.php?del=".$i;
                            echo '<tr>
                                <td><img src="admin/uploads/'. $product_img .'" alt=""></td>
                                <td><p>'. $product_name .'</p></td>
                                <td><p>'. $size .'</p></td>
                                <td><p>'. $soluong .'</p></td>
                                <td><p>'.number_format($tt, 0, ',', '.').'<sup>đ</sup></p></td>
                                <td><a href="'.$linkdel.'"><span>X</span></a></td>
                            </tr>';
                            $i++;
                            }
                        }
                           
                            ?>  
                            
                        <?php
                                if(isset($_GET['del']) && ($_GET['del'] >=0))  {
                                    array_splice($_SESSION['gio_hang'], $_GET['del'],1);
                                    header('Location: cart.php ');
                                }
                        ?>    
                            </tr>
                            
                            
                        </table>
                        <div class="cart-content-left">
                            <table>
                        <th><a style="font_size =20px" href="cart.php?del=-1">Xóa hết</a></th>
                        <?php
                        if(isset($_GET['del']) && ($_GET['del']==-1))  {
                            $_SESSION['gio_hang']=[];
                            header('Location: cart.php ');
                        }else{
                            if(isset($_SESSION['gio_hang'])){
                                $tongsoluong=0;
                                $tongdonhang=0;
                                foreach($_SESSION['gio_hang'] as $sp){
                                    extract($sp);
                                    $product_price_numeric = floatval(str_replace(',', '.', str_replace('.', '', $product_price_new)));
                                    $tt = $product_price_numeric * $soluong;
                                    $tongsoluong +=$soluong;
                                    $tongdonhang += $tt;
                                }
                            }else{
                                $tongsoluong= 0;
                                $tongdonhang= 0;
                            }
                        }
                        ?>
                        </table>
                        </div>
                    </div>
                    <div class="cart-content-right">
                        <table>
                            <tr>
                                <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                            </tr>
                            <tr>
                                <td>TỔNG SẢN PHẨM</td>
                                <td><?= $tongsoluong?></td>
                            </tr>
                            <tr>
                                <td>TỔNG TIỀN HÀNG</td>
                                <td><p><?= number_format($tongdonhang, 0, ',', '.') ?><sup>đ</sup></p></td>
                            </tr>
                            <tr>
                                <td>TẠM TÍNH</td>
                                <td><p style="color: black; font-weight: bold;"><?= number_format($tongdonhang, 0, ',', '.') ?><sup>đ</sup></p></td>
                            </tr>
                        </table>
                        <div class="cart-content-right-text">
                            <p>Cảm ơn quý khách</p>
                            <p style="color: red; font-weight: bold;">Mua thêm <span style="font-size: 18px;"></span> để nhận được khuyến mãi</p>
                        </div>
                        <?php
                        if (empty($_SESSION['gio_hang'])) {
                            echo '<div class="cart-content-right-button">';
                            echo '<a href="giohang.php"><button>Tiếp tục mua sắm</button></a>';
                            echo '<div class="cart-empty-message">Hãy thêm sản phẩm vào giỏ hàng!.</div>';
                            echo '</div>';
                        } else {
                            // Hiển thị nút tiếp tục mua sắm và thanh toán
                            echo '<div class="cart-content-right-button">';
                            echo '<a href="giohang.php"><button>Tiếp tục mua sắm</button></a>';
                            echo '<a href="delivery.php"><button type="submit">Thanh toán</button></a>';
                            echo '</div>';
                        }
                        ?>
                        <div class="cart-content-right-dangnhap">
                            <?php
                            include_once "model/connect.php";
                            include_once "model/user_information.php";
                            
                            if($isLoggedIn){
                            $user_id = $_SESSION['user_id'];
                            $user_info = get_user($user_id);
                            $user_name = $_SESSION['user_name'];
                            }else{
                                $user_id="";
                                $user_info = get_user($user_id);
                                $user_info['fullname']="";
                                $user_name ="";
                            }
                            ?>
                            <p>TÀI KHOẢN <a href="informationuser.php?user_id=<?= $user_id ?>"> <?= $user_name ?></p> </a><br>
                            <p>Xin chào <?= $user_info['fullname'] ?>!</p><br> <br>
                            <p>Cửa hàng sẽ ưu đãi cho quý khách miễn phí đổi trả đối với sản phẩm đồng giá</p>
                        </div>
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