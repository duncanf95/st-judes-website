<?php get_header('lolas');
      include('booking.php')
?>



<?php

if(isset($_POST['btn-book']))
  {
      $booking = new Booking();


      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $phoneNum = $_POST['phone-num'];
      $email = $_POST['email'];
      $partySize = $_POST['party-size'];
      $time = $_POST['booking-time'];
      $date = $_POST['booking-date'];



  try{

    /*
      if($wpdb->insert('booking',
        array(
              'first_name' => $fname,
              'last_name' => $lname,
              'phone_number' => $phoneNum,
              'email' => $email,
              'party_size' => $partySize,
              'booking_time' => $time,
              'booking_date' => $date
        )//end of array
      )==false){wp_die('unsucessful');}//end of if
      else{
        echo 'successful';
      }

  }
          //confirm passwords are the same
*/
              $dbName = 'lolas_guest_list';
              $booking->requestBooking($dbName,$fname,$lname,$phoneNum,$email,$partySize,$time,$date);
              /*$wpdb -> bindparam(':firstname', $fname);
              $wpdb -> bindparam(':lastname', $lname);
              $wpdb -> bindparam(':ph_num', $phonenum);
              $wpdb -> bindparam(':email', $email);
              $wpdb -> bindparam(':partysize', $partySize);
              $wpdb -> bindparam(':booktime', $time);
              $wpdb -> bindparam(':bookdate', $date);
            */


      }
          // insert deatils into database

  catch(PDOException $e)
  {
      echo 'didnt work fanny';
      echo $e->getMessage();
  }
}//end of if
else
{
    echo $_POST["fname"];
}

  ?>

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
      Party Size:
      <input type = "number" name = "party-size">
      Time:
      <input type = "time" name="booking-time">
      Date:
      <input type = "date" name = "booking-date">
      <input type = "submit" name = "btn-book" value="submit">
    </div>
  </form>


<?php get_footer(); ?>
