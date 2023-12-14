<?php
include 'database.php';
?>
<?php

class order {
    private $db;
  
    public function show_products() {
        $query = "SELECT tbl_product.product_id, tbl_product.product_name, tbl_product.product_price,
                          tbl_product.product_price_new, tbl_product.product_desc, tbl_product.product_img,
                          tbl_brand.brand_name, tbl_cartegory.cartegory_name, 
                          GROUP_CONCAT(tbl_product_img_desc.product_img_desc) AS all_img_desc
                  FROM tbl_product
                  INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                  INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
                  LEFT JOIN tbl_product_img_desc ON tbl_product.product_id = tbl_product_img_desc.product_id
                  GROUP BY tbl_product.product_id, tbl_product.product_name, tbl_product.product_price,
                           tbl_product.product_price_new, tbl_product.product_desc, tbl_product.product_img,
                           tbl_brand.brand_name, tbl_cartegory.cartegory_name
                  ORDER BY tbl_product.product_id DESC";
    
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_giohang($id_cart){
        $query = "DELETE FROM tbl_giohang WHERE product_id = '$id_cart'";
        $result = $this->db->delete($query);
        
        header('Location:../ordered.php');
        return $result;    
    }
    
    
}