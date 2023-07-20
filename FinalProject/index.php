<?php 
  include 'db.php';
  include 'config.php';

  session_start();
  if (!empty($_POST["loginUsername"])){
    $query = "SELECT * FROM tbl_202_users WHERE username='" 
    . $_POST["loginUsername"] 
    . "' and password = '" 
    . $_POST["loginPass"] . "'";
  

    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
      // session_save();
      $_SESSION["user_id"] = $row['user_id'];
      $_SESSION["user_type"] = $row['user_type'];
      $_SESSION["image"] = $row['image'];
      $_SESSION["first_name"] = $row['first_name'];
      $_SESSION["last_name"] = $row['last_name'];
      $_SESSION["email"] = $row['email'];

      header('Location: ' . URL . 'dashboard.php');

    }
    else {
      $message = "incorrect details! please try again";
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css">
    <script src="js/script.js"></script>
    <title>Rescue Helmet</title>

</head>
<body>  
  
  <section class="gradient-custom">
    <form action="#" method="post" id="frm">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12">
            <div class="card bg-dark text-black" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold text-white mb-2 text-uppercase">Login</h2>
                  <p class="text-white-50 mb-5">Please enter your username and password!</p>

                  <div class="form-outline form-white mb-4">
                    <input type="text" required name="loginUsername" class="form-control form-control-lg" />
                    <label class="text-white-50 form-label">Username</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" required name="loginPass" id="typePasswordX" class="form-control form-control-lg" />
                    <label class="text-white-50 form-label" for="typePasswordX">Password</label>
                  </div>

                  <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        if(isset($message)) {
          echo '<div class="error-message">';
          echo $message;
          echo '</div>';
        }
      ?>
    </form>
  </section>

    
</body>
</html>


<?php
    //close DB connection
    mysqli_close($connection);
?>