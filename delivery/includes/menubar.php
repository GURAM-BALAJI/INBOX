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
    <ul class="sidebar-menu" data-widget="tree">
      <li><a href="../delivery_orders/delivery_orders.php"><i class="fa fa-motorcycle"></i> <span>Deliverys</span></a></li>
      <li><a href="../deliveried_orders/deliveried_orders.php"><i class="fa fa-check-circle"></i> <span>Deliveried</span></a></li>
      <li><a href="../not_deliveried_orders/not_deliveried_orders.php"><i class="fa fa-times-circle"></i> <span>Not Deliveried</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>