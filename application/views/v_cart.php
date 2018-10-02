<!DOCTYPE html>
<html>
<head>
    <title>Shopping cart dengan codeigniter dan AJAX</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
    <script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery/dist/jquery.min.js')?>"></script>

    <!-- <script type="text/javascript" src="<?php echo base_url('assets/Login/vendor/bootstrap/js/bootstrap.js')?>"></script> -->
</head>
<body>
<div class="container"><br/>
    <h2>Shopping Cart Dengan Ajax dan Codeigniter</h2>
    <hr/>
    <div class="row">
        <div class="col-md-8">
            <h4>Produk</h4>
            <div class="row">
            <?php foreach ($data as $row) : ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h4><?php echo $row->nm_jasa;?></h4>
                            <div class="row">
                                <div class="col-md-7">
                                    <h4><?php echo 'Rp '.number_format($row->harga);?></h4>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" name="quantity" id="<?php echo $row->kd_jasa;?>" value="1" class="quantity form-control">
                                </div>
                            </div>
                            <button class="add_cart btn btn-success btn-block" data-produkid="<?php echo $row->kd_jasa;?>" data-produknama="<?php echo $row->nm_jasa;?>" data-produkharga="<?php echo $row->harga;?>">Add To Cart</button>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
                 
            </div>
 
        </div>
        <div class="col-md-4">
            <h4>Shopping Cart</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">
 
                </tbody>
                 
            </table>
        </div>
    </div>
</div>
 
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-2.2.3.min.js'?>"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script> -->
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var kd_jasa    = $(this).data("produkid");
            var nm_jasa  = $(this).data("produknama");
            var harga = $(this).data("produkharga");
            var quantity     = $('#' + kd_jasa).val();
            console.log(quantity);
            $.ajax({
                url : "<?php echo base_url('Cart/add_to_cart');?>",
                method : "POST",
                data : {kd_jasa: kd_jasa, nm_jasa: nm_jasa, harga: harga, quantity:quantity },
                success: function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
 
        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url();?>cart/load_cart");
 
        //Hapus Item Cart
        $(document).on('click','.hapus_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url();?>cart/hapus_cart",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>
</body>
</html>