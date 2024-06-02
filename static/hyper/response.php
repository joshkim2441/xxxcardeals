<?php
session_start();
require_once "ShoppingCart.php";
require_once ("db.php");
if($_SESSION['loggedIn']){
$member_id = $_SESSION['id'];
}

$shoppingCart = new ShoppingCart();

?>
<HTML>
<HEAD>
<TITLE>xXx Autos Shopping Cart</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="ppstyle.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
$item_quantity = 0;
$item_price = 0;
if (! empty($cartItem)) {
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity"];
            $item_price = $item_price + ($item["price"] * $item["quantity"]);
            //$transport = $_POST['transportCost'];
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
                <div>Total Price: <?php echo $item_price; ?></div>
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
<?php
        } // End if !empty $cartItem
        $shoppingCart->emptyCart($member_id);
        ?>

</div>

    <div class="success">
        Thank you for shopping with us. Your order has been placed. You order Id is <?php echo $_GET["item_number"]; ?>
    </div>
    <div>
        <a href="./"><button class="btn-continue">Continue Shopping</button></a>
    </div>
</BODY>
</HTML>
