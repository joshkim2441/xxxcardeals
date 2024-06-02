<?php
require_once "ShoppingCart.php";
require_once "DBController.php";
?>
<html>
<div id="product-grid">
    <div class="txt-heading">
        <div class="txt-heading-label">xXx Automobile Products</div>
    </div>
    <?php
    $query = "SELECT * FROM tbl_product";
    $product_array = $shoppingCart->getAllProduct($query);
    if (! empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ?>
        <div class="product-item">
        <form method="post"
            action="ppindex.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
           <div class="product-image">
             <img src="<?php echo $product_array[$key]["image"]; ?>">
                <div class="product-title">
                    <?php echo $product_array[$key]["name"]; ?>
             </div>
            </div>
            <div class="product-footer">
                <div class="float-right">
                    <input type="text" name="quantity" value="1"
                        size="2" class="input-cart-quantity" /><input type="image"
                        src="../images/add-to-cart.png" class="btnAddAction" />
                </div>
                <div class="product-price float-left"><?php echo "$".$product_array[$key]["price"]; ?></div>

            </div>
        </form>
    </div>
    <?php
        }
    }
    ?>
<?php
$url = 'myservices.php';
 echo "<a href='$url'>back</a>";
 ?>
 <a href="javascript.go(-1)">myservices.php </a>
 <form action="myservices.php" method="post">
<input type="button" value="Go Back!" onclick="myservices.php" />
<button onclick="history.go(-1);">Back </button>
<button type="button" onclick="history.back();">Back</button>
<a href="./"><button class="btn-continue">Continue Shopping</button></a>
</form>

<div>
<form method='post' action='ppindex.php' onsubmit="return false">
    <h3><b><u>Select Type or combination of Transport Service</u></b></h3>
    <input type="checkbox" class="checkbox" value="4000" id="marine"/>Marine Cargo<br>
    <input type="checkbox" class="checkbox" value="2000" id="air"/>Air Freight<br>
    <input type="checkbox" class="checkbox" value="4000" id="land"/>Land Cargo<br>
    <br />
    <label for="writingServices"><u><b>Select an Insurance Cover</u></b></label>
    <br/>
    <select id="dropdown">
        <option value="0" id="null">Select option</option>
        <option value="0.015" class="val">Marine Insurance</option>
        <option value="0.020" class="val">Land Cargo Insurance</option>
        <option value="0.030" class="val">All Risk</option>
        <option value="0.025" class="val">Named Perils</option>
    </select>

    <br />
    <input type="hidden" id="hiddenServices" name="transport">
    <input type="hidden" id="hiddenInsurance" name="insurance">
    <input type="submit" onclick="updateCart();" value="Update Cart" class="btn btn-primary">
</form>
</div>
<div>
    <p id="marine"></p>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</div>
</html>
