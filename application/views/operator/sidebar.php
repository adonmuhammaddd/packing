<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/Logo-Melcoinda.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->fungsi->user_login()->name?></p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('dashboard');?>">
            <i class="fa fa-bar-chart"></i> <span>Dashboard</span>
          </a>
        </li>
        <li <?= $this->uri->segment(1) == 'supplier' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('supplier');?>">
            <i class="fa fa-truck"></i> <span>Suppliers</span>
          </a>
        </li>
        <li class="treeview <?= $this->uri->segment(1) == 'packing' || $this->uri->segment(1) == 'kwh-static' || $this->uri->segment(1) == 'generateseri' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Packing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= $this->uri->segment(1) == 'packing' ? 'class="active"' : '' ?>><a href="<?= base_url('packing');?>"><i class="fa fa-dashboard"></i> kWh Prabayar</a></li>
            <li <?= $this->uri->segment(1) == 'kwh-static' ? 'class="active"' : '' ?>><a href="<?= base_url('kwh-static');?>"><i class="fa fa-tachometer"></i> kWh Static</a></li>
            <li <?= $this->uri->segment(1) == 'generateseri' ? 'class="active"' : '' ?>><a href="<?= base_url('generateseri');?>"><i class="fa fa-search"></i> Generate Seri</a></li>
          </ul>
        </li>
        <!-- <li class="treeview <?= $this->uri->segment(1) == 'sales' || $this->uri->segment(1) == 'stock/in' || $this->uri->segment(1) == 'stock/out' ? 'active' : '' ?>">
          <a href="<?= base_url('transaction');?>">
            <i class="fa fa-cart"></i>
            <span>Transaction</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= $this->uri->segment(1) == 'sales' ? 'class="active"' : '' ?>><a href="<?= base_url('sales');?>"><i class="fa fa-circle-o"></i> Sales</a></li>
            <li <?= $this->uri->segment(1) == 'stock/in' ? 'class="active"' : '' ?>><a href="<?= base_url('stock/in');?>"><i class="fa fa-circle-o"></i> Stock-In</a></li>
            <li <?= $this->uri->segment(1) == 'stock/out' ? 'class="active"' : '' ?>><a href="<?= base_url('stock/out');?>"><i class="fa fa-circle-o"></i> Stock-Out</a></li>
          </ul>
        </li> -->
        <li class="treeview">
          <a href="<?= base_url('reports');?>">
            <i class="fa fa-book"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <?php if ($this->fungsi->user_login()->level == 1 || $this->fungsi->user_login()->level == 0) { ?>
            <li class="header">Settings</li>
            <li><a href="<?= base_url('user');?>"><i class="fa fa-user"></i> <span>User</span></a></li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>