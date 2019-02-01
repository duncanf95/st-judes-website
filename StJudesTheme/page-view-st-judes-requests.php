<?php
session_start();
get_header();

include('booking.php');



$booking = new Booking();
$dbName = "st_ju_request_bookings";

$booking->setdbName($dbName);
echo $booking->displayButtons();



if(isset($_POST['btn-date']))
{

  $booking->selectDate();

}
if(isset($_POST['btn-level-1']))
{

  $Date = $_POST['select-month-level-1'];

  $booking->displayOptions();
  echo $date;
  $booking->sortByDateAndRoom($Date,'lv1');

}

if(isset($_POST['btn-penthouse']))
{

  $Date = $_POST['select-month-penthouse'];

  $booking->displayOptions();
  echo $date;
  $booking->sortByDateAndRoom($Date,'peh');

}



if(isset($_POST['btn-month']))
{

  $Date = $_POST['select-month'];

  $booking->displayOptions();
  echo $date;
  $booking->sortByDate($Date);

}
if(isset($_POST['btn-confirm']))
{
  $booking->confirmBookings();
}

if(isset($_POST['btn-all']))
{
 $booking->displayBookings();
}

if(isset($_POST['btn-delete']))
{
 $booking->deleteBookings();
}

 get_footer();?>
