<!-- Registration Form layout -->
<div class="login-container">
    <div class="image-container">
        <img src="./assets/lapMan.jpg" alt="Side Image">
    </div>
    <div class="form-container">
        <h1 id="login-header">Registration</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <button name="submit" type="submit">Register</button>
            <div class="optional-btn">
                <p>Already have an account ? <span id="small-btn">Log In</span></p>
            </div>
        </form>
    </div>
</div>

<?php
// Includes sql connection file
include "./phpComponents/sql/sqlConnect.php";

// Checks the input fields and stores it into Users table and also creates one specific table for user
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = $_POST['gender'];


    if (isset($email) && isset($hashPassword) && isset($username) && isset($gender)) {

        $command = "INSERT INTO Users(Username, Email, Gender, Password) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($command);
        $result = $stmt->execute(array($username, $email, $gender, $hashPassword));

        if ($result) {
            header("Location: ./index.php");
        } else {
            echo "failed";
        }
    } else {
        echo "MISSING!";
    }


    try {
        $user_own_db = "CREATE TABLE IF NOT EXISTS $username(
            id INT(6) PRIMARY KEY AUTO_INCREMENT, 
            productName VARCHAR(30) NOT NULL, 
            productDescription TEXT NOT NULL, 
            price DECIMAL (12 , 4 )NOT NULL, 
            date_data DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
            file_data TEXT NOT NULL,
            productId INT(6) NOT NULL
            )";



        $db->exec($user_own_db);
    } catch (Exception $e) {
        echo "ERROR CREATING USER'S OWN DB! " . $e->getMessage();
    }

}
?>