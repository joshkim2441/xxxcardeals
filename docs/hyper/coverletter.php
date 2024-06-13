<?php
  if($_SESSION['loggedIn']);
  header("Cache-Control: no cache");
?>
<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8"/>
    <title>COVER LETTER</title>
    <meta name="web development" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href= "../styles/index.css">
   <script type ="application/JavaScript" src="../scripts/index.js"></script>
   <span id="wlcm">Welcome <?php echo$_SESSION['username']; ?></span><br />
 <span id="wlcm">Member no. <?php echo$_SESSION['id']; ?></span><br />
 <span id="wlcm">Your email is <?php echo$_SESSION['email_id']; ?></span>
<?php
function greeting_msg()
{
  $hour = date('G'); // Get the current hour (24-hour format)

  if ($hour >= 5 && $hour < 12) {
    return "Good Morning 👋";
  } elseif ($hour >= 12 && $hour < 18) {
    return "Good Afternoon 👋";
  } else {
    return "Good Evening 👋";
  }
}

echo greeting_msg();
?>
 </head>
  <body>
    <header id="header">
     <h1>"XXX FRONT DESK"</h1>
    </header>
    <p>Welcome to xXx High-End Car Dealers. Below is our address and contacts.<p>
    <address>
      <p>XXX AUTO MOTORS</p>
      <p>Tom Mboya Ave.</p>
      <p>Mombasa, Kenya</p>
      <p>mob. 0715055937</p>
      <p>email: xxxcardealers@gmail.com</p>
   <script type="application/JavaScript" src="../scripts/index.js"></script>
<p>Today is: <span id="time" /></p>
<script type="application/javascript">
(document.getElementById('time'));
</script>
 </address>
   <section>
  <p>We are high-end car dealers with years of experience in slecting the best quality automobiles, and delevering the products safely and conveniently
    to you wherever on the globe you might be ordering from.</p>
   </section>
   <section>
  <p>Thousands of satisfied clients are driving our cars around the world. We offer after-sales services at affordable prices and offer advice for vehicle
    that are unreachable.</p>
   </section>
   <section>
  <p>In a nut-shell, you are getting value for your money. After
making your order, send an email from the services page with specifications and attachments if any, and you will get a message within 24hrs.
Make your order on the Services page and send an email with the specific instructions
for the specific car make and model you need and you will get a reply in 24 hours.</p>
   </section>
   <section>
  <p> Check out our elegant products, and select the best deal you will ever get.
    Tap the Show Room link to check out the products and make your order.<br>
 Thank you for your time and consideration.
 I am looking forward to hearing from
 you soon.<br>
 <p id="fwell">Yours Sincerely,<br>
 Joshua Mutuse.</p>
  </section>
   <footer>
    <nav>
     <form action ="index2.php">
    <button id="calc">Log Out</button>
    </form>
     <ul id="contacts">
     <li><a href= "javascript:null" onClick="javascript:emails()">Email</a></li>
     <li><a href="/static/index.html">Home Page</a></li>
     <li><a href="xxxcardeals.php">xXx Autosales</a></li>
    </ul>
   </nav>
  </footer>
 </body>
</html>
