<?php
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
    
}

if(isset($_POST['order'])) {
    
    $db_buyerID = $_SESSION['id'];
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $db_orderID= $_SESSION['id']*date("m")*31415;
    
    
    foreach ($products as $product){
        if($stmt = $pdo->prepare('INSERT INTO orders(productID, buyerID, orderID) VALUES (?,?,?)')){
            $db_pId = (int)$product['id'];
            
            
            $stmt->bindParam(1,$db_pId);
            $stmt->bindParam(2,$db_buyerID);
            $stmt->bindParam(3,$db_orderID);
            $stmt->execute();
        }
    }
    unset($_SESSION['cart']);
    header('Location: index.php?page=ordersuccess');
    exit;
    
} 



if(isset($_POST['update']) && isset($_SESSION['cart'])){
    header('Location: index.php?page=cart');
    exit;
}
?>

<?=template_header('Place Order')?>

<div class="cart content-wrapper">
    <h1>Order Summary</h1>
    <form action="index.php?page=order" method="post">
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
            
                <tr>
                    <td class="pId"><?=$product['id']?></td>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img src="images/<?=$product['img']?>" width="50" height="50" alt="<?=$product['productName']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['productName']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>
                    </td>
                    <td class="price">&yen;<?=$product['price']?></td>
                    <td class="quantity">
                        <?=$products_in_cart[$product['id']]?>
                    </td>
                    <td class="price">&yen;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">&yen;<?=$subtotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Edit Order" name="update">
            <input type="submit" value="Purchase" name="order">
        </div>
    </form>
</div>

<?=template_footer()?>