<?php
session_start();
require_once "ShoppingCart.php";
require_once ('db.php');
if($_SESSION['loggedIn']){
$member_id = $_SESSION['id'];
$member_email = $_SESSION['email_id'];
}

$shoppingCart = new ShoppingCart();

/* Calculate Cart Total Items */
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

if(!empty($_POST["proceed_payment"])) {
    $name = $_POST ['name'];
    $address = $_POST ['address'];
    $city = $_POST ['city'];
    $zip = $_POST ['zip'];
    $country = $_POST ['country'];
}
$order = 0;
if (! empty ($name) && ! empty ($address) && ! empty ($city) && ! empty ($zip) && ! empty ($country)) {
    // able to insert into database

    $order = $shoppingCart->insertOrder ( $_POST, $member_id, $item_price);
    if(!empty($order)) {
        if (! empty($cartItem)) {
            if (! empty($cartItem)) {
                foreach ($cartItem as $item) {
                $shoppingCart->insertOrderItem ( $order, $item["id"], $item["price"], $item["quantity"], $transport, $insurance, $totalCost);
                }
            }
        }
    }
}
?>
<HTML>
<HEAD>
<TITLE>xXx Shopping Cart</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="../styles/ppstyle.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
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
                <div>Total Cost: $ <?php echo $totalCost; ?></div>            </div>
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
<?php if(!empty($order)) { ?>
    <form name="frm_customer_detail" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST">
    <input type='hidden'
							name='business' value='joshmutuse@yahoo.com'> <input
							type='hidden' name='item_name' value='Cart Item'> <input
							type='hidden' name='item_number' value="<?php echo $order;?>"> <input
							type='hidden' name='amount' value='<?php echo $totalCost;?>'> <input type='hidden'
							name='currency_code' value='USD'> <input type='hidden'
							name='notify_url'
							value='http://webserve.com/shopping-cart-check-out-flow-with-payment-integration/notify.php'> <input
							type='hidden' name='return'
							value='http://webserve.com/shopping-cart-check-out-flow-with-payment-integration/response.php'> <input type="hidden"
							name="cmd" value="_xclick">  <input
							type="hidden" name="order" value="<?php echo $order;?>">
    <div>
        <input type="submit" class="btn-action"
                name="continue_payment" value="Continue Payment">
    </div>
    </form>
<?php } else { ?>
<div class="success">Problem in placing the order. Please try again!</div>
<div>
        <button class="btn-action">Back</button>
    </div>
<?php } ?>
</BODY>
</HTML>
