<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <title>Future furniture</title>
  <?php require_once "includes/links_header.php" ?>
</head>

<body class="d-flex flex-column min-vh-100">
  <?php require_once "includes/header.php" ?>
  <?php
  if (!isset($_SESSION['logged_in'])) {
    require_once "includes/carousel.php";
    require_once "includes/login_hero.php";
  } else {
    require_once "includes/products_conteiner.php";
  }
  ?>
  <?php require_once "includes/footer.php" ?>

  <?php require_once "includes/links_body.php" ?>
  <script src="javascript/product_container.js"></script>
</body>

</html>