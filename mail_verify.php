<?php
include 'includes/session.php';
if (isset($_GET['token'])) {
  $token = test_input($_GET['token']);
  $conn = $pdo->open();
  $stmt = $conn->prepare("SELECT *,COUNT(*) AS numrows FROM users WHERE user_token=:token12");
  $stmt->execute(['token12' => $token]);
  $row = $stmt->fetch();
  if ($row['numrows'] > 0) {
    $stmt1 = $conn->prepare("UPDATE users SET user_status=:status, user_token=:token WHERE user_token=:token1");
    $stmt1->execute(['status' => 1, 'token' => 0, 'token1' => $token]);
    $_SESSION['success'] = "Your Account Is Activated. ";

?>
    <html lang="en">

    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta charset="utf-8">
      <title> mail </title>
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
      <div class="login-box">
        <center>
          <h3 style="color:aliceblue;"><?php echo $_SESSION['success'];
                                        unset($_SESSION['success']); ?></h3>
          <a href="./LogMe" style=" text-decoration:none;">
            <div class="user-box" style="background: #03e9f4;
  color:green;
  border-radius: 5px;
  padding:10px;
  box-shadow: 0 0 5px #03e9f4,
              0 0 5px #03e9f4,
              0 0 5px #03e9f4,
              0 0 10px #03e9f4;">
              Click Login
            </div>
          </a>
        </center>
      </div>
    </body>

    </html>
<?php
  }
  $pdo->close();
} ?>