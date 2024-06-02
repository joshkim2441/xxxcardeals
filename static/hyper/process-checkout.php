<?php
session_start();
require_once "ShoppingCart.php";
require_once ('db.php');
if($_SESSION['loggedIn']){
$member_id = $_SESSION['id'];
} // you can your integerate authentication module here to get logged in member

$shoppingCart = new ShoppingCart();
?>
<HTML>
<HEAD>
<TITLE>xXx Cars Shopping Cart</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="../styles/ppstyle.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
$item_quantity = 0;
$item_price = 0;
$transport = 0;
$insuranceCost = 0;
$totalCost = 0;

if (! empty($cartItem)) {
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity"];
            $item_price = $item_price + $item["price"] * $item["quantity"];
            $transport;
            $insurance = $item_price * $insuranceCost;
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
<?php
        } // End if !empty $cartItem
        ?>

</div>
    <form name="frm_customer_detail" action="process-order.php" method="POST">
    <div class="frm-heading">
        <div class="txt-heading-label">Customer Details</div>
    </div>
    <div class="frm-customer-detail">
        <div class="form-row">
            <div class="input-field">

             <input type="text" name="name" Placeholder="Full Names" required>
            </div>

            <div class="input-field">
                <input type="text" name="address" PlaceHolder="Address" required>
            </div>
        </div>

        <div class="form-row">
            <div class="input-field">
                <input type="text" name="city" PlaceHolder="City" required>
            </div>

            <div class="input-field">
                <input type="text" name="state" PlaceHolder="State" required>
            </div>
        </div>

        <div class="form-row">
            <div class="input-field">
                <input type="text" name="zip" PlaceHolder="Zip Code" required>
            </div>

            <div class="input-field">
                <input type="text" name="country" PlaceHolder="Country" required>
            </div>
        </div>
    </div>
    <div>
        <input type="submit" class="btn-action"
                name="proceed_payment" value="Proceed to Payment">
    </div>
    </form>
</BODY>
</HTML>
