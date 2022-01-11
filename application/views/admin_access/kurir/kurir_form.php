<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">NIS Kurir <?php echo form_error('nis_kurir') ?></label>
            <input type="text" class="form-control" name="nis_kurir" id="nis_kurir" placeholder="NIS Kurir" value="<?php echo $nis_kurir; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Kurir <?php echo form_error('nama_kurir') ?></label>
            <input type="text" class="form-control" name="nama_kurir" id="nama_kurir" placeholder="Nama Kurir" value="<?php echo $nama_kurir; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">No Hp <?php echo form_error('no_hp_kurir') ?></label>
            <input type="text" class="form-control" name="no_hp_kurir" id="no_hp_kurir" placeholder="No Hp Kurir" value="<?php echo $no_hp_kurir; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email_kurir') ?></label>
            <input type="text" class="form-control" name="email_kurir" id="email_kurir" placeholder="Email Kurir" value="<?php echo $email_kurir; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Foto <?php echo form_error('foto_kurir') ?></label>
            <input type="file" class="form-control" name="foto_kurir" id="foto_kurir" placeholder="Foto Kurir" value="<?php echo $foto_kurir; ?>" />
            <?php 
            if ($foto_kurir !== '') {
                ?>
                <div>
                    *) Gambar Sebelumnya <br>
                    <img src="image/kurir/<?php echo $foto_kurir ?>" style="width: 100px;height: 100px;">
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>
        <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" onKeyUp="checkPasswordStrength();" value="<?php echo $password; ?>" />
            <div id="password-strength-status" style="font-weight: bold"></div>
        </div>
        <div class="form-group">
            <label for="varchar">Level <?php echo form_error('level') ?></label>
            <select class="form-control" name="level">
                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                <option value="Kurir">Kurir</option>
            </select>
        </div>
        <input type="hidden" name="id_kurir" value="<?php echo $id_kurir; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('kurir') ?>" class="btn btn-default">Cancel</a>
    </form>