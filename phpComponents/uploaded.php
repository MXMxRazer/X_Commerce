<!-- This file is responsible for uploading the product in the home page of the website -->

<?php

// Establish's sql connection
require "./sql/sqlConnect.php";

//Product Information
$pName = $_POST["productName"];
$pDes = $_POST["productDescription"];
$pImg = $_FILES["productImage"];
$pSeller = $_POST["productSeller"];
$pPrice = $_POST["productPrice"];

// Function to get the file 
function checkAndUploadFile()
{

    global $pImg, $db, $pName, $pDes, $pSeller, $pPrice;

    $imgName = $pImg['name'];
    $imgSize = $pImg['size'];
    $imgErr = $pImg['error'];
    $tmpName = $pImg['tmp_name'];

    //Checks the valid file and stores it in the database with other inputs 
    if ($imgErr === 0) {
        if ($imgSize > 1250000) {
            $msg = "Sorry, File size too large.";
            header("Location: http://localhost/finalProject/uploadProduct.php?error=$msg");
        } else {
            $newImgName = uniqid("img-", true) . '.' . strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
            $imgUploadPath = "../assets/" . $newImgName;
            move_uploaded_file($tmpName, $imgUploadPath);

            session_start();
            $username = $_SESSION['username'];

            $command_global = "INSERT INTO products(productName, productDescription, seller, price, file_data) VALUES (?, ?, ?, ?, ?)";
            $command_user = "INSERT INTO $username(productName, productDescription, price, file_data) VALUES (?, ?, ?, ?)";

            $stmt_global = $db->prepare($command_global);
            $stmt_user = $db->prepare($command_user);

            $result_global = $stmt_global->execute(array($pName, $pDes, $pSeller, $pPrice, $newImgName));
            $result_user = $stmt_user->execute(array($pName, $pDes, $pPrice, $newImgName));

            if ($result_global && $result_user) {
                include "./cart.php";
            } else {
                echo "<h1> Insertion failed </h1>";
            }

        }
    } else {
        $msg = "Sorry, Unknown error!";
        header("Location: http://localhost/finalProject/uploadProduct.php?error=$msg");
    }
}

//Checks all the inputs before instanciating the file checking and uploading function.
if (isset($pImg) && isset($pName) && isset($pDes) && isset($pSeller) && isset($pPrice)) {
    checkAndUploadFile();
    header("Location: http://localhost/finalProject/home.php");
}