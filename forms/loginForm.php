<!-- Registration Form layout -->
<div class="login-container">
    <div class="image-container">
        <img src="./assets/lapMan.jpg" alt="Side Image">
    </div>
    <div class="form-container">
        <h1 id="login-header">Login</h1>
        <p class="no-warning">Invalid Inputs. Try Again!</p>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Login</button>
            <div class="optional-btn">
                <p>Don't have an account ? <span id="small-btn">Register</span></p>
            </div>
        </form>
    </div>
</div>

<?php

//Don't want any errors in production site.
error_reporting(~E_ALL);

// Checks the input fields and selects the user field from the Users table for invalid inputs
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    session_start();
    $_SESSION['username'] = $username;

    if (isset($password) && isset($username)) {

        $command = "SELECT * FROM Users WHERE Username=?";
        $stmt = $db->prepare($command);
        $result = $stmt->execute(array($username));
        $row = $stmt->fetch();

        if (password_verify($password, $row['Password'])) {
            header("Location: ./home.php");
        } else {
            echo "
            <script>
                const warning = document.querySelector('.no-warning');
        
                warning.classList.add('warning'); 
                warning.classList.remove('no-warning'); 

                setTimeout(() => {
        
                    warning.classList.remove('warning'); 
                    warning.classList.add('no-warning'); 

                }, 4000); 
            </script>
            ";
        }
    }
}
?>