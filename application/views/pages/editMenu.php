<div class="card">
    <div class="card-body">
        <form action="<?php echo base_url('index.php/menu/update') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_menu" value="<?php echo $item->id_menu ?>">
            <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" value="<?php echo $item->nama_menu ?>">
            </div>
            <div class="form-group">
                <label>Kode</label>
                <select name="id_group" class="form-control">
                    <option value="<?php echo $item->id_group ?>"><?php echo $item->nama_menu_group; ?></option>
                    <option value="">--Kategori--</option>
                    <?php foreach ($grup as $key) { ?>
                        <option value="<?php echo $key->id_group ?>"><?php echo $key->nama_menu_group; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?php echo $item->harga ?>">
            </div>
            <div class="custom-file">
                <input type="file" name="photo_menu" class="custom-file-input" id="customFile" value="<?php echo $item->gambar ?>">
                <label class="custom-file-label" for="customFile"><?php echo $item->gambar ?></label>
            </div>
            <div style="width: 150px" class="my-3">
                <img src="<?php echo base_url($item->gambar) ?>" class="img-thumbnail">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <a class="btn btn-secondary" href="<?php echo base_url('index.php/menu') ?>">Cancel</a>
        </form>
    </div>
</div>