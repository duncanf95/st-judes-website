<?php
class Booking
{


  private $stJuButtons = '<form name = "display-bookings" method = "POST">
                            <div class = "row">
                            <div class = "col-xs-6 col-xs-6 col-sm-3">

                                <input type = "date" name = "select-month">
                                <input type = "submit" value = "Search Date for all" name= "btn-month">

                            </div>
                            <div class = "col-xs-6 col-xs-6 col-sm-3">

                                <input type = "date" name = "select-month-level-1">
                                <input type = "submit" value = "Search Date for level 1" name= "btn-level-1">

                            </div>
                            <div class = "col-xs-6 col-xs-6 col-sm-3">

                                <input type = "date" name = "select-month-penthouse">
                                <input type = "submit" value = "Search Date for penthouse" name= "btn-penthouse">

                            </div>
                              <div class = "col-xs-6 col-xs-6 col-sm-3">
                                <input type = "submit" value = "display all" name= "btn-all">
                              </div>


                            </div>
                      ';

  private $lolasButtons = '<form name = "display-bookings" method = "POST">
                          <div class = "row">
                            <div class = "col-xs-6 col-sm-3">

                                <input type = "date" name = "select-month">
                                <input type = "submit" value = "Search Date booths" name= "btn-month">

                            </div>
                              <div class = "col-xs-6 col-sm-3">
                                <input type = "submit" value = "display all booths" name= "btn-all">
                              </div>
                              <div class = "col-xs-6 col-sm-3">

                                  <input type = "date" name = "select-month-gl">
                                  <input type = "submit" value = "Search Date guestlist" name= "btn-month-gl">

                              </div>

                              <div class = "col-xs-6 col-sm-3">
                                <input type = "submit" value = "display all guestlist" name= "btn-all-gl">
                              </div>

                              </div>
                            ';

  private $optionButtons = '
                            <div class = "row">
                              <div class = "col-xs-6">
                                <input type = "submit" value = "delete" name= "btn-delete">
                              </div>
                              <div class = "col-xs-6">
                                <input type = "submit" value = "confirm" name= "btn-confirm">
                              </div>
                            </div>';

  private $venueButtons = '<form name = "display-bookings" method = "POST">
                            <div class = "row">
                              <div class = "col-xs-6 col-sm-4">
                                <input type = "submit" value = "St Judes" name= "btn-st-judes">
                              </div>
                              <div class = "col-xs-6 col-sm-4">
                                <input type = "submit" value = "Lolas" name= "btn-lolas">
                              </div>
                              <div class = "col-xs-6 col-sm-4">
                                <input type = "submit" value = "Both" name= "btn-both">
                              </div>
                            </div>';





  private $dbName = "";



  private $endform = '</form>';
  //holds html string for buttons and start of form

  public function setdbName($dbName)
  {
    $this->dbName = $dbName;
  }



  public function displayButtons()
  {
    echo $this->stJuButtons;
  }// end of displayButtons();

  public function lolasbuttons()
  {
    echo $this->lolasButtons;
  }

  public function displayOptions()
  {
    echo $this->optionButtons;
  }



  public function venueButtons()
  {
    echo $this->venueButtons;
  }



  public function getRowByID($ID)
  //gets row in the database by its ID
  {
    global $wpdb;
    //databse connection

    return $wpdb->get_row("SELECT * FROM ".$this->dbName." WHERE BOOKING_ID =".$ID, ARRAY_A);
    //returns row of the database with valid id

  }//end of getRowByID();

  public function deleteRow($ID)
  {
    global $wpdb;
    $wpdb -> query($wpdb -> prepare("DELETE FROM ".$this->dbName." WHERE booking_ID = %d", $ID));
  }//end of deleteRow();

  public function countRows()
  //counts the rows in a database
  {
    global $wpdb;
    //databse connection

    $stmt = sprintf("SELECT COUNT(*) FROM %s", $this->dbName);
    //prepare statement

    return $wpdb->get_var("$stmt");
    //execute and return statement
  }//end of countRows();

