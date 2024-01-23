<?php include '../includes/session.php'; ?>
<?php include '../includes/header.php';?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Message
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage</li>
        <li class="active">Message</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
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
                <form action="message_edit.php" method="post">
              <?php 
                try{
                  $conn = $pdo->open();
                      $stmt = $conn->prepare("SELECT * FROM message");
                      $stmt->execute();
                      foreach($stmt as $row){ if($row['message_id']==1){?>
                       <h2>MESSAGE</h2>
                <textarea name="message" rols="10" cols="90"><?php echo $row['message'];?></textarea>
                       <?php } if($row['message_id']==2){?>
                 <h2>Message 2</h2>
                <textarea name="win" rols="10" cols="90"><?php echo $row['message'];?></textarea>
                <?php }
                if($row['message_id']==3){?>
                 <h2>Share Message</h2>
                <textarea name="share" rols="10" cols="90"><?php echo $row['message'];?></textarea>
                <?php } ?>
                     <?php }}catch(PDOException $e){
                      echo "Something Went Wrong.";
                    }

                    $pdo->close(); ?>
                    <br>
                    <input type="submit" name="save" value="Save" class='btn btn-success btn-sm edit btn-flat'>
                    </form>
            </div>
        </div>
      </div>
        </div>
        </div>
    </section>
     
  </div>

</div>
    <?php include '../includes/scripts.php'; ?>
<!-- ./wrapper -->
</body>
</html>