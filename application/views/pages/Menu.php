<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $page; ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#inputMenu">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Input Menu
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($item as $data) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->nama_menu ?></td>
                        <td><?php echo $data->nama_menu_group ?></td>
                        <td><?php echo $data->gross_amount ?></td>
                        <td style="width: 125px">
                            <img src="<?php echo base_url($data->gambar) ?>" class="img-thumbnail">
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?php echo base_url('index.php/menu/edit/'.$data->id_menu) ?>" class="btn btn-warning">
                                    <i class="fas fa-edit fa-sm"></i>
                                </a>
                                <a href="<?php echo base_url('index.php/menu/delete/'.$data->id_menu) ?>" class="btn btn-danger">
                                    <i class="fas fa-trash fa-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="inputMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo base_url('index.php/menu/store') ?>" method="post" enctype="multipart/form-data">
                <!-- <input type="hidden" name="id_menu" value=""> -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Menu</label>
                        <input type="text" name="nama_menu" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_group" class="form-control">
                            <option value="">--Kategori--</option>
                            <?php foreach ($grup as $key) { ?>
                                <option value="<?php echo $key->id_group ?>"><?php echo $key->nama_menu_group; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control">
                    </div>
                    <div class="custom-file">
                        <input type="file" name="photo_menu" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Upload Foto</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>