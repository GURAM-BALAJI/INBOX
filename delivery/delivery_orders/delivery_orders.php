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
          Deliverys
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Manage</li>
          <li class="active">Deliverys</li>
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
                      <th>Chef Name</th>
                      <th>Name</th>
                      <th>Catogory</th>
                      <th>To</th>
                      <th>Added Date</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                      $conn = $pdo->open();
                      try {
                        $stmt = $conn->prepare("SELECT * FROM orders left join items  on orders_items=items_id left join address_details on address_id=orders_address_id WHERE orders_delivered=:orders_delivered AND orders_accept=:orders_accept ");
                        $stmt->execute(['orders_delivered'=>0, 'orders_accept'=>1]);
                        foreach ($stmt as $row) {
                          $image = (!empty($row['items_image'])) ? '../../items_images/' . $row['items_image'] : '../../items_images/noimage.jpg';
                          echo "<tr>";
                          echo "<td>" . $row['orders_id'] . "</td>";
                          echo "<td>";
                          $stmt1 = $conn->prepare("SELECT admin_name FROM admin WHERE admin_id =:given_id");
                          $stmt1->execute(['given_id' => $row['item_chef_id']]);
                          foreach ($stmt1 as $row1)
                            echo $row1['admin_name'];
                          echo "</td>";
                          echo "<td>" . $row['orders_qty'] . "- " . $row['items_name'] . "(" . $row['items_cost'] . ")</td>";
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
                          echo "<td>";
                          $stmtcatname = $conn->prepare("SELECT category_name FROM category WHERE category_id=:item_meal_type");
                          $stmtcatname->execute(['item_meal_type' => $row['item_meal_type']]);
                          foreach ($stmtcatname as $rowcatname)
                            echo htmlspecialchars($label) . " - " . htmlspecialchars($rowcatname['category_name']);
                          echo "</td>";
                          echo "<td>" . $row['phone'] . " - " . $row['Landmark'] . ", " . $row['address'] . "</td>";
                          echo "<td>" . $row['items_add_date'] . "</td>";
                          echo "<td>";
                          echo "<button class='btn btn-success btn-sm delivery btn-flat' data-id='" . $row['orders_id'] . "'></i> Delivired? </button>";
                          echo "</td>";
                          echo "</tr>
                        ";
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
     <div class="modal fade" id="delivery">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Delivering....</b></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" action="deliveried.php">
              <input type="hidden" class="itemstatus1" name="id">
              <div class="text-center">
                <h3>Did You deliveried the Order?</h3>
                <h2 class="bold">Order ID</h2>
                <h2 class="bold catid"></h2>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-flat pull-left" name="no"><i class="fa fa-close"></i>I Don't
              Delivery </button>
            <button type="submit" class="btn btn-success btn-flat" name="yes"><i class="fa fa-check"></i>
              I Delivery</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- ./wrapper -->

  <?php include '../includes/scripts.php'; ?>

</body>
<script>
 $(function () {
      $(document).on('click', '.delivery', function (e) {
        e.preventDefault();
        $('#delivery').modal('show');
        var id = $(this).data('id');
        $('.catid').val(id);
        getRow(id);
      });

    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'delivery_row.php',
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
</html>