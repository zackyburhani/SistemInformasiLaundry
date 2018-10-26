  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Petugas
        <small></small>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <button class="btn btn-info" id="tambahPetugas" data-toggle="modal" href="#" data-target="#ModalTambahPetugas"><i class="fa fa-plus"></i> Tambah Data Petugas</button>
            </div>
            <div class="panel-body">
      
              <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataPetugas">
                <thead>
                  <tr>
                    <th width="50px">No. </th>
                    <th><center>Nama Petugas</center></th>
                    <th width="150px"><center>Telepon</center></th>
                    <th><center>Alamat</center></th>
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
<div class="modal fade" id="ModalTambahPetugas" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Tambah Petugas</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label col-xs-3">Username</label>
            <div class="col-xs-9">
              <input name="username" id="username_id" class="form-control" type="text" placeholder="Username" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3">Password</label>
            <div class="col-xs-9">
              <input name="password" id="password_id" class="form-control" type="password" placeholder="Password" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3">Ulangi Password</label>
            <div class="col-xs-9">
              <input name="repassword" id="repassword_id" class="form-control" type="password" placeholder="Konfirmasi Password" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Petugas</label>
            <div class="col-xs-9">
              <input name="nm_petugas" id="nm_petugas_id" class="form-control" type="text" placeholder="Nama Petugas" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nomor Telepon</label>
            <div class="col-xs-9">
              <input name="no_telp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="no_telp_id" class="form-control" type="text" placeholder="Nomor Telepon" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Alamat</label>
            <div class="col-md-8">
              <textarea name="alamat" id="alamat_id" rows="4" cols="5" placeholder="Alamat" class="form-control"></textarea>
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
<div class="modal fade" id="ModalEditPetugas" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Ubah Pelanggan</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label col-xs-3">Username</label>
            <div class="col-xs-9">
              <input name="username_edit" id="username_id_edit" class="form-control" type="text" placeholder="Username" style="width:335px;" readonly required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3">Password</label>
            <div class="col-xs-9">
              <input name="password_edit" id="password_id_edit" class="form-control" type="password" placeholder="Password" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3">Ulangi Password</label>
            <div class="col-xs-9">
              <input name="repassword_edit" id="repassword_id_edit" class="form-control" type="password" placeholder="Ulangi Password" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Petugas</label>
            <div class="col-xs-9">
              <input name="nm_petugas_edit" id="nm_petugas_id_edit" class="form-control" type="text" placeholder="Nama Petugas" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nomor Telepon</label>
            <div class="col-xs-9">
              <input name="no_telp_edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="no_telp_id_edit" class="form-control" type="text" placeholder="Nomor Telepon" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Alamat</label>
            <div class="col-md-8">
              <textarea name="alamat_edit" id="alamat_id_edit" rows="4" cols="5" placeholder="Alamat" class="form-control"></textarea>
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
<div class="modal fade" id="ModalHapusPetugas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Petugas</h4>
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
    tampil_data_petugas(); //pemanggilan fungsi tampil petugas.
    
    $('#dataPetugas').dataTable();
     
    //fungsi tampil barang
    function tampil_data_petugas(){
        $.ajax({
            type  : 'ajax',
            url   : "<?php echo base_url('petugas/data_petugas')?>",
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
                        '<td>'+data[i].nm_petugas+'</td>'+
                        '<td>'+data[i].no_telp+'</td>'+
                        '<td>'+data[i].alamat+'</td>'+
                        '<td style="text-align:center;">'+
                          '<button data-target="javascript:;" class="btn btn-warning petugas_edit" data="'+data[i].username+'"><span class="glyphicon glyphicon-edit"></span></button>'+' '+
                          '<button data-target="javascript:;" class="btn btn-danger petugas_hapus" data="'+data[i].username+'"><span class="glyphicon glyphicon-trash"></span></button>'+
                        '</td>'+
                    '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //GET UPDATE
    $('#show_data').on('click','.petugas_edit',function(){
      var username = $(this).attr('data');
        $.ajax({
          type : "GET",
          url  : "<?php echo base_url('petugas/get_petugas')?>",
          dataType : "JSON",
          data : {username:username},
          success: function(data){
            $.each(data,function(username, nm_petugas, no_telp, alamat){
              $('#ModalEditPetugas').modal('show');
              $('[name="username_edit"]').val(data.username);
              $('[name="nm_petugas_edit"]').val(data.nm_petugas);
              $('[name="no_telp_edit"]').val(data.no_telp);
              $('[name="alamat_edit"]').val(data.alamat);
            });
          }
        });
        return false;
    });

    //GET HAPUS
    $('#show_data').on('click','.petugas_hapus',function(){
      var id = $(this).attr('data');
      $('#ModalHapusPetugas').modal('show');
      $('[name="kode"]').val(id);
    });

    //Simpan Barang
    $('#btn_simpan').on('click',function(){
      var username = $('#username_id').val();
      var password = $('#password_id').val();
      var repassword = $('#repassword_id').val();
      var nm_petugas = $('#nm_petugas_id').val();
      var no_telp = $('#no_telp_id').val();
      var alamat = $('#alamat_id').val();

      if(username == "" || password == "" || repassword == "" || nm_petugas == "" || no_telp == "" || alamat == ""){
        swal({
          title: "Field Tidak Boleh Kosong",
          text: "",
          icon: "error",
          button: "Ok !",
        });
        return false; 
      }

      if(password != repassword){
        swal({
          title: "Password Tidak Sama",
          text: "",
          icon: "error",
          button: "Ok !",
        });
        return false;
      }

      $.ajax({
          type : "GET",
          url  : "<?php echo base_url('petugas/get_petugas')?>",
          dataType : "JSON",
          data : {username:username},
          success: function(data){
            if(data != null){
              swal({
                title: "Username Sudah Ada",
                text: "",
                icon: "error",
                button: "Ok !",
              });
              return false;       
            } else {
              $.ajax({
                type : "POST",
                url  : "<?php echo base_url('petugas/simpan')?>",
                dataType : "JSON",
                data : {username:username, password:password, nm_petugas:nm_petugas, no_telp:no_telp, alamat:alamat},
                success: function(data){
                  $('[name="username"]').val("");
                  $('[name="password"]').val("");
                  $('[name="repassword"]').val("");
                  $('[name="nm_petugas"]').val("");
                  $('[name="no_telp"]').val("");
                  $('[name="alamat"]').val("");
                  $('#ModalTambahPetugas').modal('hide');
                  setTimeout(function() {
                      swal("Berhasil Disimpan", "", "success");
                          }, 600);
                  tampil_data_petugas();
                }
              });      
            }
          }
        });
      return false;   
    });

    //Update Barang
    $('#btn_update').on('click',function(){
      var username = $('#username_id_edit').val();
      var password = $('#password_id_edit').val();
      var repassword = $('#repassword_id_edit').val();
      var nm_petugas = $('#nm_petugas_id_edit').val();
      var no_telp = $('#no_telp_id_edit').val();
      var alamat = $('#alamat_id_edit').val();
      
      if(password != repassword){
        swal({
          title: "Password Tidak Sama",
          text: "",
          icon: "error",
          button: "Ok !",
        });
        return false;
      }
      
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('petugas/ubah')?>",
        dataType : "JSON",
        data : {username:username,password:password,nm_petugas:nm_petugas, no_telp:no_telp, alamat:alamat},
        success: function(data){
          $('[name="username_edit"]').val("");
          $('[name="password_edit"]').val("");
          $('[name="repassword_edit"]').val("");
          $('[name="nm_petugas_edit"]').val("");
          $('[name="no_telp_edit"]').val("");
          $('[name="no_alamat_edit"]').val("");
          $('#ModalEditPetugas').modal('hide');
          setTimeout(function() {
              swal("Berhasil Disimpan", "", "success");
                  }, 600);
          tampil_data_petugas();
        }
      });
      return false;
    });

    //Hapus Petugas
    $('#btn_hapus').on('click',function(){
      var username = $('#textkode').val();
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('petugas/hapus')?>",
        dataType : "JSON",
        data : {username: username},
        success: function(data){
          $('#ModalHapusPetugas').modal('hide');
          tampil_data_petugas();
        }
      });
      return false;
    });

  });
</script>

 