  public function enterBooking($bookID,$fname,$lname,$pnumber,$email,$psize,$time,$date,$roomid)
  {
    global $wpdb;
    //datbase connection

    if($this->dbName == "st_ju_request_bookings")
    //checks which databse the information is coming from
    {
      $dbConfirm = "st_ju_confirm_bookings";
    }
    elseif($this->dbName == "lolas_request_bookings")
    {
      $dbConfirm = "lolas_confirm_bookings";
    }

    if($stmt['Room_ID']== '')
    {
      $tableID = $this->selectTable($psize);

      $wpdb -> query($wpdb -> prepare("INSERT INTO ".$dbConfirm." (Booking_ID, first_name, Last_name, phone_number ,email, party_size, booking_time, booking_date, Table_id) VALUES (%d, %s, %s, %d, %s, %d, %s, %s, %d);",
      $bookID,
      $fname,
      $lname,
      $pnumber,
      $email,
      $psize,
      $time,
      $date,
      $tableID
      ));
    }

    $wpdb -> query($wpdb -> prepare("INSERT INTO ".$dbConfirm." (Booking_ID, first_name, Last_name, phone_number ,email, party_size, booking_time, booking_date, Room_ID) VALUES (%d, %s, %s, %d, %s, %d, %s, %s, %s);",
    $bookID,
    $fname,
    $lname,
    $pnumber,
    $email,
    $psize,
    $time,
    $date,
    $roomid
    ));
    //enter data into confirmed bookings databse

  }//end of enterBooking();

  public function selectTable($pSize)
  {
    global $wpdb;

    $count = $wpdb->get_var("SELECT COUNT(*) FROM st_ju_tables");

    for($i = 1; $i <= $count; $i++)
    {
      $stmt = $wpdb->get_row("SELECT * FROM st_ju_tables WHERE Table_ID =".$i, ARRAY_A);

      if($stmt['Table_Capcity'] >= $pSize)
      {
        return $stmt['Table_ID'];
      }
    }

  }

  public function confirmEntry($ID)
  {
    global $wpdb;

    if($this->dbName == "st_ju_request_bookings")
    //checks which databse the information is coming from
    {
      $dbConfirm = "st_ju_confirm_bookings";
    }
    elseif($this->dbName == "lolas_request_bookings")
    {
      $dbConfirm = "lolas_confirm_bookings";
    }

    if($wpdb -> query($wpdb -> prepare("SELECT * FROM ".$dbConfirm." WHERE Booking_ID = ".$ID." ;",
    $fname,
    $lname,
    $pnumber,
    $email,
    $psize,
    $time,
    $date)) == true)
    //if data is entered into database correctly
    {
      return true;
    }//end of if
  }

