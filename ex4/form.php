<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <h1>Welcome!</h1>
    <?php 
        $cl = $_GET["color"];
        $sz = $_GET["size"];
        $ct = $_GET["cut"];

        if ($cl == "red")
            echo "We are sorry :(<br>" . $cl . " shirts are out of stock<br>";
        else
            echo "Great choise! Your order is a " . $cl . " " . $sz . " " . $ct ." " . "shirt<br>";
    ?>
    
</body>
</html>