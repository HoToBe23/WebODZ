<?php require "db_actions/load_db_data.php"; ?>

<div class="container-fluid" id="admin-tabs">
  <ul class="nav nav-tabs border-left">
    <li class="nav-item">
      <a class="nav-link text-body" href="#">Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-body" href="#">Manufacturers</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-body" href="#">Products</a>
    </li>
  </ul>

  <div class="tab-container p-3 border-start border-end border-bottom">

    <div class="tab-content bg-body d-flex">

      <div class="me-3">

        <form action="db_actions/addcategory.php" method="post" class="d-flex flex-column p-3 border rounded">
          <legend class="ms-3">Enter category</legend>
          <div class=" my-1">
            <label class="ms-3 my-1" for="cname">Name</label>
            <input name="cname" class="form-control form-control-md" id="cname" placeholder="" required>
          </div>

          <button class="btn btn-primary my-3" type="submit">Add</button>

          <?php if (isset($_SESSION['success_category_input'])) : ?>
            <div class="ps-2 text-danger">
              Category name already exists!
            </div>
          <?php endif; ?>
          <?php unset($_SESSION['success_category_input']); ?>

          <?php if (isset($_SESSION['success_category_delete'])) : ?>
            <div class="ps-2 text-danger">
              Category must be used, you can't delete it!
            </div>
          <?php endif; ?>
          <?php unset($_SESSION['success_category_delete']); ?>
        </form>
      </div>

      <div>
        <table class="table table-striped align-middle table-responsive border text-center">
          <tr class="table-primary">
            <td>Name</td>
            <!--td>Edit</td-->
            <td>Delete</td>
          </tr>

          <?php
          while ($category_obj = $categories->fetch_assoc()) {
            $id = $category_obj['id'];
            $name = $category_obj['name'];
            $categoryList[$id] = $category_obj['name'];
          ?>

            <tr>
              <td><?= $name ?></td>

              <!--td>
                <a href="#" class="btn btn-outline-warning border-0" role="button">
                  <i class="bi bi-pencil-square"></i>
                </a>
              </td-->

              <td>
                <a href="db_actions/deletecategory.php?id=<?= $id ?>" class="btn btn-outline-danger border-0" role="button">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>

            </tr>

          <?php  } ?>

        </table>
      </div>

    </div>

    <div class="tab-content bg-body d-flex">

      <div class="me-3">

        <form action="db_actions/addmanufacturer.php" method="post" class="d-flex flex-column p-3 border rounded">
          <legend class="ms-3">Enter manufacturer</legend>
          <div class=" my-1">
            <label class="ms-3 my-1" for="mname">Name</label>
            <input name="mname" class="form-control form-control-md" id="mname" placeholder="" required>
          </div>

          <button class="btn btn-primary my-3" type="submit">Add</button>

          <?php if (isset($_SESSION['success_manufacturer_input'])) : ?>
            <div class="ps-2 text-danger">
              Manufacturer name already exists!
            </div>
          <?php endif; ?>
          <?php unset($_SESSION['success_manufacturer_input']); ?>

          <?php if (isset($_SESSION['success_manufacturer_delete'])) : ?>
            <div class="ps-2 text-danger">
              Manufacturer must be used, you can't delete it!
            </div>
          <?php endif; ?>
          <?php unset($_SESSION['success_manufacturer_delete']); ?>
        </form>

      </div>

      <div>
        <table class="table table-striped align-middle table-responsive border text-center">
          <tr class="table-primary">
            <td>Name</td>
            <!--td>Edit</td-->
            <td>Delete</td>
          </tr>

          <?php
          while ($manufacturer_obj = $manufacturers->fetch_assoc()) {
            $id = $manufacturer_obj['id'];
            $name = $manufacturer_obj['name'];
            $manufacturerList[$id] = $name;
          ?>

            <tr>
              <td><?= $name ?></td>

              <!--td>
                <a href="#" class="btn btn-outline-warning border-0" role="button">
                  <i class="bi bi-pencil-square"></i>
                </a>
              </td-->

              <td>
                <a href="db_actions/deletemanufacturer.php?id=<?= $id ?>" class="btn btn-outline-danger border-0" role="button">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>

            </tr>

          <?php  } ?>

        </table>
      </div>

    </div>

    <div class="tab-content bg-body d-flex">

      <div class="me-3">
        <form action="db_actions/addproduct.php" method="post" class="d-flex flex-column p-3 border rounded form-check" enctype="multipart/form-data">

          <legend class="ms-3">Enter product</legend>

          <div class=" mb-2">
            <label class="ms-3" for="prod_name">Name</label>
            <input name="name" class="form-control form-control-md" id="prod_name" placeholder="" required>
          </div>

          <div class=" mb-2">
            <label class="ms-3" for="prod_price">Price</label>
            <input name="price" class="form-control form-control-md" id="prod_price" placeholder="" required>
          </div>

          <div class="mb-2">
            <label class="ms-3 mb-1" for="prodImg">Upload prod imgage</label>
            <input name="img" type="file" class="form-control" id="prodImg" required>
          </div>

          <select name="category_id" class="form-select my-2" id="categorySelect" required>
            <option value="" selected>Choose category</option>
            <?php foreach ($categoryList as $id => $cname) { ?>
              <option value="<?= $id ?>"><?= $cname ?></option>
            <?php } ?>
          </select>

          <select name="manufacturer_id" class="form-select my-2" id="manufacturerSelect" required>
            <option value="" selected>Choose manufacturer</option>
            <?php foreach ($manufacturerList as $id => $cname) { ?>
              <option value="<?= $id ?>"><?= $cname ?></option>
            <?php } ?>
          </select>

          <div class=" mb-2">
            <label class="ms-3" for="prod_length">Length</label>
            <input name="length" class="form-control form-control-md" id="prod_length" placeholder="">
          </div>

          <div class=" mb-2">
            <label class="ms-3" for="prod_height">Height</label>
            <input name="height" class="form-control form-control-md" id="prod_height" placeholder="">
          </div>

          <div class=" mb-2">
            <label class="ms-3" for="prod_width">Width</label>
            <input name="width" class="form-control form-control-md" id="prod_width" placeholder="">
          </div>

          <div class=" mb-2">
            <label class="ms-3" for="prod_weight">Weight</label>
            <input name="weight" class="form-control form-control-md" id="prod_weight" placeholder="">
          </div>

          <div class="mb-4">
            <label class="ms-3" for="prod_descr">description</label>
            <input name="description" class="form-control form-control-md" id="prod_descr" placeholder="">
          </div>

          <div class="mb-2 ms-2 form-check">
            <input name="onsale" class="form-check-input" type="checkbox" value="true" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              On Sale
            </label>

          </div>


          <button class="btn btn-primary my-3" type="submit">Add</button>

        </form>

        <?php if (isset($_SESSION['success_product_input'])) : ?>
          <div class="ps-2 text-danger">
            Check your input!
          </div>
        <?php endif; ?>
        <?php unset($_SESSION['success_product_input']); ?>
      </div>

      <div class="">
        <table class="table table-striped align-middle table-responsive border text-center" id="products-table">
          <tr class="table-primary">
            <td>Name</td>
            <td>Price</td>
            <td>img</td>
            <td>Category</td>
            <td>Manufacturer</td>
            <td>Length</td>
            <td>Height</td>
            <td>Width</td>
            <td>Weight</td>
            <td>Description</td>
            <td>On Sale</td>
            <!--td>Edit</td-->
            <td>Delete</td>
          </tr>

          <?php
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
            <tr>
              <td><?= $name ?></td>
              <td class="text-nowrap"><?= $price ?> ₴</td>

              <td class="w-auto">
                <img src="imgs/products/<?= $img_path ?>" class="" alt="Not found">
              </td>

              <td><?= $category ?></td>
              <td><?= $manufacturer ?></td>
              <td class="text-nowrap"><?= $lenght != null ? $lenght." mm" : "No data" ?></td>
              <td class="text-nowrap"><?= $height != null ? $height." mm" : "No data" ?></td>
              <td class="text-nowrap"><?= $width != null ? $width." mm" : "No data" ?></td>
              <td class="text-nowrap"><?= $weight != null ? $weight." kg" : "No data" ?></td>
              <td><?= $description ?></td>
              <td>
                <?php if ($on_sale) {
                  echo '<i class="bi bi-check-lg"></i>';
                } else {
                  echo '<i class="bi bi-x-lg"></i>';
                }
                ?>
              </td>

              <!--td>
                <a href="#" class="btn btn-outline-warning border-0" role="button">
                  <i class="bi bi-pencil-square"></i>
                </a>
              </td-->

              <td>
                <a href="db_actions/deleteproduct.php?id=<?= $id ?>" class="btn btn-outline-danger border-0" role="button">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>

            </tr>
          <?php  } ?>
        </table>
      </div>

    </div>
  </div>



</div>