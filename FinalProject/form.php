<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The new event</title>
</head>
<body>
    <header>
        <a href="#" id="logo1"></a>
        <a href="#" id="logo2"></a>
        <a href="#" id="notifications"></a>
    </header>
    <div id="wrapper">
        <?php 
            $et = $_GET["event_type"];
            $comm = $_GET["commander"];
            $ct = $_GET["city"];
            $st = $_GET["street"];
            $house_num = $_GET["h_num"];
            $bt = $_GET["building_type"];
            $hz = $_GET["hazard"];

            echo 
            "<h1>The new event's details</h1>
            Event type: " . $et . "<br>
            Team commander: " . $comm . "<br>
            City: " . $ct . "<br>
            Street: " . $st . "<br>
            House number: " . $house_num . "<br>
            Building type: " . $bt . "<br>";

            if ($hz == "yes")
                echo "THERE ARE HAZARDOUS MATERIAL IN THE EVENT";
            else 
                echo "There are no hazardous material in the event"; 



        ?>
    </div>
    
</body>
</html>