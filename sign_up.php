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
    <title>  Sign Up </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
      <style>
    body {
       background:
    <?php if (isset($_COOKIE["theme"])) 
        echo "linear-gradient( to right, #c6eaff 50%, #38b6ff 50%, #c6eaff 0%, #38b6ff 0%)";
     else 
     echo "linear-gradient(to right, rgba(235, 224, 232, 1) 52%, rgba(254, 191, 1, 1) 53%, rgba(254, 191, 1, 1) 100%)";
     ?>;
    font-family: 'Roboto', sans-serif;
}
.nav__link--active {
        color:
            <?php if (isset($_COOKIE["theme"]))
                echo "#38b6ff";
            else
                echo "rgba(254, 191, 1, 1)";
            ?>;
    }
.area{
       width: 100%;
       height:100vh;   
   }
   
   .circles{
       position: absolute;
       top: 0;
       left: 0;
       width: 95%;
       height: 95%;
       overflow: hidden;
   }
   
   .circles li{
       position: absolute;
       display: block;
       list-style: none;
       width: 20px;
       height: 20px;
       background: rgba(255, 255, 255, 0.900);
       animation: animate 25s linear infinite;
       bottom: -50px;
       
   }
   
   .circles li:nth-child(1){
       left: 25%;
       width: 80px;
       height: 80px;
       animation-delay: 0s;
   }
   
   
   .circles li:nth-child(2){
       left: 10%;
       width: 20px;
       height: 20px;
       animation-delay: 0s;
       animation-duration: 12s;
   }
   
   .circles li:nth-child(3){
       left: 70%;
       width: 20px;
       height: 20px;
       animation-delay: 4s;
   }
   
   .circles li:nth-child(4){
       left: 40%;
       width: 60px;
       height: 60px;
       animation-delay: 0s;
       animation-duration: 18s;
   }
   
   .circles li:nth-child(5){
       left: 65%;
       width: 20px;
       height: 20px;
       animation-delay: 0s;
   }
   
   .circles li:nth-child(6){
       left: 75%;
       width: 110px;
       height: 110px;
       animation-delay: 0s;
   }
   
   .circles li:nth-child(7){
       left: 35%;
       width: 150px;
       height: 150px;
       animation-delay: 0s;
   }
   
   .circles li:nth-child(8){
       left: 50%;
       width: 25px;
       height: 25px;
       animation-delay: 0s;
       animation-duration: 45s;
   }
   .circles li:nth-child(9){
       left: 20%;
       width: 15px;
       height: 15px;
       animation-delay: 0s;
       animation-duration: 115s;
   }
   
   .circles li:nth-child(10){
       left: 85%;
       width: 150px;
       height: 150px;
       animation-delay: 0s;
       animation-duration: 100s;
   }
   
   
   .circles li:nth-child(11){
       left: 20%;
       width: 15px;
       height: 15px;
       animation-delay: 0s;
       animation-duration: 115s;
   }
   
   .circles li:nth-child(12){
       left: 85%;
       width: 150px;
       height: 150px;
       animation-delay: 0s;
       animation-duration: 100s;
   }
   
   
   
   @keyframes animate {
   
       0%{
           transform: translateY(0) rotate(0deg);
           opacity: 1;
           border-radius: 0;
       }
   
       100%{
           transform: translateY(-1000px) rotate(720deg);
           opacity: 0;
           border-radius: 50%;
       }
   
   }
    </style>
    <body>
    <div class="area" >
            <ul class="circles">
                    
                    <li></li><li></li>
                   <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                   <li></li>
                   <li></li>
                   <li></li>
                  <ol></ol>
            </ul>
    </div >
         <div class="login-box">
             <a  href="MyHome" style=" color: #ff1c1c;float:right;text-decoration: none;font-size:x-large;">X</a>
           <h2>Sign Up</h2>
           <form action="JoinMe" method="post" onsubmit="myclick();">
             <div class="user-box">
        <input type="text" name="name" required value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?>" autocomplete="OFF" />
               <label>Full Name</label>
             </div>
               <div class="user-box">
               <input type="email" name="email" required value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>" autocomplete="OFF" />
               <label>Email</label>
             </div>
               <div class="user-box">
               <input type="tel" name="contact" required value="<?php if(isset($_SESSION['contact'])) echo $_SESSION['contact']; ?>" autocomplete="OFF" />
               <label>Contact</label>
             </div>
             <div class="user-box">
               <input type="password" name="password" required value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password']; ?>" autocomplete="OFF" />
               <label>Password</label>
                  <div class="user-box">
                 <input type="password" name="cpassword" required/>
               <label>Confirm Password</label>
             </div>
                                  
              <center> <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='text-center' style='color:red;'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?></center></div>
             <a style="float:right;">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
                <input type="submit" name="signup" value="SIGN UP" id="signup"
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
                             font-size: 18px;"></a>
           </form><br><br><br><br><br><br>
           <center>
           <a  href="LogMe" style="color:aquamarine;text-decoration: none;">Already have an account?<b> Sign In.</b> </a>
           </center>
         </div>
        <script type="text/javascript">
    function myclick(){
        document.getElementById('signup').disabled="true";
    }
    </script>
    </body>
    </html>