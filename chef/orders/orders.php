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
                      <th>OID</th>
                      <th>Item - cost*(Qty)</th>
                      <th>Catogory</th>
                      <th>Added Date</th>
                      <th>Status</th>
                    </thead>
                    <tbody>
                      <?php
                      $conn = $pdo->open();
                      try {
                        $stmt = $conn->prepare("SELECT * FROM orders left join items on orders_items=items_id WHERE item_chef_id=:orders_chef_id AND orders_accept=:orders_accept");
                        $stmt->execute(['orders_chef_id' => $_SESSION['vm_id_admin'], 'orders_accept'=>0]);
                        foreach ($stmt as $row) {
                          echo "<tr>";
                          echo "<td>" . $row['orders_id'] . "</td>";
                          echo "<td>" . $row['items_name'] . " - " . $row['items_cost'] . "*(" . $row['orders_qty'] . ")</td>";

                          switch ($row['item_category']) {
                            case 0:
                              $label = 'Veg';
                              break;
                            case 1:
                              $label = 'Non-Veg';
                              break;
                            default:
                              $label = 'Unknown';
                              break;
                          }
                          switch ($row['item_meal_type']) {
                            case 1:
                              $label2 = 'Breakfast';
                              break;
                            case 2:
                              $label2 = 'Lunch';
                              break;
                            case 3:
                              $label2 = 'Dinner';
                              break;
                            case 4:
                              $label2 = 'Singles';
                              break;
                            case 5:
                              $label2 = 'Snacks';
                              break;
                            default:
                              $label2 = 'Unknown';
                              break;
                          }
                          echo "<td>" . htmlspecialchars($label) . " - " . htmlspecialchars($label2) . "</td>";
                          echo "<td>" . $row['items_add_date'] . "</td>";
                          echo "<td>";
                          echo "<button class='btn btn-success btn-sm accept btn-flat' data-id='" . $row['orders_id'] . "'></i> Accept Order</button>";
                          echo "</td>";
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
      <!-- Add -->
    </div>

    <!--accept orders-->
    <div class="modal fade" id="accept">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Accepting....</b></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" action="present_orders_accept.php">
              <input type="hidden" class="itemstatus1" name="id">
              <div class="text-center">
                <h3>Do You Want to Accept Order?</h3>
                <h2 class="bold">Order ID</h2>
                <h2 class="bold catid"></h2>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-flat pull-left" name="no"><i class="fa fa-close"></i>I Don't
              Accept </button>
            <button type="submit" class="btn btn-success btn-flat" name="yes"><i class="fa fa-check"></i>
              I Accept</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ./wrapper -->
  </div>
  <?php include '../includes/scripts.php'; ?>
  <script>
 $(function () {
      $(document).on('click', '.accept', function (e) {
        e.preventDefault();
        $('#accept').modal('show');
        var id = $(this).data('id');
        $('.catid').val(id);
        getRow(id);
      });

    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'present_orders_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function (response) {
          $('.catid').html(response.orders_id);
          $('.itemstatus1').val(response.orders_id);
        }
      });
    }
  </script>
</body>

</html>