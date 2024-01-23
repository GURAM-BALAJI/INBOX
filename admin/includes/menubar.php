<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo '../../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>
          <?php echo $admin['admin_name']; ?>
        </p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li><a href="../home/home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

      <li class="header">REQUESTS</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-phone"></i>
          <span>Contacts</span> <b style="color:RED;">
            <?php
            $conn = $pdo->open();
            foreach ($conn->query('SELECT COUNT(*) FROM contact WHERE contact_view=0') as $row) {
              if ($row['COUNT(*)'] != 0)
                echo $row['COUNT(*)'];
            }
            $pdo->close();
            ?>
          </b>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="../contact/contact.php"><i class="fa fa-eye-slash"></i> New Contact</a></li>
          <li><a href="../contact/contact_view.php"><i class="fa fa-eye"></i> Viewed Contact</a></li>
        </ul>
      </li>
      <li class="header">MANAGE</li>
      <li><a href="../users/users.php"><i class="fa fa-users"></i><span>Users</span></a></li>
      <li><a href="../orders/orders_histroy.php"><i class="fa fa-shopping-bag"></i><span>Orders History</span></a></li>
      <li><a href="../orders/orders.php"><i class="fa fa-shopping-cart"></i> <span>Present Orders</span></a></li>
      <li><a href="../items/items.php"><i class="fa fa-tasks"></i> <span>Active Items</span></a></li>
      <li><a href="../slogan/slogan.php"><i class="fa fa-comments-o"></i> <span>Slogan</span></a></li>
      <li><a href="../admin/admin.php"><i class="fa fa-grav"></i> <span>Admin</span></a></li>
      <li><a href="../message/message.php"><i class="fa fa-comment"></i> <span>Message</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>