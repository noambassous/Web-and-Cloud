<?php
    include 'db.php';
    include 'config.php';

    session_start();
    session_destroy();
    header('Location: ' . URL . 'index.php');
?>

<?php
    //close DB connection
    mysqli_close($connection);
?>