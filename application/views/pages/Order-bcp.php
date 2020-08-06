<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $page; ?></h1>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-8">
        <nav class="nav" style="width: 100%">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <a class="nav-link active" href="#">Active</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <a class="nav-link" href="#">Link</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <a class="nav-link active" href="#">Active</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <a class="nav-link" href="#">Link</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <h1 class="h3 text-gray-800"> > > > Minuman</h1>
        <div class="row">
            <?php
                foreach ($item as $data) {
                    if ($data->kategori == 1) {
            ?>
                        <div class="col-xl-3 mb-4">
                            <div class="card">
                                <img src="https://asset-a.grid.id/crop/0x0:0x0/700x465/photo/bolasport/medium_f2b219f03afae94e715751ec101912c3.jpg" class="card-img-top" alt="kopi">
                                <div class="card-body">
                                    <p class="card-title item-name"><?php echo $data->nama_menu; ?></p>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-outline-secondary btn-number" disabled="disabled" data-type="minus" data-field="<?php echo $data->kode ?>">-</button>
                                        </div>
                                        <input type="text" id="qty" name="<?php echo $data->kode ?>" class="form-control input-number" value="0" min="0" max="10">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus" data-field="<?php echo $data->kode ?>">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
        <h1 class="h3 text-gray-800"> > > > Cemilan</h1>
        <div class="row">
            <?php
                $no = 1;
                foreach ($item as $data) {
                    if ($data->kategori == 2) {
            ?>
                        <div class="col-xl-3 mb-4">
                            <div class="card">
                                <img src="https://asset-a.grid.id/crop/0x0:0x0/700x465/photo/bolasport/medium_f2b219f03afae94e715751ec101912c3.jpg" class="card-img-top" alt="kopi">
                                <div class="card-body">
                                    <p class="card-title item-name"><?php echo $data->nama_menu; ?></p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" id="minus-btn">-</button>
                                        </div>
                                        <input type="text" id="qty" name="qty" class="form-control input-qty" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="0" min="0">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="plus-btn">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h5>Detail Pesanan</h5>
            </div>
        </div>
    </div>
</div>