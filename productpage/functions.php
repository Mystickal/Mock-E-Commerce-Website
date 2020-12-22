<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'ecommerce';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	die ('Failed to connect to database!');
    }
}

// Template header, feel free to customize this
function template_header($title){
if(isset($_SESSION['loggedin'])){
    
// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <script src="script.js"></script>
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Student Market</h1>

                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                    <a href="../login/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				    <a href="../login/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    <form action="search.php" method="GET">
                        <input type="text" id="myInput" onkeyup="searchFunct()" placeholder="Search Products" name="query" />
                        <input type="submit" value="Search"/>
                    </form>
                </nav>

                <div class="link-icons">
                    <a href="index.php?page=cart" class="ofitsown">
						<i class="fas fa-shopping-cart"></i>
                    <span>$num_items_in_cart</span>
					</a>
                </div>
                
            </div>
        </header>
        <main>
EOT;
}else if(!isset($_SESSION['loggedin'])){
    // Get the amount of items in the shopping cart, this will be displayed in the header.
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Student Market</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                    <a href="../login/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                    <form action="search.php" method="GET">
                        <input type="text" id="myInput" onkeyup="searchFunct()" placeholder="Search Products" name="query" />
                        <input type="submit" value="Search"/>
                    </form>
                </nav>
                <div class="link-icons">
                    <a href="../login/index.html">
						<i class="fas fa-shopping-cart"></i>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Created By: Yulius Faustinus Edbert (201769990185), Zhong Tian Yu (201769990119), Natasha Kees Nicole (201769990107)</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
?>