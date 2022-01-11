<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">No Induk <?php echo form_error('nis') ?></label>
            <!-- <input type="text" class="form-control" name="nis" id="nis" placeholder="No Santri" value="<?php echo $nis; ?>" /> -->
            <br>
          <select id="nis" name="nis" class="selectpicker" class="form-control" data-live-search="true" autofocus>
            <?php 
            $this->db->order_by('nis','desc');
            $sql = $this->db->query("SELECT * FROM tabungan");
            foreach ($sql->result() as $row) {
                $sql_name = $this->db->query("SELECT * FROM user where nis='$row->nis'");
                $name = $sql_name->row_array();
             ?>
            <option value="<?php echo $nis; ?>"><?php echo $nis; ?></option>
            <option value="<?php echo $row->nis ?>"><?php echo $row->nis.' - '.$name['nama_siswa'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
            <label for="int">Saldo <?php echo form_error('saldo') ?></label>
            <input type="text" class="form-control" name="saldo" id="saldo" placeholder="Saldo" value="<?php echo $saldo; ?>" min='0'/>
        </div>
        <div class="form-group" style="display: none;">
            <label for="int">Pengeluaran <?php echo form_error('pengeluaran') ?></label>
            <input type="text" class="form-control" name="pengeluaran" id="pengeluaran" placeholder="0" value="<?php echo $pengeluaran; ?>" readonly/>
        </div>
        
        <input type="hidden" name="id_tabungan" value="<?php echo $id_tabungan; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('tabungan') ?>" class="btn btn-default">Cancel</a>
    </form>
