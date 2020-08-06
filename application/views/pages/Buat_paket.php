<div class="row">


<!-- <a href="<?php // echo base_url('index.php/menu/autoIns') ?>" class="btn btn-primary">Tembak</a> -->


    <div class="col-xl-12 col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?php echo base_url('index.php/apriori/start') ?>" method="post">
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" name="min_sup" class="form-control" placeholder="Minimal Support" required>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="min_conf" class="form-control" placeholder="Minimal Confidence" required>
                </div>
              </div>
              
              <div class="">
                <button class="btn btn-primary" type="submit">Buat Paket</button>
              </div>

            </form> 
        </div>

      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Paket</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <tr>
                      <th></th>
                      <th>No.</th>
                      <th>Confidence</th>
                      <th>Tanggal</th>
                      <th></th>
                    </tr>
                </tr>
              </thead>
              <tfoot>
                    <tr>
                      <th></th>
                      <th>No.</th>
                      <th>Confidence</th>
                      <th>Tanggal</th>
                      <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($assoc as $data) {
                    ?>
                    <tr>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm open-AddBookDialog" data-toggle="modal" data-target="#inputPaket" data-id="<?php echo $data->id_assoc ?>">
                                    <i class="fas fa-plus fa-sm"></i>
                                </a>
                            </div>
                        </td>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->confidence ?></td>
                        <td><?php echo $data->tgl_assoc ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?php echo base_url('index.php/apriori/detail_assoc/'.$data->id_assoc) ?>" class="btn btn-warning">
                                    <i class="fas fa-info-circle fa-sm"></i>
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
    </div>

    <div class="col-xl-4 col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Detail Paket</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <tr>
                      <th>No.</th>
                      <th>Nama Menu</th>
                    </tr>
                </tr>
              </thead>
              <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Nama Menu</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($detail as $data) {
                        
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->nama_menu ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
          </div>
          
        </div>

      </div>
    </div>




    <div id="inputPaket" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Item Paket</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo base_url('index.php/apriori/input') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_assoc" id="bookId">
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="text" name="nama_menu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" id="exampleFormControlSelect1" required>
                            <option value="">-- Kategori --</option>
                            <?php foreach ($kategori as $key) { ?>
                              <option value="<?php echo $key->id_group ?>"><?php echo $key->nama_menu_group ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                          <label>Harga</label>
                          <input type="text" id="total_tod" name="harga" class="form-control" readonly>
                      </div>
                      <div class="col-sm-6">
                        <label>Discount</label>
                        <input type="text" name="disct_" class="form-control" required>
                      </div>
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

</div>