<?php include 'includes/session.php';

if (isset($_POST['submit'])) {
  include './includes/req_start.php';
  if ($req_per == 1) {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);
    $subject = test_input($_POST['subject']);
    //Sanitizing inputs.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      $_SESSION['error'] = "Invalid email format.";
    if (!validateMobileNumber($phone))
      $_SESSION['error'] = 'Invalid phone number format.';
    if (strlen($name) > 20)
      $_SESSION['error'] = 'Name should be less then 20 characters.';
    if (strlen($name) < 5)
      $_SESSION['error'] = 'Name should be more then 5 characters.';
    if (!isset($_SESSION['error'])) {
      date_default_timezone_set('Asia/Kolkata');
      $today = date('Y-m-d h:i:s a');
      $conn = $pdo->open();
      $sql = "INSERT INTO contact (contact_name, contact_phone, contact_email, contact_subject,contact_date) VALUES ('$name', '$phone', '$email', '$subject','$today')";
      if ($conn->query($sql) == TRUE) {
        echo "<center><h2 style='color:green;'>Sent successfully</h2></center>";
      } else {
        echo "<center><h2 style='color:red;'>Something Went Wrong!</h2></center>";
      }
      $pdo->close();
    }
  }
}
function validateMobileNumber($mobile)
{
  if (!empty($mobile)) {
    $isMobileNmberValid = true;
    $mobileDigitsLength = strlen($mobile);
    if ($mobileDigitsLength < 10 || $mobileDigitsLength > 11) {
      $isMobileNmberValid = false;
    } else {
      if (!preg_match("/^[+]?[1-9][0-9]{9}$/", $mobile)) {
        $isMobileNmberValid = false;
      }
    }
    return $isMobileNmberValid;
  } else {
    return false;
  }
}
?>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="./style_nav_bar.css">

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
      align-content: center;
    }

    .nav__link--active {
      color:
        <?php if (isset($_COOKIE["theme"]))
          echo "#38b6ff";
        else
          echo "rgba(254, 191, 1, 1)";
        ?>;
    }

    * {
      box-sizing: border-box;
    }

    /* Style inputs */
    input[type=text],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #f079ff;
      margin-top: 6px;
      margin-bottom: 16px;
      resize: vertical;
    }

    input[type=submit] {
      background-color: #7e7e7e;
      color: white;
      padding: 12px 20px;
      border: none;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #c9ffcc;
    }

    /* Create two columns that float next to eachother */
    .column {
      float: left;
      width: 100%;
      margin-top: 6px;
      padding: 20px;
    }

    /* Clear floats after the columns */
    .row:after {
      display: table;
      clear: both;
    }

    @media screen and (max-width: 600px) {

      .column,
      input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
    }
  </style>
</head>

<body unload='MyHome'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <div class="container">
    <div style="text-align:center">
      <h2><u>Contact Us:</u></h2>
      <p style="color:#6a0000" ;>Any feedback, Leave us a Message</p>
    </div>
    <div class="row">
      <div class="column">
        <form action="" method="post">
          <label for="name"> Name</label>
          <input type="text" id="name" name="name" placeholder="Your name.." required>
          <label for="email">Email</label>
          <input type="text" id="email" name="email" placeholder="Your Email.." required>
          <label for="phone">Phone</label>
          <input type="text" id="phone" name="phone" placeholder="Your phone..">
          <label for="subject">Subject</label>
          <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px" required></textarea>
          <input type="submit" name="submit" id="submit" value="Submit">
        </form>
      </div>
    </div>
  </div>


  <br><br><br><br>
  <nav class="nav">

    <a href="MyHome" class="nav__link ">
      <i class="material-icons nav__icon">home</i>
      <span class="nav__text">Home</span>
    </a>

    <a href="MyProfile" class="nav__link">
            <i class="material-icons nav__icon">person</i>
            <span class="nav__text">Profile</span>
        </a>
    <a href="MyCart" class="nav__link">
      <?php
      $i = 0;
      if (isset($_SESSION['vm_id'])) {
        $stmt = $conn->prepare("SELECT * FROM cart WHERE cart_user_id=:user_id");
        $stmt->execute(['user_id' => $_SESSION['vm_id']]);
        foreach ($stmt as $row)
          $i++;
      ?>

      <?php } ?>
      <div class="container_cart">
        <i class="material-icons nav__icon">shopping_cart</i>
        <?php if ($i != 0) { ?>
          <span class="badge_cart"><?php echo $i; ?></span>
        <?php } ?>
      </div>
      <span class="nav__text">Cart</span>
    </a>

    <a href="MySettings" class="nav__link nav__link--active">
      <i class="material-icons nav__icon">settings</i>
      <span class="nav__text">Settings</span>
    </a>

  </nav>

</body>

</html>