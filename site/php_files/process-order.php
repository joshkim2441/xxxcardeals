<?php
session_start();
require_once "ShoppingCart.php";
// require "ppindex.php";
require_once ('db.php');
if($_SESSION['loggedIn']){
$member_id = $_SESSION['id'];
} // you can your integerate authentication module here to get logged in member
$insurance = 0;
$transport = 0;
if (isset($_GET['action']) && $_GET['action'] == 'add') {
  // Access selected services and insurance
  $transport = array();
  if (isset($_GET['marine'])) {
    $transport[] = $_GET['marine']; // Marine Cargo
  }
  if (isset($_POST['air'])) {
    $transport[] = $_GET['air']; // Air Freight
  }
  if (isset($_POST['land'])) {
    $transport[] = $_GET['land']; // Land Cargo
  }

  $insurance = isset($_GET['dropdown']) ? $_GET['dropdown'] : 0; // Default to 0 if not selected
}
  // Add selected items to the shopping cart (logic depends on your ShoppingCart class)
//$shoppingCart->addItem($selectedServices, $selectedInsurance);

if (isset($_GET['transport']) && isset($_GET['insurance'])) {
    $transport = explode(',', $_GET['transport']); // Convert comma-separated string to array
    $insurance = $_GET['insurance'];
}
$shoppingCart = new ShoppingCart();
/* Calculate Cart Total Items */
$cartItem = $shoppingCart->getMemberCartItem($member_id);
$item_quantity = 0;
$item_price = 0;
$insurance = 0;
$transport = 0;

if (! empty($cartItem)) {
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity"];
            $item_price = $item_price + ($item["price"] * $item["quantity"]);
            $item_price += ($insurance + $transport);
            $transport = $transport ['transport'];
            $insurance = $insurance ['insurance'];
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
                    $shoppingCart->insertOrderItem ( $order, $item["id"], $item["price"], $item["quantity"], $transport, $insurance);
                }
            }
        }
    }
}
?>
<HTML>
<HEAD>
<TITLE>xXx Shopping CARt</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="ppstyle.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Shopping CARt</div>

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
							type='hidden' name='amount' value='<?php echo $item_price;?>'> <input type='hidden'
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
<script>
    funtion sum() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        var transport = 0;
        for (var i = 0; i < checkboxes.length; i++) {
            transport += parseInt(checkboxes[i].value);
        }
        $item_price += transport;
    }
</script>
<script>
var insurance = parseFloat(localStorage.getItem('insurance'));
var transport = parseFloat(localStorage.getItem('transport'));
</script>
<script type="text/javascript" src="js/myservices.js"></script>
</BODY>
</HTML>
