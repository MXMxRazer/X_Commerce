<!-- First page user lands on Login page -->

<!-- Includes sql connection file -->
<?php include "./phpComponents/sql/sqlConnect.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Document</title>
</head>

<body>
    <!-- Includes login form layout with the php processing -->
    <?php include "./forms/loginForm.php" ?>

    <!-- Includes some basic scripts -->
    <script src="./scripts/index.js" defer></script>
</body>

</html>