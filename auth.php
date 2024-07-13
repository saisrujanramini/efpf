<?php
include 'db.php';

$action = $_GET['action'];

if ($action == 'register') {
    register();
} elseif ($action == 'login') {
    login();
}

function register() {
    global $conn;
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $username, $password, $email);
    if ($stmt->execute()) {
        header('Location: login.html');
    } else {
        echo "Error: " . $stmt->error;
    }
}

function login() {
    global $conn;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();
    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['user_id'] = $id;
        header('Location: index.html');
    } else {
        echo "Invalid username or password.";
    }
}
?>
