<?php
require_once "ShoppingCart.php";
require_once "db.php";
?>
<div id="product-grid">
    <div class="txt-heading">
        <div class="txt-heading-label">xXx Car Dealers Products</div>
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
                    <input type="text" id="quantity" value="1"
                        size="2" class="input-cart-quantity" /><input type="image"
                        src="images/add-to-cart.png" class="btnAddAction" />
                </div>
                <div class="product-price float-left"><?php echo "$".$product_array[$key]["price"]; ?></div>

            </div>
        </form>
    </div>
    <?php
        }
    }
    ?>
</div>

<div>
<form method='post' action='ppindex.php?action=add' onsubmit="return false">
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
    <input type="hidden" id="hiddenServices" id="transport">
    <input type="hidden" id="hiddenInsurance" id="insurance">
    <input type="submit" onclick="addToCart();" value="Add to Cart" class="btn btn-primary">
</form>
</div>

<br/>
<br/>
<form action="myservices.php" method="post">
<input type="button" value="Go Back!" onclick="myservices.php" />
<button onclick="history.go(-1);">Back </button>
<button type="button" onclick="history.back();">Back</button>
<a href="./"><button class="btn-continue">Continue Shopping</button></a>
</form>
<script>
    function addToCart() {
  // Get selected services and insurance
  let transportCost = [];
  if (document.getElementById('marine').checked) {
    transportCost.push(document.getElementById('marine').value);
  }
  if (document.getElementById('air').checked) {
    transportCost.push(document.getElementById('air').value);
  }
  if (document.getElementById('land').checked) {
    transportCost.push(document.getElementById('land').value);
  }
  let insuranceCost = document.getElementById('dropdown').value;

  // Prepare data to send
  const data = {
    transportCost: transport,
    insuranceCost: insurance
  };

  // Send AJAX request using Fetch API
  fetch('ppindex.php?action=add', {
    method: 'POST',
    body: JSON.stringify(data),
    headers: { 'Content-Type': 'application/json' }
  })
    .then(response => response.json()) // Parse JSON response (optional)
    .then(data => {
      // Handle successful response (optional)
      // You can potentially update the cart display on the current page
      console.log('Cart updated successfully:', data);
    })
    .catch(error => {
      console.error('Error adding to cart:', error);
    });
  document.getElementById('hiddenServices').value = transport.join(',');
  document.getElementById('hiddenInsurance').value = insurance;

  // Submit the form
  document.forms[0].submit(); // Assuming the form is the first element
}
</script>
<?php
// ... (script logic) ...

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
