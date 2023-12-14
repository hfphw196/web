<?php
session_start();
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
         <!--               slider                    -->
         <section id="slide">
            
        </section>
        <style>
        .container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
    text-align: center;
}

div {
    margin-bottom: 15px;
}


span {
    display: inline-block;
    padding: 8px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 5px;
}


.container button {
    background: linear-gradient(to right, #3498db, #2980b9);
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    padding: 10px;
}

button:hover {
    background: linear-gradient(to right, #2980b9, #3498db);
}


        </style>
<!--............................ thông tin ....................-->
<?php
include_once "model/connect.php";
include_once "model/user_information.php";
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $user_info = get_user($user_id);
}else {
    echo'KHONGOGNGONGOGNOGNO';
}
?>

<main>
        <section class="show-profile">
            <div class="container">
                <h2>Thông Tin Người Dùng</h2>
                <!-- Mẫu biểu mẫu thông tin người dùng -->
                <div>
                    <label for="username">Tên người dùng:</label>
                    <span id="username"><?php echo $user_info['username']; ?></span>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <span id="email"><?php echo $user_info['email']; ?></span>
                </div>
                <div>
                    <label for="phone">Số điện thoại:</label>
                    <span id="phone"><?php echo $user_info['phone']; ?></span>
                </div>
                <div>
                    <label for="phone">Tuổi:</label>
                    <span id="phone"><?php echo $user_info['age']; ?></span>
                </div>
                <div>
                    <label for="phone">Địa chỉ:</label>
                    <span id="phone"><?php echo $user_info['address']; ?></span>
                </div>
                <form action="model/showorder.php" method="post" >
                <div>
                    <button type="submit" name="orderlist">Lịch sử đặt hàng
                </div>
            </form>
                <!-- Thêm các trường thông tin khác tùy thuộc vào yêu cầu -->
                
                
                <a href="admin/myaccount.php?user_id=<?php echo $user_id?>"><button  type="submit" name="capnhat">CẬP NHẬT THÔNG TIN </button> <br> <br></a>
                <a href="giohang.php">Quay về</a>
            </div>
        </section>
    </main>
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
                    <li><a href=""><img src=" img/logo.png" width="50" height="50" alt=""></a></li>
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


       


        <script src=" slider.js"></script>
        <script src=" script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
    
</html>