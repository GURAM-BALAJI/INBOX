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
            New Contact
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Home</li>
            <li>REQUESTS</li>
            <li class="active">New Contact</li>
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
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-body">

                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Date</th>
                          <th>View</th>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();
                        try {
                          $now = date('Y-m-d');
                          $stmt = $conn->prepare("SELECT * FROM contact WHERE contact_view=:contact_view");
                          $stmt->execute(['contact_view' => 0]);
                          foreach ($stmt as $row) {

                            echo "
                          <tr>
                            <td>" . $row['contact_name'] . "</td>
                              <td>" . $row['contact_email'] . "</td>
                                <td>" . $row['contact_phone'] . "</td>
                                    <td>" . $row['contact_subject'] . "</td>
                                    <td>" . $row['contact_date'] . "</td>";
                              echo "<td><form action='contact_view_row.php' method='get'>
                            <input type='text' name='id' value='" . $row['contact_id'] . "' hidden>
                            <input type='submit' name='submit' value='View'></form></td>  
                          </tr>
                        ";
                          
                          }
                        } catch (PDOException $e) {
                          echo "Something Went Wrong.";
                        }

                        ?>
                      </tbody>
                    </table>
                    <?php
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