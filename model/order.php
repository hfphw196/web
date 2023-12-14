<?php
    function create_order($madh,$tongdonhang,$pttt,$user_id,$fullname,$address,$email,$phone){
        $conn = connectdb();
        $sql = "INSERT INTO tbl_order (madh, tongdonhang, pttt,user_id, fullname, address, email, phone) 
        VALUES ('".$madh."', '".$tongdonhang."', '".$pttt."', '".$user_id."', '".$fullname."', '".$address."', '".$email."', '".$phone."')";
        $conn->exec($sql);
        $last_id = $conn->lastInsertId();
        return $last_id;
        
    }
    function addtocart($id_dh,$id_product,$soluong,$dongia,$name_product,$product_img){
        $conn = connectdb();
        $sql = "INSERT INTO tbl_giohang (id_dh, id_product, soluong, dongia, name_product, product_img) 
        VALUES ('".$id_dh."', '".$id_product."', '".$soluong."', '".$dongia."', '".$name_product."', '".$product_img."')";
        $conn->exec($sql);
        $last_id = $conn->lastInsertId();
        return $last_id;
        
    }
   
     

?>