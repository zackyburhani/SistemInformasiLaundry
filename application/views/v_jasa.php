  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Jasa
        <small></small>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <button class="btn btn-info" id="tambahJasa" data-toggle="modal" href="#" data-target="#ModalTambahJasa"><i class="fa fa-plus"></i> Tambah Data Jasa</button>
            </div>
            <div class="panel-body">
      
              <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataJasa">
                <thead>
                  <tr>
                    <th width="50px">No. </th>
                    <th><center>Nama Jasa</center></th>
                    <th width="200px"><center>Harga</center></th>
                    <th width="150px"> <center>Action</center> </th>
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
<div class="modal fade" id="ModalTambahJasa" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Tambah Jasa</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label col-xs-3" >Kode Jasa</label>
            <div class="col-xs-9">
              <input name="kd_jasa" id="kd_jasa_id" readonly class="form-control" type="text" placeholder="Kode Jasa" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Jasa</label>
            <div class="col-xs-9">
              <input name="nm_jasa" id="nm_jasa_id" class="form-control" type="text" placeholder="Nama Jasa" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Harga</label>
            <div class="col-xs-9">
              <input name="harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="harga_id" class="form-control" type="number" min="0" placeholder="Harga" style="width:335px;" required>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
          <button class="btn btn-primary" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL ADD-->


<!-- MODAL EDIT -->
<div class="modal fade" id="ModalEditJasa" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Ubah Jasa</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label col-xs-3" >Kode Jasa</label>
            <div class="col-xs-9">
              <input name="kd_jasa_edit" id="kd_jasa_id_edit" class="form-control" type="text" placeholder="Kode Jasa" style="width:335px;" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Jasa</label>
            <div class="col-xs-9">
              <input name="nm_jasa_edit" id="nm_jasa_id_edit" class="form-control" type="text" placeholder="Nama Jasa" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Harga</label>
            <div class="col-xs-9">
              <input name="harga_edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="harga_id_edit" class="form-control" type="number" placeholder="Harga" style="width:335px;" required>
            </div>
          </div>


        </div>

        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
          <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL EDIT-->

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapusJasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Jasa</h4>
      </div>
      <form class="form-horizontal">
      
        <div class="modal-body">              
          <input type="hidden" name="kode" id="textkode" value="">
            <p>Apakah Anda yakin mau menghapus ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!--END MODAL HAPUS-->

<script type="text/javascript">
    $(document).ready(function(){
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

                    var har = data[i].harga;
                    var reverse = har.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');

                    html += 
                    '<tr>'+
                        '<td align="center">'+ no++ +'.'+'</td>'+
                        '<td>'+data[i].nm_jasa+'</td>'+
                        '<td align="center">'+ribuan+'</td>'+
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

    //get Kode
    $("#tambahJasa").click(function(){
        $.ajax({
          type : "GET",
          url  : "<?php echo base_url('jasa/getKode')?>",
          dataType : "JSON",
          success: function(data){
            $.each(data,function(kd_jasa){
              $('#ModalTambahJasa').modal('show');
              $('[name="kd_jasa"]').val(data.kd_jasa);
            });
          }
        });
        return false;
    });

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

 