<?php
    include 'db.php';
    
    if(!(isset($_GET["category"])) Or $_GET["category"] === '"All"') {
        $query = "SELECT * FROM tbl_80_books order by name";       
    }
    else {
        $chosenCategory = $_GET["category"];
        $query = "SELECT * FROM tbl_80_books WHERE category = " . $chosenCategory;
    }

    
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die("DB query failed");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <title>Books</title>
    </head>
    <body>
        <div class="container">
            <h1>Books</h1>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                </button>
                <ul id="scroll" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">


                </ul>
            </div>

            <?php
                if (isset($chosenCategory)) {
                    echo '<h4>Category: ' . $chosenCategory . '</h4>';                
                }
                
                echo '<div class="row">';
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="card" style="width: 18rem;">';
                    echo    '<img src="' . $row["img1"] . '" class="card-img-top" alt="' .  $row["name"] . '" title="' .  $row["name"] . '">';
                    echo    '<div class="card-body">';
                    echo        '<h5 class="card-title">' .  $row["name"] . '</h5>';
                    echo        '<h6 class="card-text">Author: ' . $row["author"] . '</h6>';
                    echo        '<a href="book.php?book_id=' . $row["book_id"] . '" class="btn btn-primary">Go to this book page</a>';
                    echo    '</div>';
                    echo '</div>';
                }
                echo '</div>';

                mysqli_free_result($result);

            ?>
        </div>

        <script src="js/showCat.js"></script>
    </body>
</html>



<?php
    mysqli_close($connection);
?>