 <!doctype html>
<?php
include 'includes/session.php';
if (isset($_SESSION['vm_user']))
  header('location: MyHome');
if (isset($_SESSION['mailAuth']))
  unset($_SESSION['mailAuth']);
else
  header('location: ./JoinUs');
?>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.70">
  <meta charset="utf-8">
  <title> ACTIVATE </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
  <div class="login-box">
    <h3 style="color:aliceblue;">Mail Authentication</h3>
     <?php
              if (isset($_SESSION['success'])) {
                echo "
          <div class='text-center' style='color:green;'>
            <p>" . $_SESSION['success'] . "</p> 
          </div>
        ";
                unset($_SESSION['success']);
              }
             if (isset($_SESSION['error'])) {
                echo "
          <div class='text-center' style='color:red;'>
            <p>" . $_SESSION['error'] . "</p> 
          </div>
        ";
                unset($_SESSION['error']);
              }
              ?>
  </div>
  </center>
</body>

</html>