<?php
function get_product_detail($product_id){
    $conn = connectdb();

    // Lấy thông tin từ bảng tbl_product
    $sql_product = "SELECT * FROM tbl_product WHERE product_id = :product_id";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt_product->execute();

    $result_product = $stmt_product->setFetchMode(PDO::FETCH_ASSOC);
    $product_detail = $stmt_product->fetch();

    // Lấy thông tin từ bảng tbl_product_img_desc
    $sql_img_desc = "SELECT * FROM tbl_product_img_desc WHERE product_id = :product_id";
    $stmt_img_desc = $conn->prepare($sql_img_desc);
    $stmt_img_desc->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt_img_desc->execute();

    $result_img_desc = $stmt_img_desc->setFetchMode(PDO::FETCH_ASSOC);
    $product_detail['images'] = $stmt_img_desc->fetchAll();

    $conn = null;

    return $product_detail;
}
?>
