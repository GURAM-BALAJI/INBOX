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
                        Users
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Manage</li>
                        <li class="active">Users</li>
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
                                            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New User</a>
                                        </div>
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Phone</th>
                                                <th>Added Date</th>
                                                    <th>Tools</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $conn = $pdo->open();

                                                try {
                                                    $stmt = $conn->prepare("SELECT * FROM users WHERE user_delete=:user_delete");
                                                    $stmt->execute(['user_delete' => 0]);
                                                    foreach ($stmt as $row) {
                                                        $status = ($row['user_status']) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Not Active</span>';
                                                        $active = (!$row['user_status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="' . $row['user_id'] . '"><i class="fa fa-check-square-o"></i></a></span>' : '<span class="pull-right"><a href="#not_activate" class="status" data-toggle="modal" data-id="' . $row['user_id'] . '"><i class="fa fa-check-square-o"></i></a></span>';
                                                        echo "
                          <tr>
                          <td>" . $row['user_id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>
                              $status";
                                                            echo "$active";
                                                        echo "</td>";
                                                        echo "<td>" . $row['user_phone'] . "</td>";
                                                        echo "<td>" . date('M d Y', strtotime($row['user_added_date'])) . "</td>";
                                                      
                                                            echo "<td>";
                                                            echo "<button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['user_id'] . "'><i class='fa fa-edit'></i> Edit</button> ";
                                                        
                                                            echo "<button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['user_id'] . "'><i class='fa fa-trash'></i> Delete</button>";
                                                     
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

            </div>
            <?php include 'users_modal.php'; ?>

        </div>
        <!-- ./wrapper -->

        <?php include '../includes/scripts.php'; ?>
        <script>
            $(function() {


                $(document).on('click', '.edit', function(e) {
                    e.preventDefault();
                    $('#edit').modal('show');
                    var id = $(this).data('id');
                    getRow(id);
                });

                $(document).on('click', '.delete', function(e) {
                    e.preventDefault();
                    $('#delete').modal('show');
                    var id = $(this).data('id');
                    getRow(id);
                });


                $(document).on('click', '.status', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    getRow(id);
                });

            });

            function getRow(id) {
                $.ajax({
                    type: 'POST',
                    url: 'users_row.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.userid').val(response.user_id);
                        $('#edit_password').val(response.user_password);
                        $('#edit_name').val(response.name);
                        $('#edit_contact').val(response.user_phone);
                        $('.fullname').html(response.name);
                    }
                });
            }
        </script>
    </body>

</html>