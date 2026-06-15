<?php
session_start();

if (isset($_POST['cname'])) {
    require_once "connect.php";

    $cname = $_POST['cname'];

    $sql = 'INSERT INTO categories (name)
            VALUE (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $cname);

    if (!$stmt->execute())
        $_SESSION['success_category_input'] = true;

}

header('Location: ../admin.php');
exit();
