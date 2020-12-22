<?php
session_start();
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

$username = $_SESSION['name'];
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $productName = isset($_POST['productName']) ? $_POST['productName'] : '';
    
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    
    $img = isset($_POST['img']) ? $_POST['img'] : '';
    
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO products VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $username, $productName, $description, $price, $quantity, $img, $created]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Add New Product')?>

<div class="content update">
	<h2>Add New Products</h2>
    <form action="create.php" method="post">
        <label for="productName">Product Name</label>
        <label for="desc">Description</label>
        <input type="hidden" name="id" placeholder="24" value="auto" id="id">
        <input type="text" name="productName" placeholder="iPhone 11" id="productName">
        <input type="longtext" name="description" placeholder="New Product!" id="description">
        <label for="price">Price</label>
        <label for="quantity">Quantity</label>
        <input type="number" step="any" name="price" placeholder="8000" id="price">
        <input type="number" name="quantity" placeholder="99" id="quantity">
        <label for="img">Image Link</label>
        <label for="created">Creation Date</label>
        <input type="text" name="img" placeholder="imagename.jpg" id="img">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>