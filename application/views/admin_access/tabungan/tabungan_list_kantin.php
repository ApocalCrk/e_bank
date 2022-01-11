<?php 
    function sign($message, $key) {
        return hash_hmac('sha256', $message, $key) . $message;
    }
    function verify($bundle, $key) {
        return hash_equals(
            hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key),
            mb_substr($bundle, 0, 64, '8bit')
            );
    }
    function getKey($password, $keysize = 16) {
         return hash_pbkdf2('sha256',$password,'some_token',100000,$keysize,true);
    }
    function decrypt($hash, $password) {
        $iv = hex2bin(substr($hash, 0, 32));
        $data = hex2bin(substr($hash, 32));
        $key = getKey($password);
        if (!verify($data, $key)) {
             return null;
        }
        return openssl_decrypt(mb_substr($data, 64, null, '8bit'),'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv);
    } 
    $password = 'password';
?>
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
                        <input type="text" class="form-control" name="q" value="<?php echo $_GET['q']; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($_GET['q'] <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('app/tabungan_kantin'); ?>" class="btn btn-default">Reset</a>
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
        <th>Kode Kantin</th>
        <th>Nama Kantin</th>
        <th>Saldo</th>
        <th>Total Penarikan Saldo</th>
        <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $start = 0;
            $sql = $this->db->query("SELECT * FROM tabungan_kantin WHERE kode_kantin LIKE '%$q%'");
            foreach ($sql->result() as $row){?>
            <tr>
                <td width="80px"><?php echo ++$start ?></td>
                <td><?php echo $row->kode_kantin ?></td>
                <td><?php 
                    $sql = $this->db->query("SELECT * FROM kantin where kode_kantin='$row->kode_kantin'")->row();
                    echo $sql->nama_kantin;
                ?></td>
                <td><?php echo number_format($row->total_saldo) ?></td>
                <td><?php 
                    $sql = $this->db->query("SELECT * FROM penarikan_saldo");
                    $total_penarikan = 0;
                    foreach ($sql->result() as $sql) {
                        $decrypt = decrypt($sql->kode_penarikan, $password);
                        if ($row->kode_kantin == $decrypt) {
                            $total_penarikan = $total_penarikan + $sql->jumlah_penarikan;
                        }
                    }
                    echo number_format($total_penarikan);
                ?></td>
            
                <td style="text-align:center" width="200px">
                <a href="app/cetak_saldo_kantin/<?php echo $row->kode_kantin ?>" target="_blank">Cetak Saldo</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $this->db->query("SELECT * FROM tabungan_kantin WHERE kode_kantin LIKE '%$q%'")->num_rows() ?></div>
                <a href="app/export_tabungan_kantin" target="_blank" class="btn btn-primary">Export</a>
        </div>
        <?php }else{ ?>
        <div class="table-responsive">
        <table class="table table-bordered" id="example1" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
        <th>Kode Kantin</th>
        <th>Nama Kantin</th>
        <th>Saldo</th>
        <th>Total Penarikan Saldo</th>
        <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $start = 0;
            $sql = $this->db->query("SELECT * FROM tabungan_kantin");
            foreach ($sql->result() as $row){?>
            <tr>
                <td width="80px"><?php echo ++$start ?></td>
                <td><?php echo $row->kode_kantin ?></td>
                <td><?php 
                    $sql = $this->db->query("SELECT * FROM kantin where kode_kantin='$row->kode_kantin' ")->row();
                    echo $sql->nama_kantin;
                ?></td>
                <td><?php echo number_format($row->total_saldo) ?></td>
                <td><?php 
                    $sql = $this->db->query("SELECT * FROM penarikan_saldo");
                    $total_penarikan = 0;
                    foreach ($sql->result() as $sql) {
                        $decrypt = decrypt($sql->kode_penarikan, $password);
                        if ($row->kode_kantin == $decrypt) {
                            $total_penarikan = $total_penarikan + $sql->jumlah_penarikan;
                        }
                    }
                    echo number_format($total_penarikan);
                ?></td>
            
                <td style="text-align:center" width="200px">
                <a href="app/cetak_saldo_kantin/<?php echo $row->kode_kantin ?>" target="_blank">Cetak Saldo</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $this->db->query("SELECT * FROM tabungan_kantin")->num_rows() ?></div>
                <a href="app/export_tabungan_kantin" target="_blank" class="btn btn-primary">Export</a>
        </div>
    <?php } ?>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>