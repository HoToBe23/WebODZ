<?php

if (isset($_GET['s_category_id'])) {
    if ($_GET['s_category_id'] > 0) {
        $_SESSION['s_category_id'] = $_GET['s_category_id'];
    } else {
        unset($_SESSION['s_category_id']);
    }
}

$manufacturerids_set = isset($_GET['manufacturerids']);
$s_category_id_set = isset($_SESSION['s_category_id']);
$search_set = isset($_GET['search']);

if ($s_category_id_set or $manufacturerids_set or $search_set) {
    $where = " WHERE ";
    $some_params = [];


    $and_count = -1;
    if ($manufacturerids_set) {
        $and_count++;
    }
    if ($s_category_id_set) {
        $and_count++;
    }
    if ($search_set) {
        $and_count++;
    }

    if ($manufacturerids_set) {
        $some_params = $_GET['manufacturerids'];
        $where_types = "";
        $where .= "m.id IN ( ";
        foreach ($some_params as $mid) {
            $where .= "?, ";
            $where_types .= "i";
        }
        $where = rtrim($where, ", ");
        $where .= " )";

        if ($and_count > 0) {
            $where .= " AND ";
            $and_count--;
        }
    }

    if ($s_category_id_set) {
        $where .= " c.id = ? ";
        $where_types .= "i";
        array_push($some_params, $_SESSION['s_category_id']);

        if ($and_count > 0) {
            $where .= " AND ";
            $and_count--;
        }
    }

    if ($search_set) {
        $where .= 'g.name LIKE ?';
        $where_types .= "s";
        array_push($some_params, "%" . trim($_GET['search']) . "%"); //
    }
} else {
    unset($where_types);
    unset($where);
}
require "db_actions/load_db_data2.php";

?>

<div class="conteiner-fluid">
    <p class="text-center h3">
        Category:
        <?= isset($_SESSION['s_category_id']) ? $categoryList[$_SESSION['s_category_id']] : "All products" ?>
    </p>
</div>

<div class="container-fluid py-3 " id="product-container">

    <div>
        <form action="index.php" method="get" class="p-3 border">
            <p class="text-center fs-5 mb-1">Chose manufacturer</p>
            <ul class="list-group">

                <?php
                $count = 0;
                while ($manufacturer_obj = $manufacturers->fetch_assoc()) {
                    $id = $manufacturer_obj['id'];
                    $name = $manufacturer_obj['name'];
                ?>

                    <li class="list-group-item border-0">
                        <input name="manufacturerids[<?= $id ?>]" class="form-check-input me-1 " type="checkbox" value="<?= $id ?>" id="<?= $id ?>">
                        <label class="form-check-label" for="<?= $id ?>"><?= $name ?></label>
                    </li>

                <?php
                    $count++;
                }
                ?>

            </ul>
            <input name="search" type="text" class="form-control my-2" placeholder="Search for product name" aria-describedby="search-button">
            <button class="btn btn-info w-100 " type="submit" id="search-button"><i class="bi bi-search"></i> Search</button>
        </form>
    </div>

    <div class="conteiner d-flex flex-wrap">

        <?php
        $count = 0;
        while ($product = $products->fetch_assoc()) {
            $id = $product['id'];
            $name = $product['name'];
            $price = $product['price'];
            $img_path = $product['img'];
            $category = $product['category'];
            $manufacturer = $product['manufacturer'];
            $lenght = $product['lenght'];
            $width = $product['width'];
            $height = $product['height'];
            $weight = $product['weight'];
            $description = $product['description'];
            $on_sale = $product['on_sale'];
        ?>

            <div class="card mx-2 mb-2 rounded-0 boreder-0">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-<?= $id ?>">
                    <img src="imgs/products/<?= $img_path ?>" class="card-img-top mb-2 p-2" alt="Not found">
                </a>

                <div class="card-body p-3">
                    <a class="card-title text-decoration-none text-center me-auto" href="#" data-bs-toggle="modal" data-bs-target="#modal-<?= $id ?>">
                        <?= $name ?>
                    </a>
                    <p class="card-text text-nowrap text-bold <?= $on_sale ? "text-danger" : "" ?>">
                        <span class="fs-5"><?= $price ?></span> ₴ <?= $on_sale ? "ON SALE" : "" ?>
                    </p>
                </div>
            </div>

            <div class="modal fade" id="modal-<?= $id ?>" tabindex="-1" aria-labelledby="modal-content-<?= $id ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title w-100 fs-5 text-center" id="modal-content-<?= $id ?>"><?= $name ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="imgs/products/<?= $img_path ?>" class="w-100 mb-3" alt="Not found">

                            <p class="my-1 <?= $on_sale ? "text-danger" : "" ?>">Price: <?= $price ?> ₴ <?= $on_sale ? "ON SALE" : "" ?></p>
                            <p class="my-1">Manufacturer: <?= $manufacturer ?></p>
                            <p class="my-1">Lenght: <?= $lenght != null ? $width . " mm" : "No data" ?> </p>
                            <p class="my-1">Width: <?= $width != null ? $width . " mm" : "No data" ?> </p>
                            <p class="my-1">Height: <?= $height != null ? $height . " mm" : "No data" ?> </p>
                            <p class="my-1">Weight: <?= $weight != null ? $weight . " kg" : "No data" ?> </p>
                            <p class="my-1">Description: <?= $description != null ? $description : "No description" ?></p>
                        </div>
                        <div class="modal-footer">
                            <p class="text-primary text-center">For other info call us</p>
                        </div>
                    </div>
                </div>
            </div>




        <?php
            $count++;
        }
        ?>
    </div>
</div>