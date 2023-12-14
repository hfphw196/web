<?php
 session_start();
 ob_start();
 if (!isset($_SESSION['gio_hang']) || !is_array($_SESSION['gio_hang'])) {

   $_SESSION['gio_hang'] = [];
}
 
    if (isset($_POST["addcart"])) {
        // Lấy thông tin sản phẩm từ form
        $product_id = $_POST["product_id"];
        $product_name = $_POST["product_name"];
        $product_img = $_POST["product_img"];
        $product_price_new = $_POST["product_price_new"];
        $size = $_POST["size"];
        $soluong = $_POST["soluong"];
    
    
        
        $sp = array("product_id"=>$product_id,"product_name"=>$product_name,"product_img"=>$product_img,"product_price_new"=>$product_price_new,"size"=>$size,"soluong"=>$soluong);
        array_push($_SESSION["gio_hang"], $sp);
        echo var_dump($_SESSION["gio_hang"]);
        header('Location: ../cart.php');
     }
?>