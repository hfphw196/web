<?php

function get_user($user_id) {
    $conn = connectdb();

        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user_info = $stmt->fetch();
    return $user_info;
    }
?>