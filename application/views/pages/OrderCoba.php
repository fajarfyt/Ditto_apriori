<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $page; ?></h1>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-8">
        <!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div> -->


        <div class="owl-carousel owl-theme">
            <?php foreach ($kategori as $kat) { ?>
            <ul class="item nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-<?php echo $kat->id_group ?>" role="tab" aria-controls="pills-home" aria-selected="true">
                        <div class="card bg-dark text-white">
                            <img src="<?php echo base_url($kat->gambar_group) ?>" class="card-img" alt="card-img">
                            <div class="card-img-overlay">
                                <h5 class="card-title" style="color: white"><?php echo $kat->nama_menu_group; ?></h5>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- <div class="item">
                <div class="card bg-dark text-white">
                    <img src="<?php //echo base_url($kat->gambar_group) ?>" class="card-img" alt="card-img">
                    <div class="card-img-overlay">
                        <a class="nav-link active" href="#">
                            <h5 class="card-title" style="color: white"><?php //echo $kat->nama_menu_group; ?></h5>
                        </a>
                    </div>
                </div>
            </div> -->
            <?php } ?>
        </div>

        
        
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show" id="pills-1" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                    <?php 
                    foreach ($item as $row){ 
                        if ($row->id_group == 1) {?>
                            <div class="col-3">
                                <div class="card my-1">
                                    <img src="https://asset-a.grid.id/crop/0x0:0x0/700x465/photo/bolasport/medium_f2b219f03afae94e715751ec101912c3.jpg" class="card-img-top" alt="Image">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size:1.3vw;"><?php echo $row->nama_menu;?></h5>
                                        <div class="row">
                                            <div class="col-md-7 my-auto">
                                                <h5 style="font-size:1vw;"><?php echo number_format($row->harga);?></h5>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="number" name="quantity" id="<?php echo $row->id_menu;?>" value="1" class="quantity form-control">
                                            </div>
                                        </div>
                                        <button class="add_cart btn btn-success btn-block my-1" data-productid="<?php echo $row->id_menu;?>" data-productname="<?php echo $row->nama_menu;?>" data-productprice="<?php echo $row->harga;?>">Add</button>
                                    </div>
                                </div>
                            </div>
                    <?php }} ?>
                    </div>
                </div>
                <div class="tab-pane fade show" id="pills-2" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                    <?php 
                    foreach ($item as $row){ 
                        if ($row->id_group == 2) {?>
                            <div class="col-3">
                                <div class="card my-1">
                                    <img src="https://asset-a.grid.id/crop/0x0:0x0/700x465/photo/bolasport/medium_f2b219f03afae94e715751ec101912c3.jpg" class="card-img-top" alt="Image">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size:1.3vw;"><?php echo $row->nama_menu;?></h5>
                                        <div class="row">
                                            <div class="col-md-7 my-auto">
                                                <h5 style="font-size:1vw;"><?php echo number_format($row->harga);?></h5>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="number" name="quantity" id="<?php echo $row->id_menu;?>" value="1" class="quantity form-control">
                                            </div>
                                        </div>
                                        <button class="add_cart btn btn-success btn-block my-1" data-productid="<?php echo $row->id_menu;?>" data-productname="<?php echo $row->nama_menu;?>" data-productprice="<?php echo $row->harga;?>">Add</button>
                                    </div>
                                </div>
                            </div>
                    <?php }} ?>
                    </div>
                </div>
            </div>
            
            <!-- <?php //foreach ($item as $row) : ?>
                <div class="col-md-3">
                    <div class="card my-1">
                        <img src="https://asset-a.grid.id/crop/0x0:0x0/700x465/photo/bolasport/medium_f2b219f03afae94e715751ec101912c3.jpg" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size:1.3vw;"><?php //echo $row->nama_menu;?></h5>
                            <div class="row">
                                <div class="col-md-7 my-auto">
                                    <h5 style="font-size:1vw;"><?php //echo number_format($row->harga);?></h5>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" name="quantity" id="<?php //echo $row->id_menu;?>" value="1" class="quantity form-control">
                                </div>
                            </div>
                            <button class="add_cart btn btn-success btn-block my-1" data-productid="<?php //echo $row->id_menu;?>" data-productname="<?php //echo $row->nama_menu;?>" data-productprice="<?php //echo $row->harga;?>">Add</button>
                        </div>
                    </div>
                </div>
            <?php //endforeach;?> -->
    </div>
    <div class="col-4">
        <div class="shop-cart">
            <h4>Detail Pesanan</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">

                </tbody>
                 
            </table>
        </div>
    </div>
</div>