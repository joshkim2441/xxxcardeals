<?php
session_start();
require_once "ShoppingCart.php";
require_once 'db.php';
if($_SESSION['loggedIn']){
$member_id = $_SESSION['id'];
}

// Retrieve checkbox values
$marineValue = isset($_POST['marine']) ? intval($_POST['marine']) : 0;
$airValue = isset($_POST['air']) ? intval($_POST['air']) : 0;
$landValue = isset($_POST['land']) ? intval($_POST['land']) : 0;
$transport = isset($_POST['transport']) ? $_POST['transport'] : '';
// Retrieve selected insurance value
$insurance = isset($_POST['insurance']) ? $_POST['insurance'] : '';

// Now you can use these values as needed
// For example, insert them into a database or perform calculations

?>
<?php
$transport = 0;
$insurance = 0;
$data = array('transport', 'insurance');
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {

                $productResult = $shoppingCart->getProductByCode($_GET["code"]);

                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);

                $data = $shoppingCart->updateCart($transport, $insurance, $member_id);

                if (! empty($cartResult)) {
                    // Update cart item quantity in database
                    $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    // Add to cart table
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id);
                }
            }
            break;
        case "remove":
            // Delete single entry from the cart
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Empty cart
            $shoppingCart->emptyCart($member_id);
            break;
    }
}

?>
<HTML>
<HEAD>
<TITLE>xXx Shopping Cart</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../styles/ppstyle.css" type="text/css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</HEAD>
<BODY>
<?php

$cartItem = $shoppingCart->getMemberCartItem($member_id);

$item_quantity = 0;
$item_price = 0;
$transport = 0;
$insurance = 0;
$totalCost = 0;
$data = array('transport', 'insurance');

if (! empty($cartItem)) {
    if (! empty($cartItem)) {
            foreach ($cartItem as $item) {
                $item_quantity = $item_quantity + $item["quantity"];
                $item_price = $item_price + $item["price"] * $item["quantity"];
                $transport;
                $insurance = $item_price * $insurance;
                $totalCost = $item_price + $transport + $insurance;
            }
    }
}
?>
<div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Shopping Cart</div>

            <a id="btnEmpty" href="ppindex.php?action=empty"><img
                src="../images/empty-cart.png" alt="empty-cart"
                title="Empty Cart" class="float-right" /></a>
            <div class="cart-status">
                <div>Total Quantity: <?php echo $item_quantity; ?></div>
                <div>Total Price: $ <?php echo $item_price; ?></div>
                <div>Transport: $ <?php echo $transport; ?></div>
                <div>Insurance: $ <?php echo $insurance; ?></div>
                <div>Total Cost: $ <?php echo $totalCost; ?></div>
            </div>
        </div>
        <?php
        if (! empty($cartItem)) {
            ?>
<?php
            require_once "cart-list.php";
            ?>
            <div class="align-right">
            <a href="process-checkout.php"><button class="btn-action" name="check_out">Go To Checkout</button></a>
            </div>
<?php
        } // End if !empty $cartItem
        ?>

</div>
<?php
require_once "product-list.php";
?>
    <script>
    // Assuming your checkboxes have unique IDs (e.g., "marine", "air", "land")
const marineCheckbox = document.getElementById("marine");
const airCheckbox = document.getElementById("air");
const landCheckbox = document.getElementById("land");
const dropdown = document.getElementById("dropdown");

// Initialize a variable to store the total value
let transport = 0;

// Check if each checkbox is selected and add its value to the total
if (marineCheckbox.checked) {
    transport += parseInt(marineCheckbox.value);
}
if (airCheckbox.checked) {
    transport += parseInt(airCheckbox.value);
}
if (landCheckbox.checked) {
    transport += parseInt(landCheckbox.value);
}
const insuranceCost = dropdown.options[dropdown.selectedIndex].value;
// Now "totalValue" contains the sum of checked checkboxes
const formData = new FormData();
formData.append("transport", totalValue);
formData.append("insuranceCost", selectedOption);
</script>
</BODY>
</HTML>
