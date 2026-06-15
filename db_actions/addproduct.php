<?php
session_start();

if (isset($_POST['name'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];

    $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $img_ext = pathinfo($img, PATHINFO_EXTENSION);
    $img_new_name = uniqid() . '.' . $img_ext;

    $category_id = $_POST['category_id'];
    $manufacturer_id = $_POST['manufacturer_id'];

    $length = $_POST['length'];
    $height = $_POST['height'];
    $width = $_POST['width'];
    $weight = $_POST['weight'];
    $description = $_POST['description'];
    $onsale = isset($_POST['onsale']);

    require_once "connect.php";

    $sql = "INSERT INTO `goods`( `name`, `price`, `img`, 
                    `category_id`, `manufacturer_id`, 
                    `lenght`, `width`, `height`, `weight`, 
                    `description`, `on_sale` ) 
                    VALUES( ?, ?, ?, 
                    ?, ?, 
                    ?, ?, ?, ?, 
                    ?, ?);";


    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        'sdsiiiiidsi',
        $name,
        $price,
        $img_new_name,
        $category_id,
        $manufacturer_id,
        $length,
        $width,
        $height,
        $weight,
        $description,
        $onsale
    );

    if (!$stmt->execute()) {
        $_SESSION['success_product_input'] = true;
    } else
        move_uploaded_file($img_tmp, "../imgs/products/$img_new_name");
}

header('Location: ../admin.php');
exit();
