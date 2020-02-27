<?php
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<body>
  <table>
    <tr><td>Hellow</td><td><a href="signin.php"> here</a></td></tr>
  </table>
</body>
</html>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="herschelgomez@xyzzyu.com">

<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">

<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name" value="Hot Sauce-12 oz. Bottle">
<input type="hidden" name="amount" value="5.95">
<input type="hidden" name="currency_code" value="USD">

<!-- Specify the discount percentages that apply to the item. -->
<input type="hidden" name="discount_rate" value="0">
<input type="hidden" name="discount_rate2" value="100">
<input type="hidden" name="discount_num" value="1">

<!-- Prompt buyers to enter the quantities they want. -->
<input type="hidden" name="undefined_quantity" value="1">

<!-- Display the payment button. -->
<input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
  alt="Buy Now">
<img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
