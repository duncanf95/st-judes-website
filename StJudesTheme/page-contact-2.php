<?php get_header('lolas');?>

<form name="bookforum" method="POST">
  <div class="col-xs-6 col-sm-3">
  </div>
  <div class="col-xs-6 col-sm-3">
    First Name:
    <input type = "text" name = "fname">
    <br>
    Last Name:
    <input type  = "text" name = "lname">
    Contact Number:
    <input type = "number" name = "phone-num">
    Email:
    <input type = "email" name = "email">
  </div>
  <div class="col-xs-6 col-sm-3">
    Message:
    <textarea name = "Message" rows = "202" cols = "60"></textarea>
      <input type = "submit" name = "btn-submit" value="submit">

  </div>
</form>


<?php get_footer(); ?>
