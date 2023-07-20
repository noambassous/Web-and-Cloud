<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'index.php'); 
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Rescue Helmet</title>


    <link rel="stylesheet" href="css/style2.css">
    <script src="js/script.js"></script>

</head>

<body>
    <header>
        <a href="#" id="logo2"></a>
        <a href="#" id="logo1"></a>
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
                echo '<img class="profileImg" src="' . $_SESSION["image"] . '" alt="' . $_SESSION["first_name"] . ' ' . $_SESSION["last_name"] . '" title="' . $_SESSION["first_name"] . ' ' . $_SESSION["last_name"] . '">';
                ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="logout.php"><b>Log out</b></a></li>
        </ul>
    </header>

    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <?php
                        if ($_SESSION["user_type"] == 'admin') {
                            echo '<a class="nav-link" href="activeEvents.php">Active events</a>';
                            echo '<a class="nav-link" href="endedEvents.php">Ended events</a>';
                        }
                    ?>
                    <a class="nav-link" href="onCall.php">On-Call crews</a>
                    <a class="nav-link" href="newEvent.php">New event</a>
                    <?php
                        if ($_SESSION["user_type"] == 'user') {
                            echo '<a class="nav-link" href="#">Call OR</a>';
                        }
                        ?>
                </div>
            </div>
        </div>
    </nav>

    <div id="wrapper">
        <div class="contain">
            <?php
                if ($_SESSION["user_type"] == 'admin') {
                    $query = 'SELECT count(*) FROM tbl_202_events WHERE end_time is NULL';
                    $result = mysqli_query($connection, $query);

                    if(!$result) {
                        die("DB query failed");
                    }
                    $row = mysqli_fetch_assoc($result);
                }

                else if ($_SESSION["user_type"] == 'user') {
                    echo '<a class="subTitle col-sm-8" href="#"><h2>Incoming events</h2></a>';
                }
            ?>
            <div class="options col-sm-3">
                <?php
                    if ($_SESSION["user_type"] == 'admin') {
                        echo '<a href="#" id="addNewFF"></a>';
                    }
                ?>
                <a href="#" id="notifications"></a>
            </div>
        </div>

        <?php
            if ($_SESSION["user_type"] == 'admin') {
                echo '<div class="events_bg">';
                echo    '<a href="activeEvents.php"><h2 class="subTitle">Active events (' . $row["count(*)"] . ')</h2></a>';
                
                mysqli_free_result($result);
                
                echo    '<div id="events">';
                echo        '<a href="newEvent.php">';
                echo        '<div class="card">';
                echo            '<div class="card-body">';
                echo                '<p class="card-text">New event</p>';
                echo                '<img src="images/add.png" class="card-img-top" alt="Create new event" title="Create new event">';
                echo            '</div>';
                echo        '</div>';
                echo        '</a>';
                

                $query = 'SELECT * FROM tbl_202_events where end_time is NULL';
                $result = mysqli_query($connection, $query);
                if(!$result) {
                    die("DB query failed");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo    '<a href="event.php?event_id=' . $row["event_id"] . '">';
                    echo    '<div class="card">';
                    echo         '<div class="card-body">';
                    echo            '<h4><b>' . $row["event_type"] . '</b></h4>';
                    if ($row["hazardous"] == 1) {
                        echo        '<div class="hazard"><b>Hazardous material!</b></div>';
                    } else {
                        echo        '<br>';
                    }
                    echo            '<p class="card-text"><b>Location: </b>' . $row["location"] . '<br>';
                    echo                                        '<b>Crew: </b>' . $row["crew"] . '<br>';
                    echo                                        '<b>Urgency levels: </b>' . $row["urgency"] . '<br>';
                    echo                                        '<b>Start: </b>' . $row["start_time"] . '<br></p>';
                    
                    
                    echo            '<img src="' . $row["image"] . '" class="card-img-bottom card_img" alt="' . $row["location"] . '" title="' . $row["location"] . '">';

                    echo        '</div>';
                    echo    '</div>';
                
                    echo '</a>';
                
                }
                echo '</div>';
                echo    '</div>';

                mysqli_free_result($result);     
            
                
                $query = 'SELECT count(*) FROM tbl_202_firefighters where on_call=1';
                $result = mysqli_query($connection, $query);
                if(!$result) {
                    die("DB query failed");
                }
                $row = mysqli_fetch_assoc($result);
                $ff_num = $row["count(*)"];
                
                echo '<div class="activeff">';
                echo '<a href="onCall.php"><h2 class="subTitle1">On-call firefighter (' . $ff_num . ')</h2></a>';
                mysqli_free_result($result);
                if ($ff_num != 0) {
                    
                    $query = 'SELECT * FROM tbl_202_firefighters where on_call=1';
                    $result = mysqli_query($connection, $query);
                    if(!$result) {
                        die("DB query failed");
                    }
                    
                    echo '<div class="list">';  
                    echo    '<ol>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo    '<li>' . $row["ff_first_name"] . ' ' . $row["ff_last_name"] . ' - Helmet ' . $row["helmet_id"] . '</li>';    
                    }
                    echo    '</ol>';
                    echo '</div>';
                }
                echo '</div>';

            } else if ($_SESSION["user_type"] == 'user') {

                $query2 = 'SELECT * FROM tbl_202_events where new_event=1';
                $result2 = mysqli_query($connection, $query2);
                    if(!$result2) {
                        die("DB query failed");
                    }
                echo '<div class="events_bg">';
                while ($row = mysqli_fetch_assoc($result2)) {
                    echo    '<a href="event.php?event_id=' . $row["event_id"] . '">';
                    echo    '<div class="card">';
                    echo         '<div class="card-body">';
                    echo            '<h4><b>' . $row["event_type"] . '</b></h4>';
                    if ($row["hazardous"] == 1) {
                        echo        '<div class="hazard"><b>Hazardous material!</b></div>';
                    } else {
                        echo        '<br>';
                    }
                    echo            '<p class="card-text"><b>Location: </b>' . $row["location"] . '<br>';
                    echo                                        '<b>Crew: </b>' . $row["crew"] . '<br>';
                    echo                                        '<b>Urgency levels: </b>' . $row["urgency"] . '<br>';
                    echo                                        '<b>Start: </b>' . $row["start_time"] . '<br></p>';
                    
                    
                    echo            '<img src="' . $row["image"] . '" class="card-img-bottom card_img" alt="' . $row["location"] . '" title="' . $row["location"] . '">';

                    echo        '</div>';
                    echo    '</div>';
                
                    echo '</a>';
                
                }
                echo '</div>';
                
                echo    '</div>';

                echo    '<div class="card">';
                echo         '<div class="card-body">';
                
                echo '<div class="mapouter">';
                echo    '<div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=400&amp;height=400&amp;hl=en&amp;q=גדרה&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://connectionsgame.org/">Connections Game</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style>';
                echo '</div></div></div>';

                mysqli_free_result($result2);    
                }

                

                echo '</div>';
                

            
        ?>
    </div>
  
</body>

</html>


<?php
    //close DB connection
    mysqli_close($connection);
?>