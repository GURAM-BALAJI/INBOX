<!doctype html>
<?php
include 'includes/session.php'; 
if(!isset($_SESSION['email']))
        header('location: MyHome');
?>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.70">
<meta charset="utf-8">
    <title>  New Password </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
         <div class="login-box">
           <h2>NEW PASSWORD</h2>
                 <center>  <?php
      if(isset($_SESSION['success'])){
        echo "
          <div class='text-center' style='color:green;'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?></center>
           <form action="change-password.php" method="post">
             <div class="user-box">
               <input type="password" name="password" required>
               <label>New Password</label>
             </div>
               <div class="user-box">
               <input type="password" name="cpassword" required>
               <label>Confirm New Password</label>
             </div>
        
    <center>  <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='text-center' style='color:red;'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?></center>
             <a>
               <span></span>
               <span></span>
               <span></span>
               <span></span>
               <input type="submit" name="change-password" value="Change"
                      style="border:none;
                      background:none;
                      outline: none;
                      transition: .5s;
                      letter-spacing: 4px;
                      display: inline-block;
                      color: #03e9f4;
                      text-transform: uppercase;
                      font-weight: 600;
                      text-decoration: none;
                      overflow: hidden;
                      font-size: 18px;
" >
             </a>
          </form>
         </div>
    </body>
    </html>