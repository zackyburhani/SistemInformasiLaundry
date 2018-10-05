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
          <a href="<?php echo site_url('order') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a> 
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

<style type="text/css">
  .modal-header .close {
  display:none;
}
</style>

<!-- MODAL DETAIL -->
<div class="modal fade" id="ModalOrderDetail" data-backdrop="static" data-keyboard="false" class="close" style=".close{display: none;}" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-gear"></i> Proses Cucian / <span id="kode_jasa"></span></h4>
      </div>
        <div class="modal-body">
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
                            <select class="form-control select2" name="nm_barang" style="width: 100%;" id="kd_barang_id">
                              <?php foreach($barang as $brg){ ?>
                                <option value="<?php echo $brg->kd_barang ?>"><?php echo $brg->nm_barang ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Item</label>
                          </div>
                          <div class="col-md-3">
                            <input type="number" name="item" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" required class="form-control" id="item_id">
                          </div>
                          <div class="col-md-3">
                            <div class="row">
                              <div class="col-md-12">
                                <button class="btn btn-block btn-primary btn-md add_cart_ver2" type="button"><span class="fa fa-plus"></span> Tambah Data</button>
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
                        <th align="center"><center>Kode Barang</center></th>
                        <th align="center"><center>Nama Barang</center></th>
                        <th align="center"><center>Stok</center></th>
                        <th align="center"><center>Jumlah / Item</center></th>
                        <th align="center"><center>Hapus</center></th>
                      </tr>
                    </thead>
                    <tbody id="detail_cart2">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn_tutup">Tutup</button>
          <button class="btn btn-success" id="btn_simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END MODAL DETAIL -->

  <script type="text/javascript">
    $(document).ready(function(){

        $('#show_data').on('click','.order_detail',function(){
          var kd_jasa = $(this).attr('data');
          var kd_order = $('#lempar_kode').text();
            $.ajax({
              type : "GET",
              url  : "<?php echo base_url('ControllerOrder/get_jasa')?>",
              dataType : "JSON",
              data : {kd_jasa:kd_jasa, kd_order:kd_order},
              success: function(data){
                  $("#kode_jasa").text(kd_jasa);
                  $('#ModalOrderDetail').modal('show');
              }
            });
            return false;
        });


        $('.add_cart_ver2').click(function(e){
            var kd_barang = $("#kd_barang_id").val();
            var item = $("#item_id").val();

             if (item == "") {
                swal({
                  title: "Item Harus Diisi",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
                e.preventDefault();
                return false;
            }

                    $.ajax({
                        url : "<?php echo base_url('ControllerOrder/add_to_cart_ver2');?>",
                        method : "POST",
                        data : {kd_barang: kd_barang, item: item},
                        success: function(data){
                            $('[name="item"]').val("");
                            $('#detail_cart2').html(data);
                        }
                    });

        });
 
        // Load shopping cart
        $('#detail_cart2').load("<?php echo base_url('ControllerOrder/load_cart_ver2');?>");
 
        //Hapus Item Cart
        $(document).on('click','.hapus_cart_ver2',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url('ControllerOrder/hapus_cart_ver2');?>",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart2').html(data);
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
                url   : "<?php echo base_url('ControllerOrder/get_detail_order_ver2')?>",
                async : false,
                dataType : 'json',
                data: {kd_order:kode_lempar},
                success : function(data){
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

        //Simpan jasa
        $('#btn_simpan').on('click',function(){
          
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url('ControllerOrder/load_detail_ver2')?>",
            dataType : "JSON",
            success: function(data){

              var kd_order = $('#lempar_kode').text();
              var kd_jasa = $("#kode_jasa").text();
              
              $.each(data,function(index,objek){
                var kd_barang = objek.kd_barang;
                var nm_barang = objek.nm_barang;
                var stok = objek.stok;
                var item = objek.item;

                $.ajax({
                  type : "POST",
                  url  : "<?php echo base_url('ControllerOrder/simpan_detail_ver2')?>",
                  dataType : "JSON",
                  data : {kd_barang:kd_barang, kd_order:kd_order, item:item, stok:stok, kd_order:kd_order, kd_jasa:kd_jasa},  
                });


              });

              swal({
                  title: "Berhasil Diproses",
                  text: "",
                  icon: "success",
                  button: "Ok !",
                }).then(function() {
                  $('#detail_cart2').load('<?php echo base_url('order/destroy') ?>');
              });
              $('#ModalOrderDetail').modal('hide');
              tampil_data_order();
            }
          });
          return false;
        });

        $('.btn_tutup').on('click',function(){
          $('#detail_cart2').load('<?php echo base_url('order/destroy') ?>');
          $('#ModalOrderDetail').modal('hide');
          return false;
        });

    });
</script> 