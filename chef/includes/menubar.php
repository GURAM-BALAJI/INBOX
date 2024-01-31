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
      <!-- <li><a href="../orders/orders.php"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li> -->
      <li><a href="../accepted_orders/accepted_orders.php"><i class="fa fa-check-circle"></i> <span>Orders</span></a></li>
      <!-- <li><a href="../not_accepted_orders/not_accepted_orders.php"><i class="fa fa-times-circle "></i> <span>Not Accepted Orders</span></a></li> -->
      <li><a href="../items_active/items_active.php"><i class="fa fa-tasks"></i> <span>Active Items</span></a></li>
      <li><a href="../items/items.php"><i class="fa fa-tasks"></i> <span>Items</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>