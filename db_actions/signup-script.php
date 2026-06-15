<?php
session_start();

if (isset($_POST['email'])) {
    require_once "connect.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT COUNT(*) as count
            FROM users 
            WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        $_SESSION['user_exists'] = true;
        header("Location: ../signup.php");
        exit();
    } else {
        $sql = "INSERT INTO `users` (`id`, `email`, `password`, `rank`)
                    VALUES (NULL, ?, ?, NULL);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $_SESSION['logged_in'] = "user";
        $_SESSION['email'] = $email;
    }
}

header("Location: ../index.php");
exit();
