<?php include "./phpComponents/sql/sqlConnect.php" ?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/sub-styles/header.css">
    <link rel="stylesheet" href="./styles/sub-styles/basic.css">
    <link rel="stylesheet" href="./styles/uploadProduct.css">
</head>

<body>

    <!-- header section -->
    <?php require_once "./phpComponents/header/header.php" ?>

    <div class="upload-container">

        <h2>Upload a New Product</h2>
        <form method="POST" action="./phpComponents/uploaded.php" enctype="multipart/form-data">
            <div class="input-group">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required>
            </div>
            <div class="input-group">
                <label for="productDescription">Product Description:</label>
                <textarea id="productDescription" name="productDescription" rows="4" required></textarea>
            </div>
            <div class="input-group">
                <label for="productImage">Product Image:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>
            </div>
            <div class="input-group">
                <label for="productSeller">Seller:</label>
                <input type="text" id="productSeller" name="productSeller" required>
            </div>
            <div class="input-group">
                <label for="productPrice">Price <em>(in US dollars)</em>:</label>
                <input type="number" step="0.01" id="productPrice" name="productPrice" required>
            </div>
            <div class="input-group">
                <label for="publishDate">Publish Date:</label>
                <input type="date" id="publishDate" name="publishDate" disabled>
            </div>
            <input type="submit" value="Upload Product" name="submit" id="submit" />
        </form>
    </div>

    <script src="./scripts/uploadProduct.js" defer></script>
</body>

</html>