  public function setEntry($stmt,$ID)
  // creates a html string for one db row
  {
    return  sprintf('
              <div class = "col-xs-6 col-sm-3">

                  <p>'.$stmt['first_name'].'</p>

                  <p>'.$stmt['last_name'].'</p>

                  <p>'.$stmt['phone_number'].'</p>

                  <p>'.$stmt['email'].'</p>

                  <p>'.$stmt['party_size'].'</p>

                  <p>'.$stmt['booking_time'].'</p>

                  <p>'.$stmt['booking_date'].'</p>
                  <p>checked'.$ID.'</p>

                  <input type = "checkbox" name="checked%s">
                  <hr>

              </div>',$ID);
    //returns html string
  }

  public function requestBooking($dbName,$fname,$lname,$phoneNum,$email,$partySize,$time,$date)
  {
    global $wpdb;

    $wpdb -> query($wpdb -> prepare("INSERT INTO ".$dbName." (first_name, last_name, phone_number ,email, party_size, booking_time, booking_date)
    VALUES (%s, %s, %d, %s, %d, %s, %s);",$fname,$lname,$phoneNum,$email,$partySize,$time,$date));
  }//end of requestBooking();

  public function requestRoom($dbName,$fname,$lname,$phoneNum,$email,$partySize,$time,$date, $roomID)
  {
    global $wpdb;

    $wpdb -> query($wpdb -> prepare("INSERT INTO ".$dbName." (first_name, last_name, phone_number ,email, party_size, booking_time, booking_date, Room_ID)
    VALUES (%s, %s, %d, %s, %d, %s, %s, %s);",$fname,$lname,$phoneNum,$email,$partySize,$time,$date, $roomID));
  }


  public function displayBookings()
  //displays all bookings
  {
    try{


      //display buttons and start form

      $count = $this->countRows();
      //set count to number of rows

      echo $this->optionButtons;

      for($i = 1; $i<=$count; $i++)
      {

        $stmt = $this->getRowByID($i);
        //statement array is equal to current row

        if($stmt['first_name']!="" && $stmt['last_name']!="")
        //if there is data in the row
        {
          $forumOutput = $this->setEntry($stmt, $i);
          //set form output to html string with db info

          echo $forumOutput;
                /*do{
                  $found = 0;
                if(isset($_POST['delete-btn'.$counter.''])){
                        $num = $count;
                        $wpdb -> query($wpdb -> prepare("DELETE FROM BOOKING WHERE ID = %d", $num));
                        $found = 1;
                      }*/
          if($i == $count)
          //if there are no more rows to diaplay
          {
            echo $endform;
            //close form
          }//end of if

        }//end of if
        else
        //if not data found increment count
        {
            $count++;
        }//end of else

      }//end of for

    }//end of try
    catch(PDOexception $e)
    //if try fails display error to user
    {
      echo "Error: ".$e ->getMessage();
    }//end of catch

  }// end of displayBookings();

  public function deleteBookings()
  {
    $count = $this->countRows();
    //count is equal to amount of rows in db
    try
    {
      for($i = 1; $i<=$count; $i++)
      {
        $stmt = $this->getRowByID($i);
        //statement array is equal to current row

        $id = sprintf("checked%s",$i);
        //get checkbox id

        if($stmt['first_name']!="" && $stmt['last_name']!="")
        //if there is data in row
        {
          if(isset($_POST["$id"]))
          //if check box is ticked
          {
            $this->deleteRow($i);
            //delete current row
          }//end of if

        }//end of if
        else
        //if no data found, increment count
        {
            $count++;
        }//end of else

      }//end of for

      echo'<script>location.reload(true);</script>';
      //reload page to display updated db

    }//end of try
    catch(PDOexception $e)
    //if try fails output effor to user
    {
      echo "Error: ".$e ->getMessage();
    }//end of catch
  }//end of deleteBookings();

  public function confirmBookings()
  {
    session_start();
    $count = $this->countRows();
    //set count to number of rows in db



    try{
      for($i = 1; $i<=$count; $i++)
      {
        $stmt = $this->getRowByID($i);
        //statement array is equal to current row

        $id = sprintf("checked%s",$i);
        //get checkbox ID


        //get booking details

        if($stmt['first_name']!="" && $stmt['last_name']!="" )
        //if there is data in ther row
        {

          if(isset($_POST["$id"]))
          //if check box is ticked
          {

            $stmt = $this->getRowByID($i);

            /*$bookID = $stmt['Booking_ID'];
            $fname = $stmt['first_name'];
            $lname = $stmt['last_name'];
            $pnumber = $stmt['phone_number'];
            $email = $stmt['email'];
            $psize = $stmt['party_size'];
            $time = $stmt['booking_time'];
            $date = $stmt['booking_date'];*/

            echo 'woooooooo';
            $bookID = $stmt['Booking_ID'];
            $fname = $stmt['first_name'];
            $lname = $stmt['last_name'];
            $pnumber = $stmt['phone_number'];
            $email = $stmt['email'];
            $psize = $stmt['party_size'];
            $time = $stmt['booking_time'];
            $date = $stmt['booking_date'];
            $roomID = $stmt['Room_ID'];

            $this->enterBooking($bookID,$fname,$lname,$pnumber,$email,$psize,$time,$date,$roomID);
            //booking is entered into confirm booking databse



            if($this->confirmEntry($i)==true)
            //if booking has been entered
            {
              $this->deleteRow($i);
            }//end of if

          }//end of if


        }//end of if
        else
        //if no data found, increment count
        {
            $count++;
        }//end of else

      }//end of for
      session_unset();
      echo'<script>location.reload(true);</script>';

    }//end of try
    catch(PDOexception $e)
    //if try fails, display error to user
    {
      echo "Error: ".$e ->getMessage();
    }//end of catch*/

  }//end of confirmBookings();

  public function sortByDate($date)
  {

    $count = $this->countRows();


    try{

      $array_counter = 1;
      //set array counter to one
      $year_array = array();
      $user_choice_year_array = array();
      $month_array = array();
      $user_choice_month_array = array();
      $day_array = array();
      $user_choice_day_array = array();
      $ID_array = array();
      //set up arrays to store, day, month, year, ID

      for($i = 1; $i<=$count; $i++)
      {
        $stmt = $this->getRowByID( $i);
        //statement array is equal to current row

        if($stmt['first_name']!="" && $stmt['last_name']!="")
        // if there is data in row
        {
          $stringyear = substr($stmt['booking_date'],0,4);
          $stringUserChosenYear = substr($date,0,4);
          $stringmonth = substr($stmt['booking_date'],5,2);
          $stringUserChosenMonth = substr($date,5,2);
          $stringday = substr($stmt['booking_date'],8,2);
          $stringUserChosenDay = substr($date,8,2);
          //seperates day month and year into seperate strings

          $intyear = intval($stringyear);
          $intUserChosenYear = intval($stringUserChosenYear);
          $intmonth = intval($stringmonth);
          $intUserChosenMonth =intval($stringUserChosenMonth);
          $intday = intval($stringday);
          $intUserChosenDay = intval($stringUserChosenDay);

          //parse strings into integer

          $ID_array[$array_counter] = $stmt['Booking_ID'];

          $year_array[$array_counter] = $intyear;

          $month_array[$array_counter] = $intmonth;

          $day_array[$array_counter] = $intday;

          //set arrays to have their repective values

          /*echo 'id: ';
          echo $ID_array[$array_counter];
          echo ', ';
          echo 'year: ';
          echo $year_array[$array_counter];
          echo ', ';
          echo 'month: ';
          echo $month_array[$array_counter];
          echo ', ';
          echo 'day: ';
          echo $day_array[$array_counter];
          echo ', ';*/

          $array_counter++;
          //increment to next array element

        }//end of if
        else
        //if no data, increment count
        {
            $count++;
        }//end of else
    }//end of for

    $swap = True;
    //initialise swap to true

    $count = $this->countRows();



    while($swap == True)
    //while elements are being swapped
    {
    $swap = False;
    //set swap to false

    for($i = 1; $i<=$count; $i++)
    {

      if($year_array[$i] > $year_array[$i + 1])
      //if year in this element is > than year in the next element
      {

        $yearhold = $year_array[$i];
        $year_array[$i] = $year_array[$i+1];
        $year_array[$i + 1] = $yearhold;
        //swap year

        $monthhold = $month_array[$i];
        $month_array[$i] = $month_array[$i + 1];
        $month_array[$i + 1] = $monthhold;
        //swap month

        $dayhold = $day_array[$i];
        $day_array[$i] = $day_array[$i + 1];
        $day_array[$i + 1] = $dayhold;
        //swap day

        $IDhold = $ID_array[$i];
        $ID_array[$i] = $ID_array[$i + 1];
        $ID_array[$i + 1] = $IDhold;
        //swap ids

        $swap = True;
        //set swap to true
      }//end of if

      if(($month_array[$i] > $month_array[$i + 1]) && ($year_array[$i] >= $year_array[$i + 1]) && ($swap == false))
      {
        $yearhold = $year_array[$i];
        $year_array[$i] = $year_array[$i+1];
        $year_array[$i + 1] = $yearhold;
        //swap year

        $monthhold = $month_array[$i];
        $month_array[$i] = $month_array[$i + 1];
        $month_array[$i + 1] = $monthhold;
        //swap month

        $dayhold = $day_array[$i];
        $day_array[$i] = $day_array[$i + 1];
        $day_array[$i + 1] = $dayhold;
        //swap day

        $IDhold = $ID_array[$i];
        $ID_array[$i] = $ID_array[$i + 1];
        $ID_array[$i + 1] = $IDhold;
        //swap ids

        $swap = True;
        //set swap to true
      }//end of if

      if(($day_array[$i] > $day_array[$i + 1]) && ($month_array[$i] >= $month_array[$i + 1])
      && ($year_array[$i] >= $year_array[$i + 1]))
      {
        $yearhold = $year_array[$i];
        $year_array[$i] = $year_array[$i+1];
        $year_array[$i + 1] = $yearhold;
        //swap year

        $monthhold = $month_array[$i];
        $month_array[$i] = $month_array[$i + 1];
        $month_array[$i + 1] = $monthhold;
        //swap month

        $dayhold = $day_array[$i];
        $day_array[$i] = $day_array[$i + 1];
        $day_array[$i + 1] = $dayhold;
        //swap day

        $IDhold = $ID_array[$i];
        $ID_array[$i] = $ID_array[$i + 1];
        $ID_array[$i + 1] = $IDhold;
        //swap ids

        $swap = True;
        //set swap to true
      }//end of if

      }//end of for
      }//end of while
      $count = $this->countRows();


      for($i = 1; $i<=($count+1); $i++)
      {
        $stmt = $this->getRowByID($ID_array[$i]);

        $id = sprintf("checked%s",$i);
        $fname = $stmt['first_name'];
        $lname = $stmt['last_name'];
        $pnumber = $stmt['phone_number'];
        $email = $stmt['email'];
        $psize = $stmt['party_size'];
        $time = $stmt['booking_time'];
        $date = $stmt['booking_date'];


          if((($year_array[$i] >=  $intUserChosenYear)
          && ($month_array[$i] >= $intUserChosenMonth)
          && ($day_array[$i] >= $intUserChosenDay))
          ||
          (($day_array[$i] >= $intUserChosenDay) && ($intUserChosenMonth <=  $month_array[$i]) && ($year_array[$i] >=  $intUserChosenYear))
          ||
          ($intUserChosenYear <  $year_array[$i]))
          {
            $forumOutput = $this->setEntry($stmt, $stmt['Booking_ID']);
            echo $forumOutput;
          }



        if($i == $count)
        {
          echo $endform;;
        }//end of if
      }



    }//end of try
    catch(PDOexception $e){
      echo "Error: ".$e ->getMessage();
    }//end of catch
  }//end of sortByDate();

  public function sortByDateAndRoom($date, $room)
  {

    $count = $this->countRows();


    try{

      $array_counter = 1;
      //set array counter to one
      $year_array = array();
      $user_choice_year_array = array();
      $month_array = array();
      $user_choice_month_array = array();
      $day_array = array();
      $user_choice_day_array = array();
      $ID_array = array();
      //set up arrays to store, day, month, year, ID

      for($i = 1; $i<=$count; $i++)
      {
        $stmt = $this->getRowByID( $i);
        //statement array is equal to current row

        if($stmt['first_name']!="" && $stmt['last_name']!="")
        // if there is data in row
        {
          $stringyear = substr($stmt['booking_date'],0,4);
          $stringUserChosenYear = substr($date,0,4);
          $stringmonth = substr($stmt['booking_date'],5,2);
          $stringUserChosenMonth = substr($date,5,2);
          $stringday = substr($stmt['booking_date'],8,2);
          $stringUserChosenDay = substr($date,8,2);
          //seperates day month and year into seperate strings

          $intyear = intval($stringyear);
          $intUserChosenYear = intval($stringUserChosenYear);
          $intmonth = intval($stringmonth);
          $intUserChosenMonth =intval($stringUserChosenMonth);
          $intday = intval($stringday);
          $intUserChosenDay = intval($stringUserChosenDay);

          //parse strings into integer

          $ID_array[$array_counter] = $stmt['Booking_ID'];

          $year_array[$array_counter] = $intyear;

          $month_array[$array_counter] = $intmonth;

          $day_array[$array_counter] = $intday;

          //set arrays to have their repective values

          /*echo 'id: ';
          echo $ID_array[$array_counter];
          echo ', ';
          echo 'year: ';
          echo $year_array[$array_counter];
          echo ', ';
          echo 'month: ';
          echo $month_array[$array_counter];
          echo ', ';
          echo 'day: ';
          echo $day_array[$array_counter];
          echo ', ';*/

          $array_counter++;
          //increment to next array element

        }//end of if
        else
        //if no data, increment count
        {
            $count++;
        }//end of else
    }//end of for

    $swap = True;
    //initialise swap to true

    $count = $this->countRows();



    while($swap == True)
    //while elements are being swapped
    {
    $swap = False;
    //set swap to false

    for($i = 1; $i<=$count; $i++)
    {

      if($year_array[$i] > $year_array[$i + 1])
      //if year in this element is > than year in the next element
      {

        $yearhold = $year_array[$i];
        $year_array[$i] = $year_array[$i+1];
        $year_array[$i + 1] = $yearhold;
        //swap year

        $monthhold = $month_array[$i];
        $month_array[$i] = $month_array[$i + 1];
        $month_array[$i + 1] = $monthhold;
        //swap month

        $dayhold = $day_array[$i];
        $day_array[$i] = $day_array[$i + 1];
        $day_array[$i + 1] = $dayhold;
        //swap day

        $IDhold = $ID_array[$i];
        $ID_array[$i] = $ID_array[$i + 1];
        $ID_array[$i + 1] = $IDhold;
        //swap ids

        $swap = True;
        //set swap to true
      }//end of if

      if(($month_array[$i] > $month_array[$i + 1]) && ($year_array[$i] >= $year_array[$i + 1]) && ($swap == false))
      {
        $yearhold = $year_array[$i];
        $year_array[$i] = $year_array[$i+1];
        $year_array[$i + 1] = $yearhold;
        //swap year

        $monthhold = $month_array[$i];
        $month_array[$i] = $month_array[$i + 1];
        $month_array[$i + 1] = $monthhold;
        //swap month

        $dayhold = $day_array[$i];
        $day_array[$i] = $day_array[$i + 1];
        $day_array[$i + 1] = $dayhold;
        //swap day

        $IDhold = $ID_array[$i];
        $ID_array[$i] = $ID_array[$i + 1];
        $ID_array[$i + 1] = $IDhold;
        //swap ids

        $swap = True;
        //set swap to true
      }//end of if

      if(($day_array[$i] > $day_array[$i + 1]) && ($month_array[$i] >= $month_array[$i + 1])
      && ($year_array[$i] >= $year_array[$i + 1]))
      {
        $yearhold = $year_array[$i];
        $year_array[$i] = $year_array[$i+1];
        $year_array[$i + 1] = $yearhold;
        //swap year

        $monthhold = $month_array[$i];
        $month_array[$i] = $month_array[$i + 1];
        $month_array[$i + 1] = $monthhold;
        //swap month

        $dayhold = $day_array[$i];
        $day_array[$i] = $day_array[$i + 1];
        $day_array[$i + 1] = $dayhold;
        //swap day

        $IDhold = $ID_array[$i];
        $ID_array[$i] = $ID_array[$i + 1];
        $ID_array[$i + 1] = $IDhold;
        //swap ids

        $swap = True;
        //set swap to true
      }//end of if

      }//end of for
      }//end of while
      $count = $this->countRows();


      for($i = 1; $i<=($count+1); $i++)
      {
        $stmt = $this->getRowByID($ID_array[$i]);

        $id = sprintf("checked%s",$i);
        $fname = $stmt['first_name'];
        $lname = $stmt['last_name'];
        $pnumber = $stmt['phone_number'];
        $email = $stmt['email'];
        $psize = $stmt['party_size'];
        $time = $stmt['booking_time'];
        $date = $stmt['booking_date'];


          if(((($year_array[$i] >=  $intUserChosenYear)
          && ($month_array[$i] >= $intUserChosenMonth)
          && ($day_array[$i] >= $intUserChosenDay))
          ||
          (($day_array[$i] >= $intUserChosenDay) && ($intUserChosenMonth <=  $month_array[$i]) && ($year_array[$i] >=  $intUserChosenYear))
          ||
          ($intUserChosenYear <  $year_array[$i])) && ($stmt['Room_ID'] == $room))
          {
            $forumOutput = $this->setEntry($stmt,$stmt['Booking_ID']);
            echo $forumOutput;
          }



        if($i == $count)
        {
          echo $this->endform;;
        }//end of if
      }



    }//end of try
    catch(PDOexception $e){
      echo "Error: ".$e ->getMessage();
    }//end of catch
  }//end of sortByDate();

}// end of class
