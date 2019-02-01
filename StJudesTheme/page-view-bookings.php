<?php get_header();
include('booking.php')
?>

<?php

$booking = new Booking();


if(isset($_POST['btn-delete']))
{
  $booking->deleteBookings($dbName);
}

if(isset($_POST['btn-confirm']))
{
 $booking->confirmBookings($dbName);
}

?>
<div class = "col-xs-6 col-sm-3">
  <a href = "http://localhost/stjudes/view-lolas-requests/"><input type = "submit" value = "Lola's Booking Request"></input></a>
</div>
<div class = "col-xs-6 col-sm-3">
  <a href = "http://localhost/stjudes/view-St-judes-requests/"><input type = "submit" value = "St Jude's Booking Request"></input></a>
</div>
<div class = "col-xs-6 col-sm-3">
  <a href = "http://localhost/stjudes/view-lolas-confirmed/"><input type = "submit" value = "Lola's Booking Confirmed"></input></a>
</div>
<div class = "col-xs-6 col-sm-3">
  <a href = "http://localhost/stjudes/view-st-judes-confirmed/"><input type = "submit" value = "St Jude's Booking Confirmed"></input></a>
</div>
<?php

if(isset($_POST['btn-st-judes']))
{
  global $wpdb;
  $wpdb -> query($wpdb -> prepare("INSERT INTO dbName (dbName) VALUES (%s);",'st_ju_request_bookings'));
  //$wpdb -> query($wpdb -> prepare("DELETE FROM dbName WHERE dbName = %s", 'st_ju_request_bookings'));
  $booking->setdbName();
  echo $booking->displayButtons();
  if(isset($_POST['btn-date']))
  {

    $booking->selectDate();


    if(isset($_POST['btn-month']))
    {


      $Date = $_POST['select-month'];



      $booking->sortByDate($Date);
      $wpdb -> query($wpdb -> prepare("DELETE FROM dbName WHERE dbName = %s", 'st_ju_request_bookings'));
    }
  }
}

if(isset($_POST['btn-date']))
{
  $booking->selectDate();
  //

}
if(isset($_POST['btn-lolas']))
{
  $dbName = "lolas_request_bookings";
  echo $booking->displayButtons();

}
if(isset($_POST['btn-month']))
{
  $Date = $_POST['select-month'];
  $booking->sortByDate($dbName, $Date);

}
if(isset($_POST['btn-all']))
{
 $booking->displayBookings($dbName);
}


 ?>

<?php get_footer();?>
