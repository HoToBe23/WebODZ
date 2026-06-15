<?php
session_start();
require_once "connect.php";

if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = 'DELETE FROM `manufacturers` 
            WHERE `id` = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $id);

        if (!$stmt->execute())
                $_SESSION['success_manufacturer_delete'] = true;
}

header('Location: ../admin.php');
exit();
