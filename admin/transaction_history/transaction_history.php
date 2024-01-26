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
          Transaction History
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Manage</li>
          <li class="active">Transaction History</li>
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
                      <th>Transaction_id</th>
                      <th>Transaction_user_id</th>
                      <th>Transaction_amount</th>
                      <th>Phone_number</th>
                      <th>Transaction_date</th>
                      <th>Transaction_status</th>
                      <th>Address_id</th>

                    </thead>
                    <tbody>
                      <?php
                      $conn = $pdo->open();
                      try {
                        $stmt = $conn->prepare("SELECT * FROM transaction LEFT JOIN address_details 
                        ON  transaction_address_id = address_id");
                        $stmt->execute();
                        foreach ($stmt as $row) {
                          echo "<tr>";
                          echo "<td>" . $row['transaction_id'] . "</td>";
                          echo "<td>" . $row['transaction_user_id'] . "</td>";
                          echo "<td>" . $row['transaction_amount'] . "</td>";
                          echo "<td>" . $row['phone'] . "</td>";
                          echo "<td>" . $row['transaction_date'] . "</td>";
                          echo "<td>" . $row['transaction_status'] . "</td>";
                          echo "<td>" . $row['address_id'] . "</td>";
                        }
                      } catch (PDOException $e) {
                        echo "Something Went Wrong.";
                      }

                      $pdo->close();
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Add -->


    </div>
  </div>
  <!-- ./wrapper -->

  <?php include '../includes/scripts.php'; ?>
</body>

</html>