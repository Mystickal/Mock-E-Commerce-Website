<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ecommerce';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email, realName, phoneNumber, userType FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $realName, $phoneNumber, $userType);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="modify-style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js'></script>

	</head>
	<body onload="myfunction()">
 <header>
            <div class="content-wrapper">
                <h1>Student Market</h1>

                <nav>
                    <a href="../productpage/index.php">Home</a>
                    <a href="../productpage/index.php?page=products">Products</a>
                    <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
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
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
                    <tr>
						<td>Name:</td>
						<td><?=$realName?></td>
					</tr>
                    <tr>
						<td>phoneNumber:</td>
						<td><?=$phoneNumber?></td>
					</tr>
                    <tr>
						<td>User Type:</td>
						<td id="userType"><?=$userType?></td>
					</tr>
                         <tr>
                        <td>Orders:</td>
                        <td align="left">
                            <a id="viewProducts" href="../productpage/vieworder.php">View Orders</a>
                        </td>
                    </tr>
                </table> 
                <div class="buttons2">
                        <td><a href="modify.php" class="buttons">Edit</a>
                        </div>
                <div class="buttons"><a id="sellerLine" href="../seller/read.php">Create products</a></div>
            </div>
        </div>
	</body>
</html>

 
<script type='text/javascript'>
         $(document).ready(function() {
            myFunction();
});

function myFunction(){
            
    if($('#userType').text()=="Buyer")
        {
            $('#sellerLine').hide();
        }
                };
</script> 


           

