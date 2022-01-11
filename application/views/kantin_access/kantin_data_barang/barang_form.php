 <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" style="padding-left: 15px;padding-right: 15px;">
        <div class="form-group">
            <label for="varchar">Kode Produk/Barang <?php echo form_error('kode_barang') ?></label>
            <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" readonly/>
        </div>

        <div class="form-group">
            <label for="varchar">Nama Produk/Barang <?php echo form_error('nama_barang') ?></label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Makanan/Minuman/Barang" value="<?php echo $nama_barang; ?>" required/>
        </div>

        <div class="form-group">
            <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
            <select name="satuan" class="form-control" required>
                <option value="<?php echo $satuan; ?>"><?php echo $satuan; ?></option>
                <option value="Unit">Unit</option>
                <option value="Kotak">Kotak</option>
                <option value="Botol">Botol</option>
                <option value="Buah">Buah</option>
                <option value="Biji">Biji</option>
                <option value="Sachet">Sachet</option>
                <option value="Bungkus">Bungkus</option>
                <option value="Roll">Roll</option>
                <option value="PCS">PCS</option>
                <option value="Lembar">Lembar</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label for="int">Stok <?php echo form_error('stok') ?></label>
            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" min='1' required/>
        </div>
        
        <div class="form-group">
            <label for="varchar">Kategori <?php echo form_error('kategori') ?></label>
            <select class="form-control" name="kategori" required>
                <option value="<?php echo $kategori; ?>"><?php echo $kategori; ?></option>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
                <option value="barang">Barang</option>
            </select>
        </div>

        <div class="form-group">
            <label for="int">Harga Pokok<?php echo form_error('harga_pokok') ?></label>
            <input type="text" class="form-control" name="harga_pokok" id="harga_pokok" placeholder="Harga Pokok" value="<?php echo $harga_pokok; ?>" required/>
        </div>

        <div class="form-group">
            <label for="int">Harga Jual<?php echo form_error('harga_jual') ?></label>
            <input type="text" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga Jual" value="<?php echo $harga_jual; ?>" required/>
        </div>

        <div class="form-group">
            <label for="varchar">Foto Barang</label>
            <input type="file" class="form-control" name="foto_barang" placeholder="Foto Barang" id="foto_barang" value="<?php echo $foto_barang; ?>"/>
            <?php 
            if ($foto_barang !== '') {
                ?>
                <div>
                    *) Gambar Sebelumnya <br>
                    <img src="image/barang_view/<?php echo $foto_barang ?>" style="width: 100px;height: 100px;">
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>

        <div class="form-group">
            <label for="int">Pemilik<?php echo form_error('key_barang') ?></label>
            <input type="text" class="form-control" name="key_barang" id="id_own" placeholder="pemilik" value="<?php echo $this->session->userdata('kode_kantin'); ?>" readonly/>
        </div>

        <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('kantinui/data_barang') ?>" class="btn btn-secondary">Cancel</a>
    </form>