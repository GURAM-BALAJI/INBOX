<!doctype html>
<?php
include 'includes/session.php'; 
if(isset($_SESSION['vm_user']))
        header('location: MyHome');
?>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.70">
<meta charset="utf-8">
    <title>  Forgot Password </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
         <div class="login-box">
           <h2>FORGOT PASSWORD</h2>
           <form action="forgot-password-mail-send.php" method="post" onsubmit="myclick();">
             <div class="user-box">
               <input type="email" name="email" required value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>">
               <label>Email</label>
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
             <a >
               <span></span>
               <span></span>
               <span></span>
               <span></span>
               <input type="submit" name="check-email" id="check" value="Continue"
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
    <script type="text/javascript">
    function myclick(){
        document.getElementById('check').disabled="true";
    }
    </script>
    </html>