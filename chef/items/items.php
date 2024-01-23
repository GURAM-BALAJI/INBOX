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
          Items
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Manage</li>
          <li class="active">Items</li>
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
                <div class="box-header with-border">
                  <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
                      class="fa fa-plus"></i> New Items</a>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th>Item_id</th>
                      <th>Iteam_name</th>
                      <th>Image</th>
                      <th>Chef_Id</th>
                      <th>Category</th>
                      <th>Meal type</th>
                      <th>Price</th>
                      <th>status</th>
                      <th>Added Date</th>
                      <th>Tools</th>

                    </thead>
                    <tbody>
                      <?php
                      $conn = $pdo->open();

                      try {
                        $stmt = $conn->prepare("SELECT * FROM items WHERE item_chef_id=:item_chef_id");
                        $stmt->execute(['item_chef_id'=> $_SESSION['vm_id_admin']]);
                        $categoryNames = [
                          0 => 'Veg',
                          1 => 'Non-veg',
                        ];

                        $mealTypeNames = [
                          1 => 'Breakfast',
                          2 => 'Lunch',
                          3 => 'Dinner',
                          4 => 'Singles',
                          5 => 'Snacks',
                        ];

                        foreach ($stmt as $row) {
                          $status = ($row['item_status']) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Not Active</span>';
                          $active = (!$row['item_status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="' . $row['items_id'] . '"><i class="fa fa-check-square-o"></i></a></span>' : '<span class="pull-right"><a href="#not_activate" class="status" data-toggle="modal" data-id="' . $row['items_id'] . '"><i class="fa fa-check-square-o"></i></a></span>';
                          $image = (!empty($row['items_image'])) ? '../../items_images/' . $row['items_image'] : '../../items_images/noimage.jpg';

                          echo "<tr>";
                          echo "<td>" . $row['items_id'] . "</td>";
                          echo "<td>" . $row['items_name'] . "</td>";
                          echo "<td> <img src='" . $image . "' height='40px' width='50px'>" . "</td>";
                          echo "<td>";
                          $stmt1 = $conn->prepare("SELECT admin_name FROM admin WHERE admin_id =:given_id");
                          $stmt1->execute(['given_id' => $row['item_chef_id']]);
                          foreach ($stmt1 as $row1)
                            echo $row1['admin_name'];
                          echo "</td>";

                          echo "<td>" . $categoryNames[$row['item_category']] . "</td>";
                          echo "<td>" . $mealTypeNames[$row['item_meal_type']] . "</td>";

                          echo "<td>" . $row['items_cost'] . "</td>
                            <td>
                            $status";
                          echo "$active";
                          echo "</td>";
                          echo "<td>" . $row['items_add_date'] . "</td>";
                          echo "<td>";
                          echo "<button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['items_id'] . "'><i class='fa fa-trash'></i> Delete</button>";

                          echo "</td>";
                          echo "</tr>"; // Close the row here
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
    <?php include 'items_modal.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include '../includes/scripts.php'; ?>
  <script>
    $(function () {
      $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        $('#delete').modal('show');
        var id = $(this).data('id');
        $('.catid').val(id);
        getRow(id);
      });

    });
    $(document).on('click', '.status', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      $('.itemstatus').val(id);
      getRow(id);
    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'items_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function (response) {
          $('.catid').val(response.items_id);
          $('.itemname').html(response.items_name);
          $('.itemstatus1').val(response.items_id);
          $('.itemstatus2').val(response.items_id);
          $('.itemname1').html(response.items_name);
          $('.itemname2').html(response.items_name);


        }
      });
    }
  </script>
</body>

</html>