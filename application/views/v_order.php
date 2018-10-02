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
                      <select class="form-control select2" name="nm_jasa" id="kd_jasa_id">
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
            <button type="button" id="tambahOrder" data-target="#ModalTambahOrder" data-toggle="modal" class="btn btn-primary btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses Pesanan</button>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
    </section>
  </div>

<!-- MODAL ADD -->
<div class="modal fade" id="ModalTambahOrder" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Tambah Jasa</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label col-xs-3" >Kode Order</label>
            <div class="col-xs-9">
              <input name="kd_order" id="kd_order_id" readonly class="form-control" type="text" placeholder="Kode Order" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Tanggal Masuk</label>
            <div class="col-xs-9">
              <input name="tgl_masuk" id="tgl_masuk_id" class="form-control" type="date" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Tanggal Keluar</label>
            <div class="col-xs-9">
              <input name="tgl_keluar" id="tgl_keluar_id" class="form-control" type="date" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3">Nama Pelanggan</label>
            <div class="col-xs-9">  
              <select class="form-control select2" data-placeholder="Nama Pelanggan" name="nm_pelanggan" id="kd_pelanggan_id" style="width: 80%;">
                <option></option>
                <?php foreach($pelanggan as $plg){ ?>
                  <option value="<?php echo $plg->kd_pelanggan ?>"><?php echo $plg->nm_pelanggan ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
          <button class="btn btn-success" id="btn_simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL ADD-->  

  <script type="text/javascript">
    $(document).ready(function(){
        $('.add_cart').click(function(e){
            var kd_jasa = $("#kd_jasa_id").val();
            var qty = $("#qty_id").val();
            
             if (qty == "") {
                swal({
                  title: "Kilogram Harus Diisi",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
                e.preventDefault();
                return false;
            }

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

        //get Kode
        $("#tambahOrder").click(function(){
            $.ajax({
              type : "GET",
              url  : "<?php echo base_url('order/getKode')?>",
              dataType : "JSON",
              success: function(data){
                $.each(data,function(kd_order){
                  $('#ModalTambahOrder').modal('show');
                  $('[name="kd_order"]').val(data.kd_order);
                });
              }
            });
            return false;
        });

        tampil_data_jasa(); //pemanggilan fungsi tampil jasa.
    
        $('#dataJasa').dataTable();
         
        //fungsi tampil jasa
        function tampil_data_jasa(){
            $.ajax({
                type  : 'ajax',
                url   : "<?php echo base_url('jasa/data_jasa')?>",
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    no = 1;
                    for(i=0; i<data.length; i++){
                        html += 
                        '<tr>'+
                            '<td align="center">'+ no++ +'.'+'</td>'+
                            '<td>'+data[i].nm_jasa+'</td>'+
                            '<td align="center">'+data[i].harga+'</td>'+
                            '<td style="text-align:center;">'+
                              '<button data-target="javascript:;" class="btn btn-warning jasa_edit" data="'+data[i].kd_jasa+'"><span class="glyphicon glyphicon-edit"></span></button>'+' '+
                              '<button data-target="javascript:;" class="btn btn-danger jasa_hapus" data="'+data[i].kd_jasa+'"><span class="glyphicon glyphicon-trash"></span></button>'+
                            '</td>'+
                        '</tr>';
                    }
                    $('#show_data').html(html);
                }
            });
        }

        //GET UPDATE
        $('#show_data').on('click','.jasa_edit',function(){
          var kd_jasa = $(this).attr('data');
            $.ajax({
              type : "GET",
              url  : "<?php echo base_url('jasa/get_jasa')?>",
              dataType : "JSON",
              data : {kd_jasa:kd_jasa},
              success: function(data){
                $.each(data,function(kd_jasa, nm_jasa, harga){
                  $('#ModalEditJasa').modal('show');
                  $('[name="kd_jasa_edit"]').val(data.kd_jasa);
                  $('[name="nm_jasa_edit"]').val(data.nm_jasa);
                  $('[name="harga_edit"]').val(data.harga);
                });
              }
            });
            return false;
        });

        //GET HAPUS
        $('#show_data').on('click','.jasa_hapus',function(){
          var id = $(this).attr('data');
          $('#ModalHapusJasa').modal('show');
          $('[name="kode"]').val(id);
        });

        //Simpan jasa
        $('#btn_simpan').on('click',function(){
          var kd_jasa = $('#kd_jasa_id').val();
          var nm_jasa = $('#nm_jasa_id').val();
          var harga = $('#harga_id').val();
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url('jasa/simpan')?>",
            dataType : "JSON",
            data : {kd_jasa:kd_jasa, nm_jasa:nm_jasa, harga:harga},
            success: function(data){
              $('[name="kd_jasa"]').val("");
              $('[name="nm_jasa"]').val("");
              $('[name="harga"]').val("");
              $('#ModalTambahJasa').modal('hide');
              setTimeout(function() {
                  swal("Berhasil Disimpan", "", "success");
                      }, 600);
              tampil_data_jasa();
            }
          });
          return false;
        });

        //Update Jasa
        $('#btn_update').on('click',function(){
          var kd_jasa = $('#kd_jasa_id_edit').val();
          var nm_jasa = $('#nm_jasa_id_edit').val();
          var harga = $('#harga_id_edit').val();
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url('jasa/ubah')?>",
            dataType : "JSON",
            data : {kd_jasa:kd_jasa , nm_jasa:nm_jasa, harga:harga},
            success: function(data){
              $('[name="kd_jasa_edit"]').val("");
              $('[name="nm_jasa_edit"]').val("");
              $('[name="harga_edit"]').val("");
              $('#ModalEditJasa').modal('hide');
              setTimeout(function() {
                  swal("Berhasil Disimpan", "", "success");
                      }, 600);
              tampil_data_jasa();
            }
          });
          return false;
        });

        //Hapus Jasa
        $('#btn_hapus').on('click',function(){
          var kd_jasa = $('#textkode').val();
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url('jasa/hapus')?>",
            dataType : "JSON",
            data : {kd_jasa: kd_jasa},
            success: function(data){
              $('#ModalHapusJasa').modal('hide');
              tampil_data_jasa();
            }
          });
          return false;
        });
    });
</script>