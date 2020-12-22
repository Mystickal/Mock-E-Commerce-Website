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

if(isset($_POST['save'])) { 
    
    $db_username = $_POST['userName'];
    $db_password = $_POST['password'];
    $db_email = $_POST['email'];
    $db_name = $_POST['realName'];
    $db_phonenumber = $_POST['phoneNumber'];
    $db_id = $_SESSION['id'];
    
    
    $stmt = $con->prepare("UPDATE accounts
    SET    username = '$db_username', email='$db_email', realName='$db_name', phoneNumber = '$db_phonenumber'
    WHERE  id = '$db_id'");
    $stmt->execute();
    
    //header('Location: editLogout.php');
    header('Location: profile.php');
        
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
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
                <form action="modify.php" method="post" autocomplete="off">
				<table>
                    <tr>
						<td>User ID:</td>
						<td width=100%>
                            <a name="userID"><?=$_SESSION['id']?></a>
                        </td>
					</tr>
					<tr>
						<td>Username:</td>
						<td width=100%>
                            <input name="userName" class="modify-input" value="<?=$_SESSION['name']?>">
                        </td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
                            <input name="password" placeholder="Must be 6~12 characters">
                        </td>
					</tr>
					<tr>
						<td>Email:</td>
						<td>
                            <input name="email" value="<?=$email?>">
                        </td>
					</tr>
                    <tr>
						<td>Name:</td>
						<td>
                            <input name="realName" value="<?=$realName?>">
                        </td>
					</tr>
                    <tr>
						<td>phoneNumber:</td>
						<td>
                            <input name="phoneNumber" value="<?=$phoneNumber?>">
                        </td>
					</tr>
                    <tr>
						<td>User Type:</td>
						<td>
                            <a><?=$userType?></a> 
                        </td>
					</tr>
                    <tr>
                        <td></td>
                        <td></td>                         
                        <td align="right">
                            <form method="post">
                            <input type="submit" name="save" value="Save"> 
                            </form>
                        </td>
                        <td align="right">
                            <form action="profile.php" method="get">
                            <input type="submit" name="cancel" value="Cancel">
                            </form>
                        </td>
                    </tr>
				</table>
                    </form>
			</div>
            
		</div>
	</body>
</html>

