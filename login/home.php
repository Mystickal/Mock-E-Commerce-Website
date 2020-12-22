<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
   <header>
            <div class="content-wrapper">
                <h1>Student Market</h1>

                <nav>
                    <a href="../productpage/index.php">Home</a>
                    <a href="../productpage/index.php?page=products">Products</a>
                    <a href="../login/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    <form action="../productpage/search.php" method="GET">
                        <input type="text" id="myInput" onkeyup="searchFunct()" placeholder="Search Products" name="query" />
                        <input type="submit" value="Search"/>
                    </form>
                </nav>

                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
					</a>
                </div>
                
            </div>
        </header>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>