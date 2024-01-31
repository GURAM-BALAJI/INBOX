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
        Category
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Manage</li>
          <li class="active">Category</li>
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
                      class="fa fa-plus"></i> New Category</a>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Commission</th>
                      <th>Tools</th>
                    </thead>
                    <tbody>
                      <?php
                      $conn = $pdo->open();
                      try {
                        $stmt = $conn->prepare("SELECT * FROM category WHERE category_delete=0");
                        $stmt->execute();
                        $slno = 1;
                        foreach ($stmt as $row) {
                          $image = (!empty($row['category_image'])) ? '../../category_images/' . $row['category_image'] : '../../category_images/noimage.jpg';
                          echo "<td>" . $slno++ . "</td>
                          <td><img src='" . $image . "' height='30px' width='30px'>";
                          echo "<span class='pull-right'><a href='#category_image' class='category_image' data-toggle='modal' data-id='" . $row['category_id'] . "'><i class='fa fa-edit'></i></a></span>";
                          echo " </td>
                            <td>" . $row['category_name'] . "</td><td>" . $row['category_commission'] . "%</td>";
                          echo "<td>";
                          echo "<button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['category_id'] . "'><i class='fa fa-edit'></i> Edit</button> ";

                          echo "<button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['category_id'] . "'><i class='fa fa-trash'></i> Delete</button>";

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

    </div>
    <?php include 'category_modal.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include '../includes/scripts.php'; ?>
  <script>
    $(function () {
      $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

      $(document).on('click', '.category_image', function(e) {
          e.preventDefault();
          var id = $(this).data('id');
          getRow(id);
        });

      $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        $('#delete').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'category_row.php',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
          $('.category_id').val(response.category_id);
          $('#category_name').val(response.category_name);
          $('#commission').val(response.category_commission);
          $('.delete_category_id').val(response.category_id);
          $('.delete_category_name').html(response.category_name);
          $('.imageid').val(response.category_id);
        }
      });
    }
  </script>
</body>

</html>