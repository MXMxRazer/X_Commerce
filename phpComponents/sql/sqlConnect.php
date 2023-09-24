<?php

// This file also establishes a connection to MySQL,
// selects the database, and sets the encoding.
// This file also creates the necessary tables for the program to work with.
try {

    $dsn = "mysql:host=localhost;dbname=test_product";
    $dbusername = "root";
    $dbpassword = "";


    $db = new PDO($dsn, $dbusername, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS Products(
            id INT(6) PRIMARY KEY AUTO_INCREMENT, 
            productName VARCHAR(30) NOT NULL, 
            productDescription TEXT NOT NULL, 
            seller VARCHAR(50), 
            price DECIMAL (12 , 4 )NOT NULL, 
            date_data DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
            file_data TEXT NOT NULL)";

    $db->exec($sql);

    $usr_sql = "CREATE TABLE IF NOT EXISTS Users(
        id INT(6) PRIMARY KEY AUTO_INCREMENT, 
        Username TEXT NOT NULL UNIQUE, 
        Email TEXT NOT NULL UNIQUE,  
        Gender VARCHAR(10) NOT NULL, 
        Password TEXT NOT NULL
        )";

    $db->exec($usr_sql);

} catch (Exception $e) {
    //Disconnects on the case of exception
    die(
        '<p style="color:red">Could not connect to DB: ' . $e->getMessage() . '</p>'
    );
}