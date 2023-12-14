<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

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
<!-- .................  delivery                    ......-->
<?php
include_once "model/connect.php";
include_once "model/user_information.php";
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_info = get_user($user_id);
    $fullname = $user_info['fullname'];
    $phone = $user_info['phone'];
    $address = $user_info['address'];
    $email = $user_info['email'];
}else {
    $user_id = 0;
    $fullname = "";
    $phone = "";
    $address = "";
    $email = "";
}
?>

    <section class="delivery">
        <div class="container">
            <div class="delivery-top-wrap">
                <div class="delivery-top">
                    <div class="delivery-top-delivery delivery-top-item">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="delivery-top-address  delivery-top-item">
                        <i class="fa-sharp fa-solid fa-location-dot"></i>                    </div>
                    <div class="delivery-top-payment  delivery-top-item">
                        <i class="fa-solid fa-money-check"></i>                    </div>
                    </div>
               </div>
        </div>
        <div class="container">
            <div class="delivery-content row">
                <div class="delivery-content-left">
                    <p>Nhập địa chỉ giao hàng</p>
                    <div class="delivery-content-left-dangnhap row">
                    <?php
                        if(!$isLoggedIn) {
                            // Nếu user_id rỗng, chuyển hướng đến trang đăng nhập
                            echo '<div style="color: red;">Vui lòng đăng nhập để xem thông tin</div>';
                        }else{
                        echo'<a href="informationuser.php?user_id= '.$user_id .'" class="row">
                        <i class="fa-solid fa-file-pen"></i>
                        <p>Hãy cập nhật lại thông tin và địa chỉ của bạn ở đây</p>
                        </a>';
                        }
                    ?>
                    
                        
                    </div>
                    <div class="delivery-content-left-dangky row">
                        <p> <span style="font-weight: bold;">Nếu không có tài khoản, Hãy đăng ký</span> (Tạo tài khoản mới)</p>
                    </div>
                  <form action="admin/create_order.php" method="post" >

                            
                            
                        <div class="delivery-content-left-input-top row">
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Họ tên <span style="color: red;">*</span></label>
                                <input type="text" name="fullname" value="<?=$fullname?>" required>
                                
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Điện thoại <span style="color: red;">*</span></label>
                                <input type="text" name="phone" value="<?=$phone?>" required>
                            </div>
                        </div>
                        <div class="delivery-content-left-input-bottom">
                            <label for="">Địa chỉ <span style="color: red;">*</span></label>
                            <input type="text" name="address" value="<?=$address?>" required>
                        </div>
                        
                        <div class="delivery-content-left-button row">
                            <a href="cart.php"><span>&#171;</span><p>Quay lại giỏ hàng</p></a>
                            <input type="hidden" name="email" value="<?=$email?>">
                            <input type="hidden" name="user_id" value="<?=$user_id?>">
                            <a href=""><button type="submit" name="thanhtoan" ><p style="font-weight: bold;">THANH TOÁN VÀ GIAO HÀNG</p></button></a>
                        </div>
                        </div>
                        <div class="delivery-content-right">
                        <table>
                        
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Size</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                                <?php
                            $i=0;
                            foreach($_SESSION["gio_hang"] as $sp) {
                                extract($sp);
                                $product_price_numeric = floatval(str_replace(',', '.', str_replace('.', '', $product_price_new)));
                                $tt = $product_price_numeric * $soluong;
                                $linkdel="cart.php?del=".$i;
                            echo '<tr>
                        
                                    <td>'. $product_name .'</td>
                                    <td>'. $size .'</td>
                                    <td>'. $soluong .'</td>
                                    <td>'. $product_price_new .'<sup>đ</sup></p></td>
                        
                            </tr>';
                            $i++;
                            }
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
                            ?>
                        
                            
                            <tr>
                                <td style="font-weight: bold;" colspan="3">Tổng</td>
                                <td style="font-weight: bold;"><p><p><?=number_format($tongdonhang, 0, ',', '.')?><sup>đ</sup></p></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;" colspan="3">Voucher của shop</td>
                                <td style="font-weight: bold;"><p>200.000<sup>đ</sup></p></td>
                            </tr>
                            <?php
                            $tongthanhtoan = $tongdonhang - 200000;
                            if($tongthanhtoan<0){$tongthanhtoan=0;}
                            ?>
                            <tr>
                                <td style="font-weight: bold;" colspan="3">Tổng thanh toán</td>
                                <td style="font-weight: bold;"><?=number_format($tongthanhtoan, 0, ',', '.')?><sup>đ</sup></p></td>
                                
                            </tr>
                            <input type="hidden" name="tongthanhtoan" value="<?=$tongthanhtoan?>">
                                <input type="hidden" name="pttt" value="??">
                        </table>   
                    </form>
                    
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