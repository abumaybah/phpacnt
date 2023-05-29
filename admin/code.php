<?php
session_start();
include('../config/dbcon.php');
include('../funcs/myfunctions.php');
if (isset($_POST['add_product_btn'])) {
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $cost_per_one = $_POST['cost_per_one'];
    $quantity = $_POST['quantity'];

    $product_img = $_FILES['product_img']['name'];
    $path = '../uploads';
    $img_ext = pathinfo($product_img, PATHINFO_EXTENSION);
    $filename = time() . '.' . $img_ext;
    $cate_query = "INSERT INTO products (productname, quantity, image, cost_per_one, category) VALUES ('$product_name', '$quantity', '$filename', '$cost_per_one', '$product_category')";
    $cate_query_run = mysqli_query($con, $cate_query);

    if ($cate_query_run) {
        move_uploaded_file($_FILES['product_img']['tmp_name'], $path . '/' . $filename);

        redirect('add-category.php', 'Product added successfully');
    } else {
        redirect('add-category.php', 'Something went wrong');
    }
} else if (isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $cost_per_one = $_POST['cost_per_one'];
    $quantity = $_POST['quantity'];
    $new_product_img = $_FILES['product_img']['name'];
    $old_product_img = $_POST['old-img'];

    if ($new_product_img != '') {
        // $update_filename = $new_product_img;
        $img_ext = pathinfo($new_product_img, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $img_ext;
    } else {
        $update_filename = $old_product_img;
    }
    $path = '../uploads';
    $update_query = "UPDATE products SET productname='$product_name', quantity='$quantity', image='$update_filename', cost_per_one='$cost_per_one', category='$product_category' WHERE id='$product_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if ($_FILES['product_img']['name'] != "") {
            move_uploaded_file($_FILES['product_img']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists('../uploads/' . $old_product_img)) {
                unlink('../uploads/' . $old_product_img);
            }
        }
        redirect("edit-product.php?id=$product_id", 'Product updated successfully');
    } else {
        redirect("edit-product.php?id=$product_id", 'Something went wrong');
    }
} else if (isset($_POST['delete_product_btn'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $product_query = "SELECT * FROM products WHERE id='$product_id' ";
    $product_query_run = mysqli_query($con, $product_query);
    $prodcut_data = mysqli_fetch_array($product_query_run);
    $image = $prodcut_data['image'];
    $delete_query = "DELETE FROM products WHERE id='$product_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        if (file_exists('../uploads/' . $image)) {
            unlink('../uploads/' . $image);
        }
        redirect("product.php", 'Product deleted successfully');
    } else {
        redirect('product.php', 'Something went wrong');
    }
}
