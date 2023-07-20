<?php 

    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) { 
        header('Location: ' . URL . 'login.php'); 
    }

    $event_id = $_GET["eventId"];

     $event_t = mysqli_real_escape_string($connection, $_GET['event_type']);
     $comm = mysqli_real_escape_string($connection, $_GET['commander']);
     $location = mysqli_real_escape_string($connection, $_GET['location']);  
     $building_t = mysqli_real_escape_string($connection, $_GET['building_type']);
     $hazardz = mysqli_real_escape_string($connection, $_GET['hazard']);
     $urgency = mysqli_real_escape_string($connection, $_GET['urgency']);
   

     $state  = $_GET['state'];

     if ($state == "insert") {
         $query = 'INSERT INTO tbl_202_events (event_type, building_type, location, start_time, crew, urgency, hazardous) 
                 VALUES ("' . $event_t . '", "' . $building_t . '", "' . $location . '", NOW(), "' . $comm . '", "' . $urgency . '", "' . $hazardz . '")';
    } else {
       
		$query = 'UPDATE tbl_202_events SET event_type="' . $event_t . '", building_type="' . $building_t . '", location="' . $location . '", crew="' . $comm . '", urgency=' . $urgency . ', hazardous=' . $hazardz . ' where event_id=' . $event_id;
    }

     $result = mysqli_query($connection, $query);
     if(!$result) {
         die ("DB query failed");
     }


     header('Location: ' . URL . 'dashboard.php');


     mysqli_free_result($result);
     
     
     
     

     mysqli_close($connection);
 ?>

