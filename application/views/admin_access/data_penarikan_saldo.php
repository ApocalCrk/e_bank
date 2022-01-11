<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $_GET['q'] ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($_GET['q'] <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('app/data_penarikan_saldo'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <?php 
        $query = urldecode($this->input->get('q'));
        if ($query) {
            $q = urlencode($query);
        ?>
        <div class="table-responsive">
        <table class="table table-bordered" id="example1" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode Penarikan</th>
                <th>Jumlah Penarikan</th>
                <th>Waktu</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $start = 0;
                $sql = $this->db->query("SELECT * FROM penarikan_saldo WHERE kode_penarikan LIKE '%$q%'");
                foreach ($sql->result() as $row)
            {
                ?>
            <tr>
                <td width="80px"><?php echo ++$start ?></td>
                <td><p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 150px"><?php echo $row->kode_penarikan ?></p></td>
                <td><?php echo 'Rp. '.number_format($row->jumlah_penarikan) ?></td>
                <td><?php echo $row->waktu ?></td>
                <td><a href="<?php echo site_url('app/detail_data_penarikan/'.$row->id_penarikan) ?>">Detail</a></td>
            </tr>
        <?php } ?>
    </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $this->db->query("SELECT * FROM penarikan_saldo WHERE kode_penarikan LIKE '%$q%'")->num_rows(); ?></div>
                <a href="app/export_data_penarikan_saldo" target="_blank" class="btn btn-info">Export</a>
        </div>
        <?php }else{ ?><div class="table-responsive">
        <table class="table table-bordered" id="example1" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode Penarikan</th>
                <th>Jumlah Penarikan</th>
                <th>Waktu</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $start = 0;
                $sql = $this->db->query("SELECT * FROM penarikan_saldo");
                foreach ($sql->result() as $row)
            {
                ?>
            <tr>
                <td width="80px"><?php echo ++$start ?></td>
                <td><p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 150px"><?php echo $row->kode_penarikan ?></p></td>
                <td><?php echo 'Rp. '.number_format($row->jumlah_penarikan) ?></td>
                <td><?php echo $row->waktu ?></td>
                <td><a href="<?php echo site_url('app/detail_data_penarikan/'.$row->id_penarikan) ?>">Detail</a></td>
            </tr>
        <?php } ?>
    </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $this->db->query("SELECT * FROM penarikan_saldo")->num_rows(); ?></div>
                <a href="app/export_data_penarikan_saldo" target="_blank" class="btn btn-info">Export</a>
        </div>
    <?php } ?>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

