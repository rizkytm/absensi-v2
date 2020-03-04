<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List All Absen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Introduction to Total Success</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="<?= base_url('realtime') ?>">Realtime</a>
                <a class="p-2 text-dark" href="<?= base_url('absensi') ?>">List</a>
            </nav>
            <a class="btn btn-outline-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h2 class="text-center">List All Absen</h2>
            <h3 class="text-center" id="counter"></h3>
            <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#ModalAdd">Add New Product</button> -->
                <table id="mytable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Konfirmasi</th>
                            <th>Grup</th>
                            <th>Status</th>
                            <th>Waktu Kehadiran</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody class="show_product">
                        <?php $no = 1; foreach($peserta as $item) { ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $item->nama ?></td>
                            <td><?= $item->no_konfirmasi ?></td>
                            <td><?= $item->grup ?></td>
                            <td><?= $item->status ?></td>
                            <td><?= $item->presence_time ?></td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
    <!-- Modal Add New Product -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="input1">Product Name</label>
                <input type="text" name="product_name" class="form-control name" id="input1" placeholder="Product Name">
            </div>
            <div class="form-group">
                <label for="input2">Product Price</label>
                <input type="text" name="product_price" class="form-control price" id="input2" placeholder="Product Price">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-save">Save</button>
        </div>
        </div>
    </div>
    </div>
 
    <!-- Modal Edit Product -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="input1">Product Name</label>
                <input type="text" name="product_name" class="form-control name_edit" id="input1" placeholder="Product Name">
            </div>
            <div class="form-group">
                <label for="input2">Product Price</label>
                <input type="text" name="product_price" class="form-control price_edit" id="input2" placeholder="Product Price">
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="product_id" class="id_edit">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-edit">Edit</button>
        </div>
        </div>
    </div>
    </div>
 
    <!-- Modal Delete Product -->
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-info">
                Anda yakin mau menghapus data ini?
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="product_id" class="product_id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary btn-delete">Yes</button>
        </div>
        </div>
    </div>
    </div>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#mytable').DataTable();
            // CALL FUNCTION SHOW PRODUCT
            show_product();
            count_product();
 
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
 
            var pusher = new Pusher('93608c8bbd40b7be3d87', {
                cluster: 'ap1',
                forceTLS: true
            });
 
            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                if(data.message === 'success'){
                    show_product();
                    count_product();
                }
            });

            function count_product(){
                $.ajax({
                    url   : '<?php echo site_url("realtime/count_peserta");?>',
                    type  : 'GET',
                    async : true,
                    dataType : 'json',
                    success : function(data){

                        $.ajax({
                            url   : '<?php echo site_url("realtime/count_all_peserta");?>',
                            type  : 'GET',
                            async : true,
                            dataType : 'json',
                            success : function(result){

                                $('#counter').html(data + '/' + result);
                                
                            }
        
                        });

                    }
 
                });
            } 
 
            // FUNCTION SHOW PRODUCT
            function show_product(){
                $.ajax({
                    url   : '<?php echo site_url("absensi/get_peserta");?>',
                    type  : 'GET',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $('#mytable').DataTable().destroy();
                        $('#mytable').find('tbody').empty();
                        var html = '';
                        var count = 1;
                        var i;
                        // for(i=0; i<data.length; i++){
                        // $.each(data, function(index, element) {
                        //      $('#mytable').find('tbody').append('<tr>\ 
                        //             <td>' + count + '</td>\
                        //             <td>'+ element.nama +'</td>\
                        //             <td>'+ element.no_konfirmasi +'</td>\
                        //             <td>'+ element.presence_time +'</td>\
                                    
                                    //     '<a href="javascript:void(0);" class="btn btn-sm btn-info item_edit" data-id="'+ data[i].product_id +'" data-name="'+ data[i].product_name +'" data-price="'+ data[i].product_price +'">Edit</a>'+
                                    //     '<a href="javascript:void(0);" class="btn btn-sm btn-danger item_delete" data-id="'+ data[i].product_id +'">Delete</a>'+
                                    // '</td>'+
                                    // '</tr>';
                            // $('#nama_item').value = "Test";
                            // document.getElementById("nama_item").value = "Testing";
                        // }
                        // })


                        $.each(data, function(index, element) {
                            $('#mytable').find('tbody').append('<tr>\
                            <td>' + count + '</td>\
                            <td>' + element.nama + '</td>\
                            <td>' + element.no_konfirmasi + '</td>\
                            <td>' + element.grup + '</td>\
                            <td>' + element.status + '</td>\
                            <td>' + element.presence_time + '</td>\
                            </tr>\
                            ');

                            count += 1;
                            // $('#counter').html(data.length + '/' + );
                        })

                        $('#mytable').DataTable({
                            'lengthMenu': [
                                [10, 25, 50, -1],
                                [10, 25, 50, "All"]
                            ]
                        });
                        
                        // $('.show_product').html(html);
                    }
 
                });
            } 
 
            // CREATE NEW PRODUCT
            $('.btn-save').on('click',function(){
                var product_name = $('.name').val();
                var product_price = $('.price').val();
                $.ajax({
                    url    : '<?php echo site_url("product/create");?>',
                    method : 'POST',
                    data   : {product_name: product_name, product_price: product_price},
                    success: function(){
                        $('#ModalAdd').modal('hide');
                        $('.name').val("");
                        $('.price').val("");
                    }
                });
            });
            // END CREATE PRODUCT
 
            // UPDATE PRODUCT
            $('#mytable').on('click','.item_edit',function(){
                var product_id = $(this).data('id');
                var product_name = $(this).data('name');
                var product_price = $(this).data('price');
                $('#ModalEdit').modal('show');
                $('.id_edit').val(product_id);
                $('.name_edit').val(product_name);
                $('.price_edit').val(product_price);
            });
 
            $('.btn-edit').on('click',function(){
                var product_id = $('.id_edit').val();
                var product_name = $('.name_edit').val();
                var product_price = $('.price_edit').val();
                $.ajax({
                    url    : '<?php echo site_url("product/update");?>',
                    method : 'POST',
                    data   : {product_id: product_id, product_name: product_name, product_price: product_price},
                    success: function(){
                        $('#ModalEdit').modal('hide');
                        $('.id_edit').val("");
                        $('.name_edit').val("");
                        $('.price_edit').val("");
                    }
                });
            });
            // END EDIT PRODUCT
 
            // DELETE PRODUCT
            $('#mytable').on('click','.item_delete',function(){
                var product_id = $(this).data('id');
                $('#ModalDelete').modal('show');
                $('.product_id').val(product_id);
            });
 
            $('.btn-delete').on('click',function(){
                var product_id = $('.product_id').val();
                $.ajax({
                    url    : '<?php echo site_url("product/delete");?>',
                    method : 'POST',
                    data   : {product_id: product_id},
                    success: function(){
                        $('#ModalDelete').modal('hide');
                        $('.product_id').val("");
                    }
                });
            });
            // END DELETE PRODUCT
 
        });
    </script>
</body>
</html>