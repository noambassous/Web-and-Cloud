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
    <title>Active events</title>


    <link rel="stylesheet" href="css/style2.css">
    <script src="js/script.js"></script>

</head>
<body>
<header>
        <a href="dashboard.php" id="logo2"></a>
        <a href="dashboard.php" id="logo1"></a>
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
                    <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                    <?php
                        if ($_SESSION["user_type"] == 'admin') {
                            echo '<a class="nav-link" href="activeEvents.php">Active events</a>';
                            echo '<a class="nav-link" href="endedEvents.php">Ended events</a>';
                        }
                    ?>
                    <a class="nav-link active" href="onCall.php">On-Call crews</a>
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
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home page</a></li>
                <li class="breadcrumb-item active" aria-current="page">On-call crew</li>
            </ol>
        </nav>
        <div class="contain">
            <div class="options col-sm-3">
                <a href="#" id="notifications"></a>
            </div>
        </div>
        
        <div class="events_bg full">
            <a href="#"><h2 class="subTitle2"><b>On-Call crews</b></h2></a>
            <div id="events">
            <?php             

                $query = 'SELECT *, SUM(on_call) FROM tbl_202_firefighters group by crew;';
                $result = mysqli_query($connection, $query);
                if(!$result) {
                    die("DB query failed");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["SUM(on_call)"] != 0){
                        $query2 = 'SELECT * FROM tbl_202_firefighters where crew = "' . $row["crew"] . '" and on_call=1;';
                        $result2 = mysqli_query($connection, $query2);
                        if (!$result2){
                            die ("DB query failed");
                        }
                        
                        echo '<div class="card list_card" style="width: 18rem;">';
                        echo    '<div class="card-body">';
                        echo        '<h4 class="card-title"><b>' . $row["crew"] . '</b></h4>';
                        echo        '<h6>Crew members:</h6>';
                        echo        '<ul>';
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            echo        '<li>' . $row2["ff_first_name"] . ' ' . $row2["ff_last_name"] . '</li>';

                        }
                        echo        '</ul>';
                        echo    '</div>';
                        echo '</div>';
                    }
                }
                        

                mysqli_free_result($result); 
            
                ?>
                </div>
            </div>
    
</body>
</html>


<?php
    //close DB connection
    mysqli_close($connection);
?>