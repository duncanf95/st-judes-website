<?php session_start();
get_header();


include('booking.php');

$booking = new Booking();
$dbName = "lolas_confirm_bookings";

$booking->setdbName($dbName);
echo $booking->lolasbuttons();


if(isset($_POST['btn-month']))
{


  $Date = $_POST['select-month'];
  $booking->displayOptions();


  $booking->sortByDate($Date);
}

if(isset($_POST['btn-all-gl']))
{
  $booking->setdbName('lolas_guest_list');
  $booking->displayBookings();
}
if(isset($_POST['btn-month-gl']))
{


  $Date = $_POST['select-month'];
  $booking->setdbName('lolas_guest_list');
  $booking->displayOptions();


  $booking->sortByDate($Date);
}

if(isset($_POST['btn-all']))
{
 $booking->displayBookings();
}
if(isset($_POST['btn-confirm']))
{
  $booking->confirmBookings();
}
if(isset($_POST['btn-delete']))
{
 $booking->deleteBookings();
}
 get_footer();?>
