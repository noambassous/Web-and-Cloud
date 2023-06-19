<?php
    include 'db.php';

    $bookId = $_GET["book_id"];
    $query = "SELECT * FROM tbl_80_books WHERE book_id =" . $bookId;

    $result = mysqli_query ($connection, $query);
    if($result) {
        $row = mysqli_fetch_assoc($result);
    }
    else die ("DB query failed");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	   
        <title>Document</title>
    </head>
    <body>
        <div class="container row">
            
            <?php
                echo '<div class="col-6">';
                echo    '<h2>' . $row["name"] . '</h2><br>';
                echo    '<img src="' . $row["img1"] . '" alt="' .  $row["name"] . '" title="' .  $row["name"] . '">';
                echo    '<br><h4>Category: ' . $row["category"] . '</h4>';
                echo    '<h4>Price: ' . $row["price"] . ' NIS</h4><br>';
                echo '</div>';
                echo '<div class="col-6">';
                echo    '<h2>Author: ' . $row["author"] . '</h2><br>';
                echo    '<img src="' . $row["img2"] . '" alt="' .  $row["author"] . '" title="' .  $row["author"] . '">';
                echo '</div>';
                
                mysqli_free_result($result);
            ?>
        </div>

    </body>
</html>

<?php
    mysqli_close($connection);
?>