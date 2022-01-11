 <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('kurir/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('kurir/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('kurir'); ?>" class="btn btn-default">Reset</a>
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
        <th>NIS Kurir</th>
        <th>Nama Kurir</th>
        <th>No Hp</th>
        <th>Email</th>
        <th>Foto</th>
        <th>ID QrCode</th>
        <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($kurir_data as $kurir)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $kurir->nis_kurir ?></td>
            <td><?php echo $kurir->nama_kurir ?></td>
            <td><?php echo $kurir->no_hp_kurir ?></td>
            <td><?php echo $kurir->email_kurir ?></td>
            <td><img src="image/kurir/<?php echo $kurir->foto_kurir ?>" style="width: 50px; height: 50px;"></td>
            <td><img src="image/kurir_code/<?php echo $kurir->id_qrcode ?>" style="width: 50px; height: 50px;"></td>
            <td style="text-align:center" width="200px">
                <?php 
                 
                echo anchor(site_url('kurir/read/'.$kurir->id_kurir),'Detail');
                echo ' | '; 
                echo anchor(site_url('kurir/update/'.$kurir->id_kurir),'Update'); 
                echo ' | '; 
                echo anchor(site_url('kurir/delete/'.$kurir->id_kurir),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
    </tbody>
                <?php
            }
            ?>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $total_rows ?></div>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>