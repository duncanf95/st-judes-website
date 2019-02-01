<?php get_header();
include('booking.php')
 ?>

<div class = "row">



    <?php 	$args_cat = array(
				'include' => '9'
			);

			$categories = get_categories($args_cat);
			foreach($categories as $category):

				$args = array(
					'type' => 'post',
					'posts_per_page' => 1,
					'category__in' => $category->term_id,
					'category__not_in' => array( 10 ),
				);

				$lastBlog = new WP_Query( $args );

				if( $lastBlog->have_posts() ):

					while( $lastBlog->have_posts() ): $lastBlog->the_post(); ?>



							<?php get_template_part('content','featured'); ?>



					<?php endwhile;

				endif;

				wp_reset_postdata();

			endforeach; ?>
  </div>
</div>
<?php if(isset($_POST['btn-book']))
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
              $dbName = "st_ju_request_bookings";

              $booking->requestRoom($dbName,$fname,$lname,$phoneNum,$email,$partySize,$time,$date, 'peh');
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
    <b><h2 class = "text-center">Book here</h2></b>
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
