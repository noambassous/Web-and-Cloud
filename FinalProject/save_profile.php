<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'index.php'); 
    }

    $query = 'SELECT * FROM tbl_202_users WHERE user_id =' . $_SESSION["user_id"];

    $result = mysqli_query($connection, $query);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);

    }else{
        header('Location: ' . URL . 'profile.php?user_id=' . $_SESSION["user_id"]);
    }

?>

<?php 

    $firstName = mysqli_real_escape_string($connection, $_GET['first_name']);
    $lastName = mysqli_real_escape_string($connection, $_GET['last_name']);
    $emaiL = mysqli_real_escape_string($connection, $_GET['email']);
    $userId = $_GET['user_id'];

    $query = "update tbl_202_users set first_name='$firstName',last_name='$lastName', email='$emaiL' where id='$userId'";


    header('Location: ' . URL . 'dashboard.php');
?>



<?php
    //close DB connection
    mysqli_close($connection);
?>
