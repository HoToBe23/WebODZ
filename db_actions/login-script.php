<?php
session_start();
if (isset($_POST['email'])) {
    require_once "connect.php";

    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT `email`, `password`, `rank` FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $rows_count = $result->num_rows;

    if ($rows_count == 0) {

        $_SESSION['user_does_not_exist'] = true;
        header("Location: ../login.php");
        exit();
    } else if (strcmp($row['password'], $password) == 0) {

        $_SESSION['email'] = $email;
        if ($row['rank'] == 1) {
            $_SESSION['logged_in'] = "admin";
            header("Location: ../admin.php");
        } else {
            $_SESSION['logged_in'] = "user";
            header("Location: ../index.php");
        }

        exit();
    } else {
        $_SESSION['wrong_password'] = true;
        header("Location: ../login.php");
        exit();
    }
}

header("Location: ../login.php");
exit();
