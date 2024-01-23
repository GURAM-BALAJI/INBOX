<?php
include '../includes/session.php';
include '../includes/header.php'; ?>

<?php include '../includes/navbar.php'; ?>
<?php include '../includes/menubar.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-dashboard"></i> Home</li>
          <li class="active">Dashboard</li>
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
        <?php 
          $conn = $pdo->open();
          $stmt1 = $conn->prepare("SELECT * from logs");
          $stmt1->execute();
          $row = $stmt1->fetch();
        ?>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <?php
                  echo "<h6>Active Admin's: " . htmlentities($row['logs_active_admin'] - $row['logs_inactive_admin']) . "</h6>";
                  echo "<h6>In-Active Admin's:" . htmlentities($row['logs_inactive_admin']) . "</h6>";
                  echo "<h6>Total Admin's:" . htmlentities($row['logs_active_admin']) . "</h6>";
                  ?>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="../admin/admin.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php
                  echo "<h6>Active User's: " . htmlentities($row['logs_active_users'] - $row['logs_inactive_users']) . "</h6>";
                  echo "<h6>In-Active User's:" . htmlentities($row['logs_inactive_users']) . "</h6>";
                  echo "<h6>Total User's:" . htmlentities($row['logs_active_users']) . "</h6>";
                  ?>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="../users/users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-gray">
                <div class="inner">
                  <?php

                  echo "<h3>" . $row['logs_order'] . "</h3>";
                  ?>
                  <div class="stat-panel-title text-uppercase">Total Present Orders</div>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="../orders/orders.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        <?php $pdo->close();
        ?>
    </div>
    <?php include '../includes/scripts.php'; ?>
</body>

</html>