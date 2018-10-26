  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img style="background-color: white; padding: 10px 5px 10px 5px;" src="<?php echo base_url('assets/img/logo.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->username ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Administrator</a>
        </div>
      </div>
      
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-asterisk"></i> MAIN NAVIGATION</li>
        <li>
          <a href="<?php echo site_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('pelanggan') ?>">
            <i class="fa fa-users"></i>
            <span>Data Pelanggan</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('barang') ?>">
            <i class="fa fa-cube"></i>
            <span>Data Barang</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('jasa') ?>">
            <i class="fa fa-file-text"></i>
            <span>Data Jasa</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('petugas') ?>">
            <i class="fa fa-user"></i>
            <span>Data Petugas</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('order') ?>">
            <i class="fa fa-envelope"></i>
            <span>Order Cucian</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url('laporan_pendapatan') ?>">
                <i class="fa fa-circle-o"></i> <span>Laporan Pendapatan</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('laporan_jasa') ?>">
                <i class="fa fa-circle-o"></i> <span>Laporan Jasa</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('laporan_stok') ?>">
                <i class="fa fa-circle-o"></i> <span>Laporan Stok</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="header"></li>
        <li>
          <a href="<?php echo site_url('login/logout') ?>">
            <i class="fa fa-sign-out"></i>
            <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>