  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Order
        <small></small>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <label>Tambah Data Order</label>
            </div>
            <div class="panel-body">
              <div class="col-md-12">
                <form class="form-horizontal">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label class="control-label">Jasa</label>
                    </div>
                    <div class="col-md-4">
                      <select class="form-control" name="nm_jasa" id="kd_jasa_id">
                        <?php foreach($jasa as $jas){ ?>
                          <option value="<?php echo $jas->kd_jasa ?>"><?php echo $jas->nm_jasa ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-1">
                      <label class="control-label">Kilogram</label>
                    </div>
                    <div class="col-md-3">
                      <input type="number" name="qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" required class="form-control" id="qty_id">
                    </div>
                    <div class="col-md-3">
                      <button class="btn btn-primary btn-md btn-block add_cart" type="button"><span class="fa fa-plus"></span> Tambah Data</button>
                    </div>
                  </div>
                </div>
              </form>
              </div>
              <hr>
            </div>
           </div>
          </div>
        </div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <label>Detail Purchase Order</label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>Kode Jasa</center></th>
              <th align="center"><center>Nama Jasa</center></th>
              <th align="center"><center>Harga</center></th>
              <th align="center"><center>Jumlah / Kg</center></th>
              <th align="center"><center>Jumlah Harga</center></th>
              <th align="center"><center>Hapus</center></th>
            </tr>
          </thead>
          <tbody id="detail_cart">
              
          </tbody>
        </table>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-4"></div>
          <div class="col-md-3"></div>
          <div class="col-md-3">
            <button type="button" data-target="#ModalEntryPO" data-toggle="modal" class="btn btn-primary btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses Pesanan</button>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
    </section>
  </div>


  <script type="text/javascript">
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var kd_jasa = $("#kd_jasa_id").val();
            var qty = $("#qty_id").val();
            
            $.ajax({
                url : "<?php echo base_url('ControllerOrder/add_to_cart');?>",
                method : "POST",
                data : {kd_jasa: kd_jasa, qty: qty},
                success: function(data){
                    $('[name="qty"]').val("");
                    $('#detail_cart').html(data);
                }
            });
        });
 
        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url('ControllerOrder/load_cart');?>");
 
        //Hapus Item Cart
        $(document).on('click','.hapus_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url('ControllerOrder/hapus_cart');?>",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>