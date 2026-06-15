<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "db_actions/connect.php";

$sql = "SELECT 
            c.id,
            c.name
        FROM 
            `categories` c";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->get_result();
//------
$sql = "SELECT 
            m.id,
            m.name 
        FROM 
            `manufacturers` m";
$stmt = $conn->prepare($sql);
$stmt->execute();
$manufacturers = $stmt->get_result();
//------
$sql = "SELECT
            g.id,
            g.name,
            g.price,
            g.img,
            g.category_id,
            c.name as category,
            g.manufacturer_id,
            m.name as manufacturer,    
            g.lenght,
            g.width,
            g.height,
            g.weight,
            g.description,
            g.on_sale
        FROM
            `goods` g
        JOIN `manufacturers` m ON
            g.manufacturer_id = m.id
        JOIN categories c ON
            g.category_id = c.id";

if (isset($where)) {
    $sql .= $where;
}

$stmt = $conn->prepare($sql);

if (isset($where)) {
    $stmt->bind_param($where_types, ...$some_params);
}

$sql .= "ORDER BY g.name";

$stmt->execute();
$products = $stmt->get_result();
