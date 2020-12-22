<?php
session_start();
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
// Number of records to show on each page
$username = $_SESSION['name'];

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare("SELECT a.id, a.sellerName, a.productName, a.description, a.price, a.quantity, a.img, a.date_added FROM products a, accounts b WHERE a.sellerName = b.username AND b.username = '$username' ORDER BY a.date_added");
$stmt->execute();
// Fetch the records so we can display them in our template.
$productslist = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_products = $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
?>

<?=template_header('Product Information')?>

<div class="content read">
	<h2>Products on Sale</h2>
	<a href="create.php" class="create-product">Add New Product</a>
    <a href="sorted.php" class="sort-product">Sort By Price</a>
	<table>
        <thead>
            <tr>
                <td>Image</td>
                <td>Product Name</td>
                <td>Description</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Date Added</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productslist as $productlist): ?>
            <tr>
                <td><img src="../productpage/images/<?=$productlist['img']?>" width="80" height="80" alt="<?=$product['productName']?>"></td>
                <td><?=$productlist['productName']?></td>
                <td><?=$productlist['description']?></td>
                <td>&yen;<?=$productlist['price']?></td>
                <td><?=$productlist['quantity']?></td>
                <td><?=$productlist['date_added']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$productlist['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$productlist['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?=template_footer()?>