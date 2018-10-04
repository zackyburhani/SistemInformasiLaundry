<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Proses / <span id="lempar_kode"><?php echo $kd_order ?></span>
      <small></small>
    </h1>
  </section>

  <section class="content">

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <label>Detail Order</label>
        </div>
        <div class="panel-body">
          <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataOrder">
            <thead>
              <tr>
                <th width="20px">No. </th>
                <th width="80px"><center>Kode Jasa</center></th>
                <th width="80px"><center>Nama Jasa</center></th>
                <th width="80px"> <center>Harga</center> </th>
                <th width="100px"> <center>Satuan</center> </th>
                <th width="100px"> <center>Jumlah</center> </th>
                <th width="100px"> <center>Action</center> </th>
              </tr>
            </thead>
            <tbody id="show_data">

            </tbody>
          </table>
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
        <h3 class="modal-title" id="myModalLabel">Tambah Order</h3>
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
              <select class="form-control select2" data-placeholder="Nama Pelanggan" name="kd_pelanggan" id="kd_pelanggan_id" style="width: 80%;">
                <option value=""></option>
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

<!-- MODAL DETAIL -->
<div class="modal fade" id="ModalOrderDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-gear"></i> Proses Cucian</h4>
      </div>
        <div class="modal-body">
        <div class="row" id="detail_order1">
          
        </div>
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>Kode Jasa</center></th>
              <th align="center"><center>Nama Jasa</center></th>
              <th align="center"><center>Harga</center></th>
              <th align="center"><center>Jumlah</center></th>
              <th align="center"><center>Jumlah Harga / Rp.</center></th>
            </tr>
          </thead>
          <tbody id="detail_order2">
            
          </tbody>
        </table>

        </div>
        <div class="modal-footer">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END MODAL DETAIL -->

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

        tampil_data_order(); //pemanggilan fungsi tampil order.
    
        $('#dataOrder').dataTable();

        //fungsi tampil jasa
        function tampil_data_order(){
        var kode_lempar = $('#lempar_kode').text();
            $.ajax({
                type  : 'GET',
                url   : "<?php echo base_url('order/get_detail_order')?>",
                async : false,
                dataType : 'json',
                data: {kd_order:kode_lempar},
                success : function(data){
                    console.log(data);
                    var html = '';
                    var i;
                    no = 1;
                    for(i=0; i<data.length; i++){
                        html += 
                        '<tr>'+
                            '<td align="center">'+ no++ +'.'+'</td>'+
                            '<td align="center">'+data[i].kd_jasa+'</td>'+
                            '<td align="center">'+data[i].nm_jasa+'</td>'+
                            '<td align="center">'+data[i].harga+'</td>'+
                            '<td align="center">'+data[i].satuan+'</td>'+
                            '<td align="center">'+data[i].jumlah+'</td>'+
                            '<td style="text-align:center;">'+
                              '<button data-target="javascript:;" class="btn btn-danger order_detail" data="'+data[i].kd_jasa+'"><span class="fa fa-gear"></span> Proses Cucian</button>'+' '+
                            '</td>'+
                        '</tr>';
                    }
                    $('#show_data').html(html);
                }
            });
        }

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

        $('#show_data').on('click','.order_detail',function(){
          var kd_jasa = $(this).attr('data');
          var kd_order = $('#lempar_kode').text();
            $.ajax({
              type : "GET",
              url  : "<?php echo base_url('ControllerOrder/get_jasa')?>",
              dataType : "JSON",
              data : {kd_jasa:kd_jasa, kd_order:kd_order},
              success: function(data){
      
                  var html = '';
                    var i;
                    no = 1;
                    for(i=0; i<data.length; i++){
                      html +=
                        '<div class="col-lg-12">'+
                          '<div class="panel panel-default">'+
                            '<div class="panel-heading">'+
                              '<label>Tambah Data Order</label>'+
                            '</div>'+
                            '<div class="panel-body">'+
                              '<div class="col-md-12">'+
                                '<form class="form-horizontal">'+
                                '<div class="form-group">'+
                                  '<div class="row">'+
                                    '<div class="col-md-1">'+
                                      '<label class="control-label">Jasa</label>'+
                                    '</div>'+
                                    '<div class="col-md-4">'+
                                      '<select class="form-control select2" name="nm_jasa" id="kd_jasa_id">'+
                                        '<?php foreach($barang as $brg){ ?>'+
                                          '<option value="<?php echo $brg->kd_barang ?>">'+
                                            '<?php echo $brg->nm_barang ?>'+
                                          '</option>'+
                                        '<?php } ?>'+
                                      '</select>'+
                                    '</div>'+
                                    '<div class="col-md-1">'+
                                      '<label class="control-label">Kilogram</label>'+
                                    '</div>'+
                                    '<div class="col-md-3">'+
                                      '<input type="number" name="qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '+').replace(/(\..*)\./g, '+'$1'+');" min="1" required class="form-control" id="qty_id">'+
                                    '</div>'+
                                    '<div class="col-md-3">'+
                                      '<div class="row">'+
                                        '<div class="col-md-6">'+
                                          '<button class="btn btn-primary btn-md add_cart" type="button"><span class="fa fa-plus"></span> Tambah Data</button>'+
                                        '</div>'+
                                        '<div class="col-md-6">'+
                                          '<button type="button" id="tambahOrder" data-target="#ModalTambahOrder" data-toggle="modal" class="btn btn-success btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses</button>'+
                                        '</div>'+
                                      '</div>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                              '</form>'+
                            '</div>'+
                                
                            '<table style="table-layout:fixed" class="table table-striped table-bordered table-hover">'+
                              '<thead>'+
                                '<tr>'+
                                  '<th align="center" width="50px">No. </th>'+
                                  '<th align="center"><center>Kode Jasa</center></th>'+
                                  '<th align="center"><center>Nama Jasa</center></th>'+
                                  '<th align="center"><center>Harga</center></th>'+
                                  '<th align="center"><center>Jumlah / Kg</center></th>'+
                                  '<th align="center"><center>Jumlah Harga</center></th>'+
                                  '<th align="center"><center>Hapus</center></th>'+
                                '</tr>'+
                              '</thead>'+
                              '<tbody id="detail_cart">'+
                                
                              '</tbody>'+
                            '</table>'+
                          '</div>'+
                        '</div>'+
                    '</div>'; 
                        
                    }
                    $('#detail_order1').html(html);

                  $('#ModalOrderDetail').modal('show');
              }
            });
            return false;
        });

        //GET HAPUS
        // $('#show_data').on('click','.order_hapus',function(){
        //   var id = $(this).attr('data');
        //   $('#ModalHapusOrder').modal('show');
        //   $('[name="kode"]').val(id);
        // });

        //Simpan jasa
        $('#btn_simpan').on('click',function(){
          var kd_order = $('#kd_order_id').val();
          var tgl_masuk = $('#tgl_masuk_id').val();
          var tgl_keluar = $('#tgl_keluar_id').val();
          var kd_pelanggan = $('#kd_pelanggan_id').val();

          if(tgl_masuk > tgl_keluar){
            alert('tidak valid');
            return false
          }

          $.ajax({
            type : "POST",
            url  : "<?php echo base_url('order/simpan')?>",
            dataType : "JSON",
            data : {kd_order:kd_order, tgl_masuk:tgl_masuk, tgl_keluar:tgl_keluar, kd_pelanggan:kd_pelanggan},
            success: function(data){
              $('[name="kd_order"]').val("");
              $('[name="tgl_masuk"]').val("");
              $('[name="tgl_keluar"]').val("");
              $('[name="kd_pelanggan"]').val("");
              $('#ModalTambahOrder').modal('hide');
              

              $.ajax({
                type : "GET",
                url  : "<?php echo base_url('ControllerOrder/load_detail')?>",
                dataType : "JSON",
                success: function(data){
                  var array = [];
                  $.each(data,function(index,objek){
                    var id = objek.id;
                    var qty = objek.qty;
                    var price = objek.price;
                    // array.push = [id,qty,price];
                    
                    $.ajax({
                      type : "POST",
                      url  : "<?php echo base_url('order/simpan_detail')?>",
                      dataType : "JSON",
                      data : {kd_jasa:id, kd_pelanggan:kd_pelanggan, satuan:qty, jumlah:price},
                    }); 

                  });
                }
              });  

              swal({
                  title: "Berhasil Disimpan",
                  text: "",
                  icon: "success",
                  button: "Ok !",
                }).then(function() {
                  $('#detail_cart').load('<?php echo base_url('order/destroy') ?>');
                });
              tampil_data_order();
            }
          });
          return false;
        });

        //Hapus Jasa
        // $('#btn_hapus').on('click',function(){
        //   var kd_jasa = $('#textkode').val();
        //   $.ajax({
        //     type : "POST",
        //     url  : "<?php echo base_url('jasa/hapus')?>",
        //     dataType : "JSON",
        //     data : {kd_jasa: kd_jasa},
        //     success: function(data){
        //       $('#ModalHapusJasa').modal('hide');
        //       tampil_data_order();
        //     }
        //   });
        //   return false;
        // });
    });
</script> 