<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if($username === 'admin' && $password === '123456') {
        $_SESSION['auth'] = true;
        header('location: '.BASE_URL.'list-product');
        exit();
    } else {
        echo "<p style='color: red;'>Sai tên đăng nhập hoặc mật khẩu!</p>";
    }
}
?>
 <form action="POST" method="<?= BASE_URL ?>login">
    <label for="username">TÊN</label><br>
     <input type="text"  name="username" ><br>
     <label for="password">MẬT KHẨU</label><br>
     <input type="password"  name="password"><br>
     <button type="submit" class="btn btn-primary">Đăng nhập</button>
 </form>





