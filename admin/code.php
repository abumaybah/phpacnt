<?php

if (isset($_POST['add_product_btn'])) {
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $cost_per_one = $_POST['cost_per_one'];
    $quantity = $_POST['quantity'];

    $product_img = $_FILES['product_img']['name'];
    $path = 'uploads';
    $img_ext = pathinfo($product_img, PATHINFO_EXTENSION);
}
