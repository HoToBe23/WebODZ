<?php
session_start();
require_once "connect.php";

if (isset($_POST['mname'])) {
    $mname = $_POST['mname'];

    $sql = 'INSERT INTO manufacturers (name)
            VALUE (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $mname);

    if (!$stmt->execute())
        $_SESSION['success_manufacturer_input'] = true;
}

header('Location: ../admin.php');
exit();
