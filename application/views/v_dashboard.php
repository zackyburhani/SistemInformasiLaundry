  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Main content -->
    <section class="content">
      <!--START CONTENT LABEL-->
      <div class="bs-callout bs-callout-success">
        <br>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $pelanggan ?></h3>
              <p>Data Pelanggan</p>
            </div>
            <div class="icon">
              <i class="fa fa-users fa-fw"></i>
            </div>
            <a href="<?php echo site_url('pelanggan') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $barang ?></h3>
              <p>Data Barang</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="<?php echo site_url('barang') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $jasa ?></h3>
              <p>Data Jasa</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="<?php echo site_url('jasa') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- right col -->
  </div>
  <!-- /.content-wrapper -->