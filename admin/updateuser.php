<?php
session_start();
ob_start();
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
include "class/user_class.php";

$user = new User;

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    // Xử lý khi không có user_id
    echo "Không tìm thấy user_id.";
    exit();
}

    if (isset($_POST["capnhat"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $fullname = $_POST["fullname"];
        $address = $_POST["address"];
        $age = $_POST["age"];
        $phone = $_POST["phone"];
        

        if (empty($username) || empty($fullname) || empty($address) || empty($age) || empty($phone)) {
            // Xử lý lỗi nếu cần
            echo "Vui lòng nhập đầy đủ thông tin.";
            exit();
        }

        // Thực hiện cập nhật thông tin người dùng
        $result = $user->user_update($username, $password, $fullname, $address, $age, $phone, $user_id);
        if ($result) {
            header('Location: ../giohang.php');
        } else {
            echo "Update failed.";
        }
    }
?>
