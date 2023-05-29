<?php
session_start();
include('includes/header.php');
include('funcs/userfuncs.php');

?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="com-md-12">
                <h2>Our products</h2>
                <div class="row">
                    <?php
                    $products = getAll('products');
                    if (mysqli_num_rows($products) > 0) {
                        foreach ($products as $product) {
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="uploads/<?= $product['image'] ?>" alt="<?= $product['productname'] ?>"
                                    width="100px" height="100px">
                                <h3><?= $product['productname'] ?></h3>
                                <h4>Quantity: <?= $product['quantity'] ?></h4>
                                <h4>Cost: <?= $product['cost_per_one'] ?></h4>
                                <h4>Category: <?= $product['category'] ?></h4>
                                <h4>Arrival: <?= $product['arrived_at'] ?></h4>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    } else {
                        echo "No products available";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>