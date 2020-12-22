<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
echo $id = $_GET['id'];

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ecommerce';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if(isset($_POST['save'])){
                
        $db_productName = $_POST['productName'];
        $db_desc = $_POST['description']; 
        $db_price = $_POST['price']; 
        $db_img = $_POST['img']; 
        $db_quantity = $_POST['quantity']; 
        $db_id = $_GET['id'];
                
        // Update the record
        $stmt = $con->prepare("UPDATE products SET productName = '$db_productName', description = '$db_desc', price = '$db_price', img = '$db_img', quantity = '$db_quantity' WHERE id = '$db_id'");
    /*    $stmt = $con ->prepare("UPDATE products SET description = '$db_desc', price = '$db_price'  WHERE id='$db_id'");*/
        $stmt->execute();
        $msg = 'Updated Successfully!';
        
        header('Location: read.php');
    }
    
    $db_pid = $_GET['id'];
    $stmt = $con->prepare("SELECT productName, description, price, img, quantity FROM products WHERE id = '$db_pid'");
      

    //$stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($productName, $description, $price, $img, $quantity);
    $stmt->fetch();
    $stmt->close();



    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        die ('Contact doesn\'t exist with that ID!');
    }

?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Products #<?=$product['id']?></h2>
    <form action="update.php?id=<?=$product['id']?>" method="post">
        <label for="productName">Product Name</label>
        <input type="text" name="productName" placeholder="iPhone 11" value="<?=$productName?>">
        
        
        <label for="description">Description</label>
        <label for="price">Price</label>
        
       
        <input type="text" name="description" placeholder="New Product!" value="<?=$description?>">
        <input type="number" step="any" name="price" placeholder="8000" value="<?=$price?>">
        
        <label for="quantity">Quantity</label>
        <label for="img">Image Link</label>
        
        <input type="number" name="quantity" placeholder="10" value="<?=$quantity?>">
        
        <input type="text" name="img" placeholder="imagename.jpg" value="<?=$img?>">
        
        <input type="submit" name="save" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>