<!doctype html>
<?php
include '../includes/session.php'; 
if(isset($_SESSION['vm_admin']))
     header('location: home/home.php');
?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.70">
<meta charset="utf-8">
    <title>  Login </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
         <div class="login-box">
           <h2>Login</h2>
           <form action="verify.php" method="post">
             <div class="user-box">
               <input type="text" name="phone" required="">
               <label>Phone</label>
             </div>
             <div class="user-box">
               <input type="password" name="password" required="">
               <label>Password</label>
             </div>
               <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='text-center' s>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?>
             <a style="float:right;">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
               <input type="submit" name="login" value="Login"
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
        
           </form>
         </div>
    </body>
    </html>