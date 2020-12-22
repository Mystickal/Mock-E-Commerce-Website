<?php
session_start();
include_once 'functions.php';

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ecommerce';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$db_userId = $_SESSION['id'];

echo $db_userId;

$stmt = $con->prepare('SELECT *
FROM Orders
INNER JOIN accounts ON ?=accounts.id
INNER JOIN products ON productID = products.id');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $db_userId);
$stmt->execute();
$productlist = $stmt->get_result();  
$stmt->fetch();
$stmt->close();   


    
?>

<?=template_header('View Order')?>
<div class="cart content-wrapper">
    <h1>Order Summary</h1>
    <form action="index.php?page=order" method="post">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th colspan="1">Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>          
                    <th colspan="2">Order Number</th>                
                    
                </tr>
            </thead>
            <tbody style="text-align:center;">
                <?php if (empty($productlist)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no orders yet!</td>
                </tr>
                <?php else: ?>
                <?php foreach ($productlist as $product): ?>
            
                <tr>
                    <td><?=$product['id']?></td>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img src="images/<?=$product['img']?>" width="50" height="50" alt="<?=$product['productName']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['productName']?></a>
                        <br>
                    </td>
                    <td class="price">&yen;<?=$product['price']?></td>
                    <td class="quantity">
                        <?=$product['quantity']?>
                    </td>
                    <td class="price">&yen;<?=$product['price'] * $product['quantity']?></td>
                    <td class="orderNumber">
                        <?=$product['orderID']?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        
    </form>
</div>  
    </body>
    </body>
</html>


