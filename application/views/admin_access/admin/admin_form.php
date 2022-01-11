<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" onKeyUp="checkPasswordStrength();" placeholder="Password" minlength="6" value="<?php echo $password; ?>" />
            <div id="password-strength-status" style="font-weight: bold"></div>
        </div>
        <div class="form-group">
            <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Telp" value="<?php echo $no_hp; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Foto <?php echo form_error('foto') ?></label>
            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
            <?php 
            if ($foto !== '') {
                ?>
                <div>
                    *) Gambar Sebelumnya <br>
                    <img src="image/user/<?php echo $foto ?>" style="width: 100px;height: 100px;">
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>
        <div class="form-group">
            <label for="varchar">Level <?php echo form_error('level') ?></label>
            <select class="form-control" name="level">
                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                <option value="admin">admin</option>
                <option value="assisten">Assisten Admin</option>
            </select>
        </div>
        <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('admin') ?>" class="btn btn-default">Cancel</a>
    </form>