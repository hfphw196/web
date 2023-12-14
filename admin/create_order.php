<?php
 session_start();
 ob_start();
 include_once "../model/connect.php";
 include_once "../model/order.php";
 
 if (isset($_POST['thanhtoan'])) {
      $tongdonhang = $_POST['tongthanhtoan'];
      $fullname = $_POST['fullname'];
      $address = $_POST['address'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $madh = "UIT".rand(0,999999);
      $user_id = $_POST['user_id'];
      

      //$id_dh = create_order($madh,$tongdonhang,$pttt,$user_id,$fullname,$address,$email,$phone);
      //$sp = array("product_id"=>$product_id,"product_name"=>$product_name,"product_img"=>$product_img,"product_price_new"=>$product_price_new,"size"=>$size,"soluong"=>$soluong);

      if(isset($_SESSION['gio_hang'])&&(count($_SESSION['gio_hang'])> 0)){
         foreach($_SESSION['gio_hang'] as $sp){
            extract($sp);
            //addtocart($id_dh,$product_id,$soluong,$product_price_new,$product_name,$product_img);

         }
  
      }
      header("Location: ../payment.php?tongdonhang=$tongdonhang&fullname=$fullname&address=$address&email=$email&phone=$phone&madh=$madh&pttt=$pttt&user_id=$user_id");
    exit();
   }else{
      echo"không có gì";
   }
?>