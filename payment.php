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
<!-- .................  payment                    ......-->
     <section class="payment">
        <div class="container">
            <div class="payment-top-wrap">
                <div class="payment-top">
                    <div class="payment-top-delivery payment-top-item">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="payment-top-address  payment-top-item">
                        <i class="fa-sharp fa-solid fa-location-dot"></i>                    </div>
                    <div class="payment-top-payment  payment-top-item">
                        <i class="fa-solid fa-money-check"></i>                    </div>
                    </div>
               </div>
        </div>
        <div class="container">
            <div class="payment-content row">
                <div class="payment-content-left">
                        <?php
                        if (isset($_GET['tongdonhang'])) {
                            $tongdonhang = $_GET['tongdonhang'];
                            $fullname = $_GET['fullname'];
                            $address = $_GET['address'];
                            $email = $_GET['email'];
                            $phone = $_GET['phone'];
                            $madh = $_GET['madh'];
                            $user_id = $_GET['user_id'];
                        } else {
                            echo "Dữ liệu không hợp lệ";
                        }
                        ?>


                        <div class="payment-content-left-method-delivery">
                            <p style="font-weight: bold;">Phương thức giao hàng</p>
                            <div class="payment-content-left-method-delivery-item">
                                <input checked type="radio">
                                <label for="">Giao hàng chuyển phát nhanh</label>
                            </div>
                        </div>
                        <form action="admin/create_order_done.php" method="post">
                        <div class="payment-content-left-method-payment">
                            <p style="font-weight: bold;">Phương thức thanh toán</p>
                            <p>Giao dịch an toàn. Thông tin tín dụng sẽ không được lưu lại</p>
                            <div class="payment-content-left-method-payment-item">
                                <input checked name="pttt" id="cashPayment" value="cashPayment" type="radio" onclick="showPaymentMethod('cash')">
                                <label for="cashPayment">Thanh toán trực tiếp</label>
                            </div>
                            <div class="payment-content-left-method-payment-item">
                                <input name="pttt" id="creditPayment" value="creditPayment" type="radio" onclick="showPaymentMethod('credit')">
                                <label for="creditPayment">Thanh toán bằng thẻ tín dụng</label>
                            </div>
                            <div class="payment-content-left-method-payment-item-img-listatm">
                                <img src="img/visalogo.png" alt="" style="width:8%" >
                                <img src="img/logomastercard.png" alt="" style="width:8%">
                                <p><img src="img/listatm.png" alt=""></p>
                                
                            </div>
                            <div class="payment-content-left-method-payment-item">
                                <input name="pttt" id="momoPayment" value="momoPayment" type="radio" onclick="showPaymentMethod('momo')" >
                                <label for="momoPayment">Thanh toán bằng Momo</label>
                                <p><img src="img/logomomo.png" alt="" style="width:9%" ></p>
                            </div>
                        </div>
                        </div>
                        <script>
                                function showPaymentMethod() {
                                    var cashPayment = document.getElementById("cashPayment");
                                    var creditPayment = document.getElementById("creditPayment");
                                    var momoPayment = document.getElementById("momoPayment");
                                    var cashPaymentDiv = document.getElementById("cashPaymentDiv");
                                    var creditInputDiv = document.getElementById("creditInputDiv");
                                    var momoImageDiv = document.getElementById("momoImageDiv");

                                    if (cashPayment.checked) {
                                        // Hiển thị phương thức thanh toán tận nơi
                                        cashPaymentDiv.style.display = "block";
                                        creditInputDiv.style.display = "none";
                                        momoImageDiv.style.display = "none";
                                    } else if (creditPayment.checked) {
                                        // Hiển thị input cho thanh toán bằng thẻ
                                        cashPaymentDiv.style.display = "none";
                                        creditInputDiv.style.display = "block";
                                        momoImageDiv.style.display = "none";
                                    } else if (momoPayment.checked) {
                                        // Hiển thị hình QR cho thanh toán bằng Momo
                                        cashPaymentDiv.style.display = "none";
                                        creditInputDiv.style.display = "none";
                                        momoImageDiv.style.display = "block";
                                    }
                            }
                        </script>
                        <div class="payment-content-right">
                            <div id="cashPaymentDiv">
                                <p style="font-size: 15px">*Phí thu hộ: ₫0 VNĐ. Ưu đãi về phí vận chuyển (nếu có) áp dụng cả với phí thu hộ.</p><br>
                                <p style="font-weight: bold;">Phương thức thanh toán trực tiếp</p>
                                
                            </div>

                            <div id="creditInputDiv" style="display: none;">
                                <p style="font-size: 15px">*Phí thu hộ: ₫0 VNĐ. Ưu đãi về phí vận chuyển (nếu có) áp dụng cả với phí thu hộ.</p><br>
                                <p style="font-weight: bold;">Phương thức thanh toán bằng thẻ tín dụng</p>
                                <style>
                               
                                input[type="text"]::placeholder {
                                    color: #aaa;
                                }
                                </style>
                                <input style="width: 70%;
                                    padding: 10px;
                                    margin: 5px 0;
                                    box-sizing: border-box;
                                    border: 1px solid #ccc;
                                    border-radius: 4px;" type="text" placeholder="Nhập mã thẻ">
                                <input style="width: 35%;
                                    padding: 10px;
                                    margin: 5px 0;
                                    box-sizing: border-box;
                                    border: 1px solid #ccc;
                                    border-radius: 4px;" type="text" id="expiryDateInput" placeholder="Ngày hết hạn (MM/YY)" maxlength="5" style="width: 35%">
                                <script>
                                document.getElementById('expiryDateInput').addEventListener('input', function (e) {
                                    let input = e.target.value.replace(/\D/g, ''); 
                                    let formattedInput = formatExpiryDate(input);
                                    e.target.value = formattedInput;
                                });
                                function formatExpiryDate(input) {
                                    if (input.length > 2) {
                                        return input.slice(0, 2) + '/' + input.slice(2);
                                    }
                                    return input;
                                }
                                </script>
                                <input style="width: 35%;
                                    padding: 10px;
                                    margin: 5px 0;
                                    box-sizing: border-box;
                                    border: 1px solid #ccc;
                                    border-radius: 4px;" type="text" placeholder="Security code" style="width:35%" >
                            </div>

                            <div id="momoImageDiv" style="display: none;">
                                <p style="font-size: 15px">*Phí thu hộ: ₫0 VNĐ. Ưu đãi về phí vận chuyển (nếu có) áp dụng cả với phí thu hộ.</p><br>
                                <p style="font-weight: bold;">Phương thức thanh toán momo</p>
                                <img src="img/qrthanhtoan.png" alt="" style="width: 70%">
                            </div>                    
                            <p style="padding: 50px 0 0 50px; color:red" >Cảm ơn quý khách đã ủng hộ !!!</p>

                        </div>
                        </div>
                        </div>
                        
                                <input type="hidden" name="tongdonhang"  value = "<?=$tongdonhang?>" >
                                <input type="hidden" name="fullname"  value = "<?=$fullname?>" >
                                <input type="hidden" name="address" value = "<?=$address?>" >
                                <input type="hidden" name="email"  value = "<?=$email?>" >
                                <input type="hidden" name="phone"  value = "<?=$phone?>" >
                                <input type="hidden" name="madh"  value = "<?=$madh?>" >
                                <input type="hidden" name="user_id" value = "<?=$user_id?>" >
                            <div class="payment-content-right-payment">
                                <button type="submit" name="thanhtoan">HOÀN TẤT THANH TOÁN</button>
                            
                            </div>
                            </form>
                    
                        
                   
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
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    </body>
    
</html>