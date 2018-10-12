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
                    <div class="row">
                      <div class="col-md-6">
                        <button class="btn btn-primary btn-md add_cart" type="button"><span class="fa fa-plus"></span> Tambah Data</button>
                      </div>
                      <div class="col-md-6"> 
                        <button type="button" id="tambahOrder" data-target="#ModalTambahOrder" data-toggle="modal" class="btn btn-success btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
              
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
      </div>
    </div>
  </div>


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
                <th width="80px"><center>Kode Order</center></th>
                <th width="80px"><center>Tanggal Masuk</center></th>
                <th width="80px"> <center>Tanggal Keluar</center> </th>
                <th width="100px"> <center>Nama Pelanggan</center> </th>
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
              <input name="tgl_masuk" id="tgl_masuk_id" class="form-control" type="date" 
              value="<?php echo date('Y-m-d') ?>" style="width:335px;" required>
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
          <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
          <button class="btn btn-warning" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
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
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tag"></i> Detail Order / <span id="lempar_kode"></span></h4>
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
              <th align="center"><center>Jumlah Harga</center></th>
              <th align="center"><center>Status</center></th>
            </tr>
          </thead>
          <tbody id="detail_order2">
            
          </tbody>
        </table>

        </div>
        <div class="modal-footer">

          <button class="btn btn_proses btn-success" type="button"><i class="fa fa-hand-stop-o"></i> Ambil cucian</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END MODAL DETAIL -->

  <script type="text/javascript">
    $(document).ready(function(){

        $('#qty_id').keypress(function (event) {
            if (event.keyCode === 10 || event.keyCode === 13) {
                event.preventDefault();
            }
        });

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
                    $('#tambahOrder').slideDown( "slow" );
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
            $.ajax({
                type  : 'ajax',
                url   : "<?php echo base_url('order/data_order')?>",
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
                            '<td align="center">'+data[i].kd_order+'</td>'+
                            '<td align="center">'+data[i].tgl_masuk+'</td>'+
                            '<td align="center">'+data[i].tgl_keluar+'</td>'+
                            '<td align="center">'+data[i].nm_pelanggan+'</td>'+
                            '<td style="text-align:center;">'+
                              '<button data-target="javascript:;" class="btn btn-info order_detail" data="'+data[i].kd_order+'"><span class="fa fa-folder-open"></span></button>'+' '+
                              '<a href="<?php echo site_url('order/cetak/') ?>'+data[i].kd_order+'" target="_blank" class="btn btn-primary"><span class="fa fa-file-pdf-o"></span></a>'+' '+ 
                              '<a href="<?php echo site_url('order/proses/') ?>'+data[i].kd_order+'" class="btn btn-success order_proses" data="'+data[i].kd_order+'"><span class="fa fa-gears"></span></a>'+ 
                            '</td>'+
                        '</tr>';
                    }
                    $('#show_data').html(html);
                }
            });
        }

        //get Kode
        $("#tambahOrder").click(function(){ 

          //untuk validasi tombol simpan
          $.ajax({
            url  : "<?php echo base_url('ControllerOrder/cekCart')?>",
            dataType : "JSON",
            success: function(data){
              if(data == false){
                swal({
                  title: "Tidak Ada Data Yang Diproses",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
                return false;
              } else {

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
              }
            }
          });

            return false;
        });

        //GET UPDATE
        $('#show_data').on('click','.order_detail',function(){
          var kd_order = $(this).attr('data');
            $.ajax({
              type : "GET",
              url  : "<?php echo base_url('order/get_order')?>",
              dataType : "JSON",
              data : {kd_order:kd_order},
              success: function(data){
                $('#lempar_kode').text(kd_order);

                  var html = '';
                    var i;
                    no = 1;
                    for(i=0; i<data.length; i++){
                        html += 
                        '<div class="col-md-6">'+
                        '<table style="table-layout:fixed" class="table table-bordered ">'+
                          '<tbody>'+
                            '<tr>'+
                              '<td style="width: 100px">Nama</td>'+
                              '<td style="width: 10px">:</td>'+
                              '<td>'+data[i].nm_pelanggan+'</td>'+
                            '</tr>'+
                            '<tr>'+
                              '<td>Telepon</td>'+
                              '<td>:</td>'+
                              '<td>'+data[i].no_telp+'</td>'+
                            '</tr>'+
                            '<tr>'+
                              '<td>Alamat</td>'+
                              '<td>:</td>'+
                              '<td>'+data[i].alamat+'</td>'+
                            '</tr>'+
                          '</tbody>'+
                        '</table>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                          '<table style="table-layout:fixed" class="table table-bordered ">'+
                          '<tbody>'+
                            '<tr>'+
                              '<td style="width: 150px">Tanggal Masuk</td>'+
                              '<td style="width: 10px">:</td>'+
                              '<td>'+data[i].tgl_masuk+'</td>'+
                            '</tr>'+
                            '<tr>'+
                              '<td>Tanggal Keluar</td>'+
                              '<td>:</td>'+
                              '<td>'+data[i].tgl_keluar+'</td>'+
                            '</tr>'+
                          '</tbody>'+
                        '</table>'+
                      '</div>';
                    }
                    $('#detail_order1').html(html);


                    $.ajax({
                        type : "GET",
                        url  : "<?php echo base_url('order/get_detail_order')?>",
                        dataType : "JSON",
                        data : {kd_order:kd_order},
                        success: function(data){
                          var html = '';
                          var total = '';
                          var i;
                          no = 1;
                          for(i=0; i<data.length; i++){

                            //rupiah
                            var har = data[i].harga;
                            var reverse = har.toString().split('').reverse().join(''),
                                ribuan  = reverse.match(/\d{1,3}/g);
                                ribuan  = ribuan.join('.').split('').reverse().join('');

                            //rupiah ver2
                            var jml = data[i].jumlah;
                            var reverse2 = jml.toString().split('').reverse().join(''),
                                ribuan2  = reverse2.match(/\d{1,3}/g);
                                ribuan2  = ribuan2.join('.').split('').reverse().join('');

                            if(data[i].status == 0){
                              var status = "<p style='color:red;'>Sedang Diproses</p>";
                            } else {
                              var status = "Sudah Selesai";
                            }
                              html += 
                                '<tr>'+
                                  '<td><center>'+no++ +'.'+'</center></td>'+
                                  '<td><center>'+data[i].kd_jasa+'</center></td>'+
                                  '<td><center>'+data[i].nm_jasa+'</center></td>'+
                                  '<td><center>'+ribuan+'</center></td>'+
                                  '<td><center>'+data[i].satuan+'</center></td>'+
                                  '<td><center>'+ribuan2+'</center></td>'+
                                  '<td><center>'+status+'</center></td>'+
                                '</tr>';
                              total = data[i].total;
                          }

                          //rupiah
                          var reverse3 = total.toString().split('').reverse().join(''),
                              ribuan3  = reverse3.match(/\d{1,3}/g);
                              ribuan3  = ribuan3.join('.').split('').reverse().join('');
                          html +=
                                '<tr>'+
                                  '<td colspan="5"><center><b>TOTAL</b></center></td>'+
                                  '<td><center><b>'+ribuan3+'</b></center></td>'+
                                  '<td></td>'+
                                '</tr>';
                          $('#detail_order2').html(html);

                        }
                      });

                      $.ajax({
                          url : "<?php echo base_url('ControllerOrder/validasi_ambil/');?>",
                          method : "POST",
                          dataType: "JSON",
                          data : {kd_order : kd_order},
                          success :function(data){
                              if(data == "tidak"){
                                $('.btn_proses').hide();
                              } else {
                                $('.btn_proses').show();
                              } 
                          }
                      });

                  $('#ModalOrderDetail').modal('show');
              }
            });
            return false;
        });

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
                      data : {kd_jasa:id, kd_order:kd_order, satuan:qty, jumlah:price},
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

        //ambil cucian
        $('.btn_proses').on('click',function(){
          var kd_order = $('#lempar_kode').text();

          

          swal({
              title: "Anda Yakin?",
              text: "",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {

              if (willDelete) {

                $.ajax({
                  type : "POST",
                  url  : "<?php echo base_url('ControllerOrder/ambil')?>",
                  dataType : "JSON",
                  data : {kd_order: kd_order},
                  success: function(data){
                    tampil_data_order();
                    
                  }
                });

                swal({
                      title: "Berhasil Diproses",
                      text: "",
                      icon: "success",
                      button: "Ok !",
                    }).then(function() {
                      $('#ModalOrderDetail').modal('hide');
                    });
                
              } else {
                return false;
              }
            });
          
          return false;
        });
    });
</script> 