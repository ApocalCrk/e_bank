<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=tabungan_siswa_".date("Y-m-d").".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Saldo</th>
            <th>Pengeluaran</th>
        </tr>
        <?php
            $start = 0;
            $tabungan_data = $this->db->get('tabungan');
            foreach ($tabungan_data->result() as $tabungan){?>
        <tr>
            <td><?php echo ++$start ?></td>
            <td><?php echo $tabungan->nis ?></td>
            <td><?php 
            $sql = $this->db->query("SELECT * FROM user where nis='$tabungan->nis'")->row();
            echo $sql->nama_siswa;
             ?></td>
            <td><?php echo 'Rp. '.number_format($tabungan->saldo) ?></td>
            <td><?php echo 'Rp. '.number_format($tabungan->pengeluaran) ?></td>
        
        </tr>
        <?php } ?>
        </table>