<?php
include '../../includes/conn.php';

if (isset($_POST['submit'])) {
 
    // Taking all 5 values from the form data(input)
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    //Sanitizing inputs.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      $_SESSION['error'] = "Invalid email format.";
    if (strlen($name) > 20)
      $_SESSION['error'] = 'Name should be less then 20 characters.';
    if (strlen($name) < 5)
      $_SESSION['error'] = 'Name should be more then 5 characters.';
    if (!isset($_SESSION['error'])) {
      date_default_timezone_set('Asia/Kolkata');
      $today = date('Y-m-d h:i:s a');
      $conn = $pdo->open();
      $sql = "INSERT INTO contact (contact_name, contact_message, contact_email, contact_subject,contact_date) VALUES ('$name', '$message', '$email', '$subject','$today')";
      if ($conn->query($sql) == TRUE) {
        echo "<center><h2 style='color:green;'>Sent successfully</h2></center>";
      } else {
        echo "<center><h2 style='color:red;'>Something Went Wrong!</h2></center>";
      }
      $pdo->close();
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-VL9J82bJ1Htwl5RW+9btbslgsPBujHzA2QK5vRfJp1PT8W/uC9HxrBE5orRV+nUo" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        label {
            font-weight: bold;
        }

        input[type=text], select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: orange;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;
        }

        input[type=submit]:hover {
            background-color: orange;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            margin: 40px;
        }

        #contactButton {
            background-color: white;
            color: orange;
            padding: 20px 20px;
            border: none;
            cursor: pointer;
            font-size: 30px;
            font-weight: bold;
        }

        
    </style>
</head>
<body>
    
    <button id="contactButton" onclick="window.location.href='MyHome'">Inboxfood</button>
       
    <div class="container">
        <h1> Get In Touch </h1>
        <form action="" method="post">
            <br>
            <label for="name">Name</label><br>
            <input type="text" name="name" required>
            <br>
            <label for="email">Email</label><br>
            <input type="text" name="email" required >
            <br>
            <label for="subject">Subject</label><br>
            <select name="subject" required>
                <option value="general">General</option>
                <option value="complaint">Complaint</option>
                <option value="technical_support">Technical Support</option>
                <option value="feedback">Feedback</option>
                <option value="help">Need any help</option>
            </select>
            <br>
            <label for="message">Message</label><br>
            <input type="text" name="message" required>
            <br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
