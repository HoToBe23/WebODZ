<?php
session_start();
require_once "connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = 'SELECT `img` FROM `goods` 
    WHERE `id` = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $img = $row['img'];

    $sql = 'DELETE FROM `goods` 
            WHERE `id` = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);

    if (!$stmt->execute()) {
        $_SESSION['success_product_input'] = true;
    } else
        unlink("../imgs/products/" . $img);
}

header('Location: ../admin.php');
exit();
