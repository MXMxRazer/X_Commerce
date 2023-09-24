<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/sub-styles/header.css">
    <link rel="stylesheet" href="./styles/sub-styles/basic.css">
    <link rel="stylesheet" href="./styles/cart.css">
    <title>Document</title>
</head>

<body>
    <?php include "./phpComponents/header/header.php" ?>

    <?php

    include "./phpComponents/sql/sqlConnect.php";

    error_reporting(~E_ALL);

    session_start();
    $username = $_SESSION['username'];

    if ($_GET['action'] == 'add' && isset($_GET['productName'])) {
        $productName = $_GET['productName'];

        $command = "SELECT * FROM  products WHERE productName=?";
        $stmt = $db->prepare($command);
        $stmt->execute(array($productName));
        $row = $stmt->fetch();

        $command = "INSERT INTO $username(productName, productDescription, price, file_data, productId) VALUES(?, ?, ?, ?, ?)";
        $stmt = $db->prepare($command);
        $stmt->execute(array($row['productName'], $row['productDescription'], $row['price'], $row["file_data"], $row["id"]));
    }

    $command1 = "SELECT * FROM $username";
    $stmt1 = $db->prepare($command1);
    $stmt1->execute();

    ?>

    <div class="car-container">
        <h2>My Cart</h2>
        <?php global $stmt1;
        if ($stmt1 !== null): ?>
            <?php while ($row1 = $stmt1->fetch()): ?>
                <div class="card">
                    <img src=<?= "./assets/" . $row1["file_data"] ?> alt="Product Image" class="card-image">
                    <div class="card-content">
                        <h3 class="card-title">
                            <?= $row1["productName"] ?>
                        </h3>
                        <p class="card-description">
                            <?= $row1["productDescription"] ?>
                        </p>
                        <button class="add-btn" name="add_cart" type="submit">
                            <a href=<?= "home.php?action=remove&productId=" . $row1["id"] ?>>
                                Remove from cart
                            </a>
                        </button>
                    </div>
                    <div class="card-price">
                        <?= $row1["price"] ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

</body>

</html>