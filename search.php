<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/sub-styles/header.css">
    <link rel="stylesheet" href="./styles/sub-styles/basic.css">
    <link rel="stylesheet" href="./styles/search.css">
</head>

<body>
    <?php include "./phpComponents/header/header.php" ?>

    <form class="search-container" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <input type="text" name="search-bar" id="searchInput" placeholder="Search...">
        <button id="searchButton" name="search">Search</button>
    </form>


    <?php

    include "./phpComponents/sql/sqlConnect.php";

    if (isset($_POST['search'])) {
        if (isset($_POST['search-bar'])) {
            $command = "SELECT * FROM products WHERE productName=?";
            $stmt = $db->prepare($command);
            $stmt->execute(array($_POST['search-bar']));
        } else {
            echo "";
        }
    } else {
        echo "";
    }

    ?>

    <?php global $stmt;
    if ($stmt !== null): ?>
        <?php while ($row = $stmt->fetch()): ?>
            <div class="container-card">
                <div class="card">
                    <img src=<?= "./assets/" . $row["file_data"] ?> alt="Product Image" class="card-image">
                    <div class="card-content">
                        <h3 class="card-title">
                            <?= $row["productName"] ?>
                        </h3>
                        <p class="card-description">
                            <?= $row["productDescription"] ?>
                        </p>
                        <div class="card-price">
                            <?= $row["price"] ?>
                        </div>
                        <button class="btn" name="add_cart" type="submit">
                            <a href=<?= "cart.php?action=add&productName=" . $row["productName"] ?>>
                                Add to Cart
                            </a>
                        </button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
</body>

</html>