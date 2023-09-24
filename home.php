<!-- Home Page of the website -->

<?php include "./phpComponents/sql/sqlConnect.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Homepage</title>
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="stylesheet" href="./styles/sub-styles/header.css">
    <link rel="stylesheet" href="./styles/sub-styles/basic.css">
</head>

<body>
    <!-- header section -->
    <?php require_once "./phpComponents/header/header.php" ?>

    <?php
    $command = "SELECT * FROM products";
    $stmt = $db->prepare($command);
    $stmt->execute();

    $command2 = "SELECT * FROM products ORDER BY id DESC LIMIT 1";
    $stmt2 = $db->prepare($command2);
    $stmt2->execute();
    $row2 = $stmt2->fetch();
    ?>

    <div class="wrapper">

        <div id="featured-products-header">
            <h1>Latest Product</h1>
        </div>

        <div class="container">
            <div class="image-container">
                <img src=<?= "./assets/" . $row2["file_data"] ?> alt=<?= $row2["productName"] ?> id="img-huge">
            </div>
            <div class="content-container">
                <h2>
                    <?= $row2["productName"] ?>
                </h2>
                <p class="content">
                    <?= $row2["productDescription"] ?>
                </p>
                <span class="price">$
                    <?= $row2["price"] ?>
                </span>
                <button class="add_cart_btn" name="add_cart" type="submit">
                    <a href=<?= "cart.php?action=add&productName=" . $row2["productName"] ?>>
                        Add to Cart
                    </a>
                </button>
            </div>
        </div>

        <div id="featured-products-header">
            <h1>Featured Products</h1>
        </div>

        <section class="featured-products">
            <?php while ($row = $stmt->fetch()): ?>
                <div class="product">
                    <img src=<?= "./assets/" . $row["file_data"] ?> alt=<?= $row["productName"] ?>>
                    <h3>
                        <?= $row["productName"] ?>
                    </h3>
                    <p>
                        <?= $row["productDescription"] ?>
                    </p>
                    <span class="price">$
                        <?= $row["price"] ?>
                    </span>
                    <button class="add_cart_btn" name="add_cart" type="submit">
                        <a href=<?= "cart.php?action=add&productName=" . $row["productName"] ?>>
                            Add to Cart
                        </a>
                    </button>
                </div>
            <?php endwhile; ?>
        </section>
    </div>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> X-Commerce. All rights reserved.
        </p>
    </footer>

</body>

</html>


<?php

include "./phpComponents/sql/sqlConnect.php";

error_reporting(~E_ALL);

session_start();
$username = $_SESSION['username'];

if ($_GET['action'] == 'remove' && isset($_GET['productId'])) {

    try {
        $productId = $_GET['productId'];

        $command = "DELETE FROM $username WHERE id= :id";
        $stmt = $db->prepare($command);
        $stmt->bindParam(":id", $productId);
        $stmt->execute();
    } catch (Exception $e) {
        echo "error " . $e->getMessage();
    }
}


?>