<?php
function get_new_product(){
    $conn = connectdb();
    $sql= "SELECT * FROM tbl_product ORDER BY product_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $list_product = $stmt->fetchAll();
    $conn =null;

    return $list_product;
}

?>