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
            Present Orders
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage</li>
            <li class="active">Present Orders</li>
          </ol>
        </section>
        <section class="content">
          <div class="panel panel-default" style="overflow-x:auto;">
            <div class="row">
                   <div class="col-xs-12">
                <div class="box">
                  <div class="box-body">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th>#</th>
                        <th>USER ID</th>
                        <th>ITEMS</th>
                        <th>QTY</th>
                        <th>COST</th>
                        <th>DATE</th>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();
                        try {
                          $slno = 1;
                          $stmt = $conn->prepare("SELECT * FROM orders ORDER BY orders_id DESC");
                          $stmt->execute();
                          foreach ($stmt as $row) {
                            echo "<tr>";
                            echo "<td>" . $slno++ . "</td>";
                            echo "<td>" . $row['orders_user_id'] . "</td>";
                            echo "<td>" . $row['orders_items'] . "</td>";
                            echo "<td>" . $row['orders_qty'] . "</td>";
                            echo "<td>" . $row['orders_cost'] . "</td>";
                            echo "<td>" . $row['orders_date'] . "</td>";
                            echo "</tr>";
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

      </div>

    </div>
    <!-- ./wrapper -->

    <?php include '../includes/scripts.php'; ?>
  </body>

</html>