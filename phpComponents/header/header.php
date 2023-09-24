<!-- Includes common header file for the website -->
<header>
    <div class="logo">
        X-Commerce
    </div>
    <nav>
        <ul>
            <li><a href="./home.php">Home</a></li>
            <li><a href="./search.php">Search</a></li>
            <li><a href="./uploadProduct.php">Upload</a></li>
            <li><a href="./cart.php">My Cart</a></li>
            <li><a href="./index.php">Logout</a></li>
            <!-- Retriving session inputs to render into navbar -->
            <?php
            error_reporting(~E_ALL);
            session_start();
            ?>
            <li><a href="./cart.php">
                    <?= "Hello, " . $_SESSION['username'] ?>
                </a></li>
        </ul>
    </nav>
</header>