<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('tabungan/create'),'Buat Tabungan', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('tabungan/tambah_saldo'),'Tambah Saldo', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('tabungan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tabungan'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" id="example1" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
        <th>Nis</th>
        <th>Nama Siswa</th>
        <th>Saldo</th>
        <th>Pengeluaran</th>
        
        <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tabungan_data as $tabungan)
            {
                $sql = $this->db->query("SELECT * FROM user WHERE nis='$tabungan->nis'");
                foreach ($sql->result() as $row) {
                    if ($tabungan->nis == $row->nis) {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $tabungan->nis ?></td>
            <td><?php 
            $sql = $this->db->query("SELECT * FROM user where nis='$tabungan->nis' ")->row();
            echo $sql->nama_siswa;
             ?></td>
            <!-- <td><?php
            $saldo_tambahan = 0; 
            $detail_tabungan = $this->db->query("SELECT * FROM detail_tambahan WHERE nis='$tabungan->nis'");
            foreach ($detail_tabungan->result() as $d) {
                $saldo_tambahan = $saldo_tambahan + $d->saldo_tambahan;
            }
            $total_saldo = $tabungan->saldo + $saldo_tambahan;
            echo number_format($total_saldo) ?></td> -->
            <td><?php echo number_format($tabungan->saldo) ?></td>
            <td><?php echo number_format($tabungan->pengeluaran) ?></td>
            
            <td style="text-align:center" width="200px">
                <a href="app/cetak_saldo/<?php echo $tabungan->nis ?>" target="_blank">Cetak Saldo</a>
                <?php 
                //echo anchor(site_url('app/cetak_saldo/'.$tabungan->nis),'Cetak Saldo'); 
                echo ' | '; 
                echo anchor(site_url('tabungan/update/'.$tabungan->id_tabungan),'Update'); 
                echo ' | '; 
                echo anchor(site_url('tabungan/delete/'.$tabungan->id_tabungan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }else{}
        }
    }
            ?>
    </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $total_rows ?></div>
                <a href="app/export_tabungan" target="_blank" class="btn btn-primary">Export</a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>