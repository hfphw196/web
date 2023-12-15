<?php
session_start();
ob_start();
$servername = "footballkit-server.mysql.database.azure.com";
$username = "rjrlcznktk";
$password = "K4TB5OZ7SC6B4PF0$";
$dbname = "footballkit-database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$_SESSION['order'] = [];
$user_id = $_SESSION["user_id"]; 

$sql = "SELECT tbl_order.id_dh, tbl_order.madh, tbl_order.tongdonhang, tbl_order.pttt, tbl_order.user_id,
               tbl_order.fullname, tbl_order.address, tbl_order.email, tbl_order.phone,
               tbl_giohang.id_cart, tbl_giohang.id_dh AS giohang_id_dh, tbl_giohang.id_product, tbl_giohang.soluong,
               tbl_giohang.dongia, tbl_giohang.name_product, tbl_giohang.product_img
        FROM tbl_order
        JOIN tbl_giohang ON tbl_order.id_dh = tbl_giohang.id_dh
        WHERE tbl_order.user_id = $user_id";

$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if (isset($_POST["orderlist"])) {
    
    while ($row = $result->fetch_assoc()) {
            
        
        
        $id_cart = $row["id_cart"];
        $madh = $row["madh"];
        $fullname = $row["fullname"];
        $phone = $row["phone"];
        $email = $row["email"];
        $pttt = $row["pttt"];
        $dongia = $row["dongia"];
        $name_product = $row["name_product"];
        $product_img = $row["product_img"];    
                       
        $order = array("id_cart"=>$id_cart,"madh"=>$madh,"fullname"=>$fullname,"phone"=>$phone,"email"=>$email,"pttt"=>$pttt,"dongia"=>$dongia,"name_product"=>$name_product,"product_img"=>$product_img);
        array_push($_SESSION["order"], $order);

    }
    
  }else if($update_orderlist = 1){
    while ($row = $result->fetch_assoc()) {
            
        
        
        $id_cart = $row["id_cart"];
        $madh = $row["madh"];
        $fullname = $row["fullname"];
        $phone = $row["phone"];
        $email = $row["email"];
        $pttt = $row["pttt"];
        $dongia = $row["dongia"];
        $name_product = $row["name_product"];
        $product_img = $row["product_img"];    
                       
        $order = array("id_cart"=>$id_cart,"madh"=>$madh,"fullname"=>$fullname,"phone"=>$phone,"email"=>$email,"pttt"=>$pttt,"dongia"=>$dongia,"name_product"=>$name_product,"product_img"=>$product_img);
        array_push($_SESSION["order"], $order);

    }
  }
  var_dump($_SESSION["order"]);
  header("Location: ../ordered.php");

$conn->close();
?>