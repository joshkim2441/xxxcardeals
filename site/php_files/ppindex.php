<?php
session_start();
require_once "ShoppingCart.php";
require_once ('db.php');
if($_SESSION['loggedIn']){
$member_id = $_SESSION['id'];
} // you can your integerate authentication module here to get logged in member

//$transport = $_GET['transport'];
//$insurance = $_GET['insurance'];
$transport = 0;
$insurance = 0;
if (isset($_GET['action']) && $_GET['action'] == 'add') {
  // Access selected transport and insurance
  $transport = array();
  if (isset($_GET['marine'])) {
    $transport[] = $_GET['marine']; // Marine Cargo
  }
  if (isset($_GET['air'])) {
    $transport[] = $_GET['air']; // Air Freight
  }
  if (isset($_GET['land'])) {
    $transport[] = $_GET['land']; // Land Cargo
  }

  $insurance = isset($_GET['dropdown']) ? $_GET['dropdown'] : 0; // Default to 0 if not selected
}
  // Check if form is submitted and data is present in hidden fields
  if (isset($_GET['transport']) && isset($_GET['insurance'])) {
    $transport = explode(',', $_GET['transport']); // Convert comma-separated string to array
    $insurance = $_GET['insurance'];

    // Add selected items to the shopping cart (logic depends on your ShoppingCart class)
    //$shoppingCart->addItem($selectedtransportCost, $insurance);
  }
if (isset($_POST['action']) && $_POST['action'] == 'add') {
  $data = json_decode(file_get_contents('php://input'), true); // Assuming JSON data

  if ($data) {
    $transport = $data['transportCost'];
    $insurance = $data['insuranceCost'];

    // Use $transport and $insurance for further processing
    // ...
  } else {
    // Handle invalid JSON data (optional)
  }
}
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {

                $productResult = $shoppingCart->getProductByCode($_GET["code"]);
                $selectServices = $_GET["transport"] + $_GET["insurance"];
                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);

                if (! empty($cartResult)) {
                    // Update cart item quantity in database
                    $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"] + $selectServices;
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    // Add to cart table
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id, $transport, $insurance);
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
<TITLE>xXx Shopping CARt</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="css/ppstyle.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<?php

$cartItem = $shoppingCart->getMemberCartItem($member_id);
$item_quantity = 0;
$item_price = 0;
$transport = 0;
$insurance = 0;

if (! empty($cartItem)) {
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity"];
            $item_price = $item_price + ($item["price"] * $item["quantity"]);
            $item_price += ($insurance + $transport);
            $insurance = $item_price * $insurance;
            // $transport = $_GET['transport'];
        }
    }
}
?>
<div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Shopping Cart</div>

            <a id="btnEmpty" href="ppindex.php?action=empty"><img
                src="images/empty-cart.png" alt="empty-cart"
                title="Empty Cart" class="float-right" /></a>
            <div class="cart-status">
                <div>Total Quantity: <?php echo $item_quantity; ?></div>
                <div>Total Price: $ <?php echo $item_price; ?></div>
                <div>Transport: $ <?php echo $transport; ?></div>
                <div>Insurance: $ <?php echo $insurance; ?></div>
            </div>
        </div>
        <?php
        if (! empty($cartItem)) {
            ?>
<?php
            require_once ("cart-list.php");
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

</BODY>
</HTML>
