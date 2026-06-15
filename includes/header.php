<?php

$sql = "SELECT";
$where = "true";

require_once "db_actions/load_db_data.php";

?>

<div class="container-fluid">
  <header class="d-flex flex-wrap justify-content-center py-2 me-md-auto mt-2 mb-4 border-bottom">
    <a href="index.php" class="my-auto me-auto px-3 link-body-emphasis text-decoration-none">
      <span class="fs-3">Future furniture</span>
    </a>

    <ul class="nav nav-pills">
      <?php if (isset($_SESSION['logged_in'])) : ?>
        <li class="nav-item dropdown me-2 my-auto">
          <a class="dropdown-toggle btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Chose category
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?s_category_id=0">All categories</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php
            $count = 0;
            while ($categoriy_obj = $categories->fetch_assoc()) {
              $id = $categoriy_obj['id'];
              $name = $categoriy_obj['name'];
              $categoryList[$id] = $name;
            ?>

              <li><a class="dropdown-item" href="index.php?s_category_id=<?= $id ?>"><?= $name ?></a></li>

            <?php } ?>

          </ul>
        </li>
      <?php endif; ?>

      <?php if ($_SESSION['logged_in'] == "admin") : ?>
        <li class="nav-item mx-1 my-auto">
          <ul class="p-0 btn-group border" id="admin-page-handler">
            <a href="index.php" class="btn btn-secondary" role="button">Home page</a>
            <a href="admin.php" class="btn btn-secondary" role="button">Admin page</a>
          </ul>
        </li>
      <?php endif; ?>

      <?php if (!isset($_SESSION['logged_in'])) : ?>

        <li class="nav-item mx-1 my-auto">
          <a href="login.php" class="btn btn-primary" role="button">Log in</a>
        </li>

        <li class="nav-item mx-1 my-auto">
          <a href="signup.php" class="btn btn-secondary" role="button">Sign up</a>
        </li>

      <?php else : ?>
        <li class="nav-item mx-1 my-auto"><a href="logout.php" class="btn btn-secondary" role="button">
            <i class="bi bi-box-arrow-right"></i></a>
        </li>

      <?php endif; ?>

    </ul>
  </header>
</div>