<div class="card">
    <div class="card-body">
        <form action="<?php echo base_url('index.php/kategori/update') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_group" value="<?php echo $item->id_group ?>">
            <div class="form-group">
                <label>Nama Menu Group</label>
                <input type="text" name="nama_menu_group" class="form-control" value="<?php echo $item->nama_menu_group ?>">
            </div>
            <div class="custom-file">
                <input type="file" name="photo_kat" class="custom-file-input" id="customFile" value="<?php echo $item->gambar_group ?>">
                <label class="custom-file-label" for="customFile"><?php echo $item->gambar_group ?></label>
            </div>
            <div style="width: 150px" class="my-3">
                <img src="<?php echo base_url($item->gambar_group) ?>" class="img-thumbnail">
            </div>
            <div class="form-group my-3">
                <button class="btn btn-primary" type="submit">Submit</button>
                <a class="btn btn-secondary" href="<?php echo base_url('index.php/kategori') ?>">Cancel</a>
            </div>
        </form>
    </div>
</div>