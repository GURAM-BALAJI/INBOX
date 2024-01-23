<?php include '../includes/session.php'; ?>
<?php include '../includes/header.php'; ?>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include '../includes/navbar.php'; ?>
      <?php include '../includes/menubar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Viewed Contact
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Home</li>
            <li>REQUESTS</li>
            <li class="active"> Viewed Contact</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php
          if (isset($_SESSION['error'])) {
            echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
            unset($_SESSION['error']);
          }
          if (isset($_SESSION['success'])) {
            echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
            unset($_SESSION['success']);
          }
          ?>
          <div class="panel panel-default" style="overflow-x:auto;">
            <form method="POST">
              <div class="form-group">
                <div class="col-sm-4">
                  <input type="date" class="form-control" name="date" id="date" required>
                </div>
                <div class="col-sm-4">
                  <input type="submit" class="form-control-static" name="submit" id="submit" value=" Submit ">
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-body">

                    <?php
                    $conn = $pdo->open();
                    echo "<table id='example1' class='table table-bordered'>
                    <thead>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Subject</th>
                      <th>Date</th>                         
                    </thead>
                    <tbody>";
                    try {

                      date_default_timezone_set('Asia/Kolkata');
                      if (isset($_POST['submit'])) {
                        $today = strtotime(test_input($_POST['date']));
                        $day = date('d', $today);
                        $month = date('m', $today);
                        $year = date('Y', $today);
                      } else {
                        $day = date('d');
                        $month = date('m');
                        $year = date('Y');
                      }

                      $stmt = $conn->prepare("SELECT * FROM contact WHERE day(contact_date)=:day AND month(contact_date)=:month AND year(contact_date)=:year AND contact_view=:contact_view");
                      $stmt->execute(['day' => $day, 'month' => $month, 'year' => $year, 'contact_view' => 1]);
                      foreach ($stmt as $row) {


                        echo "
                          <tr>
                            <td>" . $row['contact_name'] . "</td>
                              <td>" . $row['contact_email'] . "</td>
                                <td>" . $row['contact_phone'] . "</td>
                                    <td>" . $row['contact_subject'] . "</td>
                                    <td>" . $row['contact_date'] . "</td>
                            
                          </tr>
                        ";
                      }
                    } catch (PDOException $e) {
                      echo "Something Went Wrong.";
                    }
                    echo "</tbody>
              </table>";
                    $pdo->close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </div>

    </div>
    <!-- ./wrapper -->

    <?php include '../includes/scripts.php'; ?>
  </body>

</html>