<?php
include "database.php";
?>
<?php
class User {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function is_logged_in() {
        return isset($_SESSION['user_id']);
    }

    public function register_user($username, $email, $password)
    {
        // Kiểm tra xem người dùng có tồn tại trong cơ sở dữ liệu hay không
        $existing_user_query = "SELECT * FROM users WHERE email = '$email'";
        $existing_user = $this->db->select($existing_user_query);

        if ($existing_user) {
            // Người dùng đã tồn tại, không thể đăng ký lại
            return false;
        }

        // Thêm người dùng mới vào cơ sở dữ liệu
       
        $register_query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 0)";
        $result = $this->db->insert($register_query);

        return $result;
    }
    public function user_update($username, $password, $fullname, $address, $age, $phone, $user_id) {
        if ($password == "" ) {
            $query = "UPDATE users SET username = '$username', fullname = '$fullname', address = '$address', age = '$age', phone = '$phone' WHERE user_id = '$user_id'";
        } else {
            $query = "UPDATE users SET username = '$username', password = '$password', fullname = '$fullname', address = '$address', age = '$age', phone = '$phone' WHERE user_id = '$user_id'";
        }
        $result = $this->db->update($query);
        return $result;
    }
    
    public function show_users() {
        $query = "SELECT * FROM users ORDER BY user_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

   

   

    public function delete_user($user_id) {
        $query = "DELETE FROM users WHERE user_id = '$user_id'";
        $result = $this->db->delete($query);
        return $result;
    }
    public function check_user($email, $password) {
        // Note: This is a basic example, and you should use prepared statements to prevent SQL injection
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }
    
    
}
?>

?>
