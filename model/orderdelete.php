<?php
include '../admin/database.php';

class order {
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

public function delete_giohang($id_cart){
    $query = "DELETE FROM tbl_giohang WHERE id_cart = '$id_cart'";
    $result = $this->db->delete($query);
    
    return $result;    
}
}
$order = new order;

$id_cart = $_GET['del'];

echo $id_cart;
$update_orderlist = 1;
$delete_order = $order->delete_giohang($id_cart);
header("Location:../model/showorder.php");

